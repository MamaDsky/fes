<?php
// 1. Matikan tampilan eror HTML mentah agar tidak merusak format JSON jika query gagal
error_reporting(0);
ini_set('display_errors', 0);

header("Content-Type: application/json");
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan koneksi database dari database.php aman
    if (!$conn) {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menyambungkan ke database."
        ]);
        exit;
    }

    $code = isset($_POST['referral_code']) ? trim($_POST['referral_code']) : '';
    $competition_type = isset($_POST['competition_type']) ? trim($_POST['competition_type']) : 'BPC';

    // Set harga dasar secara dinamis mengikuti jenis lomba agar hitungan diskonnya akurat
    $base_price = ($competition_type === 'BCC') ? 150000 : 75000;

    if (empty($code)) {
        echo json_encode([
            "status" => "success", 
            "discount" => 0, 
            "final_amount" => $base_price,
            "message" => ""
        ]);
        exit;
    }

    // Amankan pengecekan kode dengan try-catch agar tidak memicu keluaran HTML kotor
    try {
        $stmt = $conn->prepare("SELECT discount_percentage FROM referral_codes WHERE code = ?");
        if (!$stmt) {
            throw new Exception("Struktur tabel 'referral_codes' atau kolom 'code' di database bermasalah.");
        }

        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $discount = $row['discount_percentage'];
            $discount_amount = ($discount / 100) * $base_price;
            $final_amount = $base_price - $discount_amount;

            echo json_encode([
                "status" => "success",
                "discount" => $discount,
                "final_amount" => $final_amount,
                "message" => "Kode referral berhasil diterapkan! Diskon $discount%"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "discount" => 0,
                "final_amount" => $base_price,
                "message" => "Kode referral tidak valid atau telah kedaluwarsa."
            ]);
        }
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "discount" => 0,
            "final_amount" => $base_price,
            "message" => "Eror Sistem Database: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Metode HTTP Request tidak valid."
    ]);
}

if (isset($conn)) {
    $conn->close();
}
?>