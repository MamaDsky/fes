<?php
/**
 * Endpoint akhir pendaftaran MANIFEST.
 * Mendukung dua mode:
 * 1) staged upload (dipakai daftar.php terbaru): data formulir kecil, tiap berkas sudah disimpan satu per satu.
 * 2) direct upload (fallback): tetap kompatibel bila ada halaman lama yang mengirim multipart biasa.
 */
error_reporting(0);
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

class RegistrationException extends RuntimeException {}

function respond_json($payload, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function fail_registration($message, $httpCode = 422) {
    throw new RegistrationException($message, $httpCode);
}

function start_registration_session() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https');

    session_set_cookie_params(array(
        'lifetime' => 0,
        'path' => '/',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax'
    ));
    session_start();
}

function pricing_rules() {
    return array(
        'BPC' => array('early_price' => 65000, 'normal_price' => 75000, 'early_limit' => 90),
        'BCC' => array('early_price' => 65000, 'normal_price' => 75000, 'early_limit' => 60),
        'EBPC' => array('early_price' => 75000, 'normal_price' => 85000, 'early_limit' => 30),
    );
}

function upload_error_message($errorCode) {
    $messages = array(
        UPLOAD_ERR_INI_SIZE   => 'ukuran file melebihi batas upload server.',
        UPLOAD_ERR_FORM_SIZE  => 'ukuran file melebihi batas formulir.',
        UPLOAD_ERR_PARTIAL    => 'file hanya terunggah sebagian.',
        UPLOAD_ERR_NO_FILE    => 'file belum diterima server.',
        UPLOAD_ERR_NO_TMP_DIR => 'folder sementara upload server tidak tersedia.',
        UPLOAD_ERR_CANT_WRITE => 'server tidak dapat menulis file.',
        UPLOAD_ERR_EXTENSION  => 'upload dihentikan oleh ekstensi PHP server.'
    );
    return isset($messages[$errorCode]) ? $messages[$errorCode] : 'terjadi kendala saat menerima file.';
}

function allowed_upload_extensions($field) {
    $fields = array(
        'leader_id_scan' => array('pdf'),
        'member_id_scan' => array('pdf'),
        'payment_proof' => array('jpg', 'jpeg', 'png'),
        // Bukti aktivitas boleh berupa screenshot gambar supaya ukuran jauh lebih kecil dibanding PDF hasil screenshot.
        'proof_follow_ig' => array('pdf', 'jpg', 'jpeg', 'png'),
        'proof_repost_feed' => array('pdf', 'jpg', 'jpeg', 'png'),
        'proof_comment_mention' => array('pdf', 'jpg', 'jpeg', 'png'),
        'proof_twibbon' => array('pdf', 'jpg', 'jpeg', 'png'),
        'proof_originality' => array('pdf')
    );
    return isset($fields[$field]) ? $fields[$field] : array();
}

function validate_file_content($label, $filename, $path, $size, $allowedExtensions) {
    if ($size <= 0 || $size > 5 * 1024 * 1024) {
        fail_registration($label . ': ukuran file harus maksimal 5MB.');
    }

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions, true)) {
        fail_registration($label . ': format file tidak sesuai.');
    }

    if (class_exists('finfo')) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = (string) $finfo->file($path);
    } elseif (function_exists('mime_content_type')) {
        $mime = (string) mime_content_type($path);
    } else {
        fail_registration('Server belum mendukung pemeriksaan keamanan file.', 500);
    }

    $pdfMimes = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf');
    $imageMimes = array('image/jpeg', 'image/png', 'image/pjpeg');

    if ($extension === 'pdf' && !in_array($mime, $pdfMimes, true)) {
        fail_registration($label . ': file harus berupa PDF asli.');
    }
    if (in_array($extension, array('jpg', 'jpeg', 'png'), true) && !in_array($mime, $imageMimes, true)) {
        fail_registration($label . ': file harus berupa JPG, JPEG, atau PNG asli.');
    }

    return $extension;
}

