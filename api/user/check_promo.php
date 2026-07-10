<?php
/**
 * Cek harga pendaftaran, kuota Early Bird, dan kode referral.
 */
error_reporting(0);
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');

function respond_json($payload, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function pricing_rules() {
    return array(
        'BPC' => array('early_price' => 65000, 'normal_price' => 75000, 'early_limit' => 90),
        'BCC' => array('early_price' => 65000, 'normal_price' => 75000, 'early_limit' => 60),
        'EBPC' => array('early_price' => 75000, 'normal_price' => 85000, 'early_limit' => 30),
    );
}

function has_pricing_tier_column($conn) {
    $result = $conn->query("SHOW COLUMNS FROM `registrations` LIKE 'pricing_tier'");
    return $result && $result->num_rows > 0;
}

function has_referral_discount_amount_column($conn) {
    $result = $conn->query("SHOW COLUMNS FROM `referral_codes` LIKE 'discount_amount'");
    return $result && $result->num_rows > 0;
}

function format_rupiah($amount) {
    return 'Rp ' . number_format((int) $amount, 0, ',', '.');
}

function early_bird_usage($conn, $competitionType) {
    $sql = "SELECT COUNT(*) AS total
            FROM `registrations`
            WHERE `competition_type` = ?
              AND `pricing_tier` = 'early_bird'
              AND (`status` IS NULL OR `status` NOT IN ('cancelled', 'rejected'))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $competitionType);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : array('total' => 0);
    $stmt->close();
    return (int) $row['total'];
}

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    require_once __DIR__ . '/../../config/database.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        respond_json(array('status' => 'error', 'message' => 'Metode request tidak valid.'), 405);
    }

    if (!has_pricing_tier_column($conn)) {
        respond_json(array(
            'status' => 'error',
            'message' => 'Update harga belum aktif. Jalankan file manifest_pricing_update.sql di phpMyAdmin terlebih dahulu.'
        ), 422);
    }

    $competitionType = strtoupper(trim(isset($_POST['competition_type']) ? $_POST['competition_type'] : ''));
    $tier = trim(isset($_POST['pricing_tier']) ? $_POST['pricing_tier'] : 'early_bird');
    $code = strtoupper(trim(isset($_POST['referral_code']) ? $_POST['referral_code'] : ''));

    $rules = pricing_rules();
    if (!isset($rules[$competitionType])) {
        respond_json(array('status' => 'error', 'message' => 'Kategori kompetisi tidak valid.'), 422);
    }
    if (!in_array($tier, array('early_bird', 'normal'), true)) {
        respond_json(array('status' => 'error', 'message' => 'Kategori harga tidak valid.'), 422);
    }

    $rule = $rules[$competitionType];
    $earlyUsed = early_bird_usage($conn, $competitionType);
    $earlyAvailable = $earlyUsed < $rule['early_limit'];

    if ($tier === 'early_bird' && !$earlyAvailable) {
        respond_json(array(
            'status' => 'error',
            'message' => 'Kuota Early Bird untuk ' . $competitionType . ' sudah penuh. Silakan pilih Normal Price.',
            'early_available' => false,
            'early_used' => $earlyUsed,
            'early_remaining' => 0,
            'pricing_tier' => 'normal',
            'base_amount' => $rule['normal_price'],
            'final_amount' => $rule['normal_price'],
            // `discount` dipertahankan untuk integrasi lama.
            'discount' => 0,
            'discount_amount' => 0
        ), 422);
    }

    $baseAmount = ($tier === 'early_bird') ? $rule['early_price'] : $rule['normal_price'];
    $discountAmount = 0;

    if ($code !== '') {
        if (!has_referral_discount_amount_column($conn)) {
            respond_json(array(
                'status' => 'error',
                'message' => 'Update referral nominal belum aktif. Jalankan file migrasi_referral_nominal.sql di phpMyAdmin terlebih dahulu.'
            ), 422);
        }

        $stmt = $conn->prepare('SELECT `discount_amount` FROM `referral_codes` WHERE UPPER(`code`) = ? LIMIT 1');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result || $result->num_rows === 0) {
            $stmt->close();
            respond_json(array(
                'status' => 'error',
                'message' => 'Kode referral tidak valid atau telah kedaluwarsa.',
                'early_available' => $earlyAvailable,
                'early_used' => $earlyUsed,
                'early_remaining' => max(0, $rule['early_limit'] - $earlyUsed),
                'pricing_tier' => $tier,
                'base_amount' => $baseAmount,
                'final_amount' => $baseAmount,
                // `discount` dipertahankan untuk integrasi lama.
                'discount' => 0,
                'discount_amount' => 0
            ), 422);
        }

        $row = $result->fetch_assoc();
        $discountAmount = max(0, (int) $row['discount_amount']);
        $stmt->close();
    }

    // Diskon nominal tidak boleh membuat total tagihan menjadi minus.
    $discountAmount = min($baseAmount, $discountAmount);
    $finalAmount = $baseAmount - $discountAmount;

    respond_json(array(
        'status' => 'success',
        'message' => $code !== '' ? 'Kode referral berhasil diterapkan! Potongan ' . format_rupiah($discountAmount) : '',
        'competition_type' => $competitionType,
        'pricing_tier' => $tier,
        'base_amount' => $baseAmount,
        // `discount` dipertahankan agar integrasi lama tidak rusak.
        'discount' => $discountAmount,
        'discount_amount' => $discountAmount,
        'final_amount' => $finalAmount,
        'early_available' => $earlyAvailable,
        'early_used' => $earlyUsed,
        'early_remaining' => max(0, $rule['early_limit'] - $earlyUsed),
        'early_limit' => $rule['early_limit']
    ));
} catch (mysqli_sql_exception $e) {
    error_log('check_promo.php database error: ' . $e->getMessage());
    respond_json(array('status' => 'error', 'message' => 'Database belum dapat membaca harga pendaftaran. Periksa struktur tabel dan koneksi database.'), 500);
} catch (Throwable $e) {
    error_log('check_promo.php error: ' . $e->getMessage());
    respond_json(array('status' => 'error', 'message' => 'Terjadi kendala pada server saat memeriksa harga.'), 500);
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