function secure_upload($label, $file, $allowedExtensions, $targetDir) {
    if (!isset($file) || !is_array($file)) {
        fail_registration($label . ': file belum diterima server.');
    }

    $errorCode = isset($file['error']) ? (int) $file['error'] : UPLOAD_ERR_NO_FILE;
    if ($errorCode !== UPLOAD_ERR_OK) {
        fail_registration($label . ': ' . upload_error_message($errorCode));
    }

    $tmpName = isset($file['tmp_name']) ? (string) $file['tmp_name'] : '';
    if ($tmpName === '' || !is_uploaded_file($tmpName)) {
        fail_registration($label . ': server tidak menemukan file sementara upload.');
    }

    $originalName = isset($file['name']) ? (string) $file['name'] : '';
    $size = isset($file['size']) ? (int) $file['size'] : 0;
    $extension = validate_file_content($label, $originalName, $tmpName, $size, $allowedExtensions);

    try {
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
    } catch (Throwable $e) {
        $filename = uniqid('manifest_', true) . '.' . $extension;
    }

    if (!move_uploaded_file($tmpName, $targetDir . $filename)) {
        fail_registration($label . ': server gagal menyimpan file ke folder uploads.', 500);
    }

    return $filename;
}

function secure_staged_upload($label, $field, $allowedExtensions, $batchId, $targetDir) {
    if (!isset($_SESSION['manifest_upload_staging']) || !is_array($_SESSION['manifest_upload_staging'])
        || !isset($_SESSION['manifest_upload_staging'][$batchId]) || !is_array($_SESSION['manifest_upload_staging'][$batchId])
        || !isset($_SESSION['manifest_upload_staging'][$batchId][$field]) || !is_array($_SESSION['manifest_upload_staging'][$batchId][$field])) {
        fail_registration($label . ' belum ditemukan. Unggah ulang berkas tersebut lalu kirim pendaftaran lagi.', 422);
    }

    $meta = $_SESSION['manifest_upload_staging'][$batchId][$field];
    $filename = isset($meta['filename']) ? basename((string) $meta['filename']) : '';
    $size = isset($meta['size']) ? (int) $meta['size'] : 0;

    if ($filename === '' || !preg_match('/^[a-zA-Z0-9_.-]+$/', $filename)) {
        fail_registration($label . ' tidak valid. Unggah ulang berkas tersebut.', 422);
    }

    $stagingDir = __DIR__ . '/../../uploads/staging/';
    $sourcePath = $stagingDir . $filename;
    if (!is_file($sourcePath) || !is_readable($sourcePath)) {
        fail_registration($label . ' sudah tidak tersedia di server. Unggah ulang berkas tersebut.', 422);
    }

    $actualSize = @filesize($sourcePath);
    if ($actualSize === false) {
        fail_registration($label . ' tidak dapat diperiksa. Unggah ulang berkas tersebut.', 422);
    }
    $actualSize = (int) $actualSize;
    if ($size > 0 && $actualSize !== $size) {
        fail_registration($label . ' berubah saat diproses. Unggah ulang berkas tersebut.', 422);
    }

    validate_file_content($label, $filename, $sourcePath, $actualSize, $allowedExtensions);

    // Copy dulu; file staging baru dihapus setelah transaksi database berhasil.
    if (!@copy($sourcePath, $targetDir . $filename)) {
        fail_registration($label . ': server gagal memindahkan file ke folder uploads.', 500);
    }

    return $filename;
}

function delete_uploaded_files($targetDir, $files) {
    foreach ($files as $file) {
        if ($file && is_file($targetDir . $file)) {
            @unlink($targetDir . $file);
        }
    }
}

function clear_staged_batch($batchId) {
    if ($batchId === '' || !isset($_SESSION['manifest_upload_staging'][$batchId]) || !is_array($_SESSION['manifest_upload_staging'][$batchId])) {
        return;
    }

    $stagingDir = __DIR__ . '/../../uploads/staging/';
    foreach ($_SESSION['manifest_upload_staging'][$batchId] as $meta) {
        $filename = isset($meta['filename']) ? basename((string) $meta['filename']) : '';
        if ($filename !== '' && is_file($stagingDir . $filename)) {
            @unlink($stagingDir . $filename);
        }
    }
    unset($_SESSION['manifest_upload_staging'][$batchId]);
}

function has_registration_column($conn, $columnName) {
    $safeColumn = $conn->real_escape_string($columnName);
    $result = $conn->query("SHOW COLUMNS FROM `registrations` LIKE '" . $safeColumn . "'");
    return $result && $result->num_rows > 0;
}

function has_pricing_tier_column($conn) {
    return has_registration_column($conn, 'pricing_tier');
}

function has_referral_discount_amount_column($conn) {
    $result = $conn->query("SHOW COLUMNS FROM `referral_codes` LIKE 'discount_amount'");
    return $result && $result->num_rows > 0;
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

function acquire_early_bird_lock($conn, $competitionType) {
    $name = 'manifest_early_bird_' . strtolower($competitionType);
    $stmt = $conn->prepare('SELECT GET_LOCK(?, 10) AS lock_status');
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    if (!$row || (int) $row['lock_status'] !== 1) {
        fail_registration('Sistem sedang mengunci kuota Early Bird. Silakan coba kirim ulang beberapa saat lagi.', 503);
    }
    return $name;
}

function release_early_bird_lock($conn, $name) {
    if (!$name) return;
    try {
        $stmt = $conn->prepare('SELECT RELEASE_LOCK(?)');
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->close();
    } catch (Throwable $e) {
        // Respons pendaftaran tidak boleh gagal hanya karena proses release lock bermasalah.
    }
}

function clean_value($value) {
    return trim(strip_tags((string) $value));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond_json(array('status' => 'error', 'message' => 'Metode request tidak valid.'), 405);
}

$contentLength = isset($_SERVER['CONTENT_LENGTH']) ? (int) $_SERVER['CONTENT_LENGTH'] : 0;
if ($contentLength > 0 && empty($_POST) && empty($_FILES)) {
    respond_json(array(
        'status' => 'error',
        'message' => 'Total ukuran upload melebihi batas PHP server. Pastikan file .user.ini sudah terunggah di root project.'
    ), 413);
}

$uploadedFiles = array();
$uploadDir = null;
$lockName = null;
$transactionStarted = false;
$batchId = '';
$usingStagedUploads = false;

try {
    start_registration_session();

    $batchId = isset($_POST['upload_batch_id']) ? trim((string) $_POST['upload_batch_id']) : '';
    if ($batchId !== '') {
        if (!preg_match('/^[A-Za-z0-9_-]{16,100}$/', $batchId)) {
            fail_registration('Sesi upload tidak valid. Muat ulang halaman lalu coba lagi.', 400);
        }
        $usingStagedUploads = true;
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    require_once __DIR__ . '/../../config/database.php';

    if (!has_pricing_tier_column($conn)) {
        fail_registration('Update harga belum aktif. Jalankan file manifest_pricing_update.sql di phpMyAdmin terlebih dahulu.', 422);
    }
    if (!has_registration_column($conn, 'proof_comment_mention')) {
        fail_registration('Update berkas belum aktif. Jalankan file manifest_comment_mention_update.sql di phpMyAdmin terlebih dahulu.', 422);
    }

    $competitionType = strtoupper(clean_value(isset($_POST['competition_type']) ? $_POST['competition_type'] : ''));
    $pricingTier = clean_value(isset($_POST['pricing_tier']) ? $_POST['pricing_tier'] : '');
    $rules = pricing_rules();

    if (!isset($rules[$competitionType])) {
        fail_registration('Kategori kompetisi tidak valid. Muat ulang halaman lalu isi kembali formulir.');
    }
    if (!in_array($pricingTier, array('early_bird', 'normal'), true)) {
        fail_registration('Kategori harga pendaftaran tidak valid.');
    }

    $teamName = clean_value(isset($_POST['team_name']) ? $_POST['team_name'] : '');
    $discoverySource = clean_value(isset($_POST['discovery_source']) ? $_POST['discovery_source'] : '');
    $leaderName = clean_value(isset($_POST['leader_name']) ? $_POST['leader_name'] : '');
    $leaderSchool = clean_value(isset($_POST['leader_school']) ? $_POST['leader_school'] : '');
    $leaderGrade = clean_value(isset($_POST['leader_grade']) ? $_POST['leader_grade'] : '');
    $leaderWhatsapp = clean_value(isset($_POST['leader_whatsapp']) ? $_POST['leader_whatsapp'] : '');
    $memberName = clean_value(isset($_POST['member_name']) ? $_POST['member_name'] : '');
    $memberSchool = clean_value(isset($_POST['member_school']) ? $_POST['member_school'] : '');
    $memberGrade = clean_value(isset($_POST['member_grade']) ? $_POST['member_grade'] : '');
    $memberWhatsapp = clean_value(isset($_POST['member_whatsapp']) ? $_POST['member_whatsapp'] : '');
    $accountHolder = clean_value(isset($_POST['account_holder']) ? $_POST['account_holder'] : '');
    $paymentMethod = clean_value(isset($_POST['payment_method']) ? $_POST['payment_method'] : '');
    $referralCode = strtoupper(clean_value(isset($_POST['referral_code']) ? $_POST['referral_code'] : ''));

    if ($teamName === '' || $leaderName === '' || $leaderSchool === '' || $memberName === '' || $memberSchool === '' || $accountHolder === '') {
        fail_registration('Mohon lengkapi seluruh kolom data tim.');
    }
    if (!in_array($discoverySource, array('Instagram', 'TikTok', 'Roadshow MANIFEST', 'Teman/Keluarga'), true)) {
        fail_registration('Sumber informasi MANIFEST 2026 tidak valid.');
    }
    if (!in_array($leaderGrade, array('10', '11', '12'), true) || !in_array($memberGrade, array('10', '11', '12'), true)) {
        fail_registration('Kelas/grade peserta tidak valid.');
    }
    if (!preg_match('/^[0-9]{9,15}$/', $leaderWhatsapp) || !preg_match('/^[0-9]{9,15}$/', $memberWhatsapp)) {
        fail_registration('Nomor WhatsApp wajib berupa angka 9–15 digit.');
    }
    if (!in_array($paymentMethod, array('Bank Jago', 'QRIS'), true)) {
        fail_registration('Metode pembayaran tidak valid.');
    }

    $uploadDir = __DIR__ . '/../../uploads/';
    if (!is_dir($uploadDir) && !@mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
        fail_registration('Folder uploads tidak dapat dibuat. Buat folder uploads di root project dan atur permission 755 atau 775.', 500);
    }
    if (!is_writable($uploadDir)) {
        fail_registration('Folder uploads tidak dapat ditulis server. Atur permission folder uploads ke 755 atau 775.', 500);
    }

    $receiveFile = function($field, $label) use ($usingStagedUploads, $batchId, $uploadDir) {
        $allowed = allowed_upload_extensions($field);
        if (!$allowed) {
            fail_registration('Konfigurasi berkas tidak valid.', 500);
        }
        if ($usingStagedUploads) {
            return secure_staged_upload($label, $field, $allowed, $batchId, $uploadDir);
        }
        return secure_upload($label, isset($_FILES[$field]) ? $_FILES[$field] : null, $allowed, $uploadDir);
    };

    $leaderIdScan = $receiveFile('leader_id_scan', 'Kartu pelajar ketua');
    $uploadedFiles[] = $leaderIdScan;
    $memberIdScan = $receiveFile('member_id_scan', 'Kartu pelajar anggota');
    $uploadedFiles[] = $memberIdScan;
    $paymentProof = $receiveFile('payment_proof', 'Bukti pembayaran');
    $uploadedFiles[] = $paymentProof;
    $proofFollowIg = $receiveFile('proof_follow_ig', 'Bukti follow Instagram');
    $uploadedFiles[] = $proofFollowIg;
    $proofRepostFeed = $receiveFile('proof_repost_feed', 'Bukti repost feeds');
    $uploadedFiles[] = $proofRepostFeed;
    $proofCommentMention = $receiveFile('proof_comment_mention', 'Bukti komen dan mention');
    $uploadedFiles[] = $proofCommentMention;
    $proofTwibbon = $receiveFile('proof_twibbon', 'Bukti upload twibbon');
    $uploadedFiles[] = $proofTwibbon;

    $proofOriginality = null;
    if ($competitionType !== 'BCC') {
        $proofOriginality = $receiveFile('proof_originality', 'Surat Pernyataan Orisinalitas');
        $uploadedFiles[] = $proofOriginality;
    }

    // Normal Price tidak ikut menunggu lock kuota Early Bird.
    if ($pricingTier === 'early_bird') {
        $lockName = acquire_early_bird_lock($conn, $competitionType);
    }
    $conn->begin_transaction();
    $transactionStarted = true;

    $rule = $rules[$competitionType];
    $earlyUsed = early_bird_usage($conn, $competitionType);
    if ($pricingTier === 'early_bird' && $earlyUsed >= $rule['early_limit']) {
        fail_registration('Kuota Early Bird untuk ' . $competitionType . ' baru saja penuh. Silakan kembali ke Step 2 dan pilih Normal Price.');
    }

    $baseAmount = ($pricingTier === 'early_bird') ? $rule['early_price'] : $rule['normal_price'];
    $discountAmount = 0;
    $referralCodeForDb = null;

    if ($referralCode !== '') {
        if (!has_referral_discount_amount_column($conn)) {
            fail_registration('Update referral nominal belum aktif. Jalankan file migrasi_referral_nominal.sql di phpMyAdmin terlebih dahulu.', 422);
        }

        $stmtReferral = $conn->prepare('SELECT `discount_amount` FROM `referral_codes` WHERE UPPER(`code`) = ? LIMIT 1');
        $stmtReferral->bind_param('s', $referralCode);
        $stmtReferral->execute();
        $referralResult = $stmtReferral->get_result();
        if ($referralResult && $referralResult->num_rows > 0) {
            $referralRow = $referralResult->fetch_assoc();
            $discountAmount = max(0, (int) $referralRow['discount_amount']);
            $referralCodeForDb = $referralCode;
        }
        $stmtReferral->close();
    }

    $discountAmount = min($baseAmount, $discountAmount);
    $finalAmount = $baseAmount - $discountAmount;

    $sql = "INSERT INTO `registrations` (
        `competition_type`, `team_name`, `discovery_source`, `leader_name`, `leader_school`, `leader_grade`, `leader_id_scan`, `leader_whatsapp`,
        `member_name`, `member_school`, `member_grade`, `member_id_scan`, `member_whatsapp`,
        `account_holder`, `payment_method`, `pricing_tier`, `referral_code_used`, `final_amount`, `payment_proof`,
        `proof_follow_ig`, `proof_repost_feed`, `proof_comment_mention`, `proof_twibbon`, `proof_originality`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'sssssssssssssssssdssssss',
        $competitionType, $teamName, $discoverySource, $leaderName, $leaderSchool, $leaderGrade, $leaderIdScan, $leaderWhatsapp,
        $memberName, $memberSchool, $memberGrade, $memberIdScan, $memberWhatsapp,
        $accountHolder, $paymentMethod, $pricingTier, $referralCodeForDb, $finalAmount, $paymentProof,
        $proofFollowIg, $proofRepostFeed, $proofCommentMention, $proofTwibbon, $proofOriginality
    );
    $stmt->execute();
    $registrationId = $conn->insert_id;
    $stmt->close();

    $conn->commit();
    $transactionStarted = false;
    release_early_bird_lock($conn, $lockName);
    $lockName = null;

    if ($usingStagedUploads) {
        clear_staged_batch($batchId);
    }

    respond_json(array(
        'status' => 'success',
        'message' => 'Pendaftaran tim Anda berhasil disimpan!',
        'registration_id' => $registrationId,
        'pricing_tier' => $pricingTier,
        'base_amount' => $baseAmount,
        'final_amount' => $finalAmount,
        'discount' => $discountAmount,
        'discount_amount' => $discountAmount
    ));
} catch (RegistrationException $e) {
    if ($transactionStarted && isset($conn) && $conn instanceof mysqli) {
        $conn->rollback();
    }
    if ($uploadDir) {
        delete_uploaded_files($uploadDir, $uploadedFiles);
    }
    if (isset($conn) && $conn instanceof mysqli) {
        release_early_bird_lock($conn, $lockName);
    }
    $status = (int) $e->getCode();
    if ($status < 400 || $status > 599) $status = 422;
    respond_json(array('status' => 'error', 'message' => $e->getMessage()), $status);
} catch (mysqli_sql_exception $e) {
    if ($transactionStarted && isset($conn) && $conn instanceof mysqli) {
        $conn->rollback();
    }
    if ($uploadDir) {
        delete_uploaded_files($uploadDir, $uploadedFiles);
    }
    if (isset($conn) && $conn instanceof mysqli) {
        release_early_bird_lock($conn, $lockName);
    }
    error_log('apply.php database error: ' . $e->getMessage());
    respond_json(array('status' => 'error', 'message' => 'Database pendaftaran belum dapat diproses. Periksa struktur database dan izin database.'), 500);
} catch (Throwable $e) {
    if ($transactionStarted && isset($conn) && $conn instanceof mysqli) {
        $conn->rollback();
    }
    if ($uploadDir) {
        delete_uploaded_files($uploadDir, $uploadedFiles);
    }
    if (isset($conn) && $conn instanceof mysqli) {
        release_early_bird_lock($conn, $lockName);
    }
    error_log('apply.php unexpected error: ' . $e->getMessage());
    respond_json(array('status' => 'error', 'message' => 'Terjadi kendala pada server. Silakan coba kembali.'), 500);
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
    }
}
?>
