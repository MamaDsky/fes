<?php
/**
 * Upload bertahap untuk formulir pendaftaran MANIFEST.
 * Setiap request hanya membawa satu berkas, sehingga tidak ada request 30–45MB
 * yang mudah diputus oleh proxy/LiteSpeed pada shared hosting.
 */
error_reporting(0);
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

class TempUploadException extends RuntimeException {}

function json_reply($payload, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function temp_fail($message, $httpCode = 422) {
    throw new TempUploadException($message, $httpCode);
}

function start_upload_session() {
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

function upload_error_text($code) {
    $messages = array(
        UPLOAD_ERR_INI_SIZE   => 'Ukuran berkas melebihi batas server.',
        UPLOAD_ERR_FORM_SIZE  => 'Ukuran berkas melebihi batas formulir.',
        UPLOAD_ERR_PARTIAL    => 'Berkas hanya terunggah sebagian. Coba lagi dengan koneksi lebih stabil.',
        UPLOAD_ERR_NO_FILE    => 'Berkas belum diterima server.',
        UPLOAD_ERR_NO_TMP_DIR => 'Folder sementara upload server tidak tersedia.',
        UPLOAD_ERR_CANT_WRITE => 'Server tidak dapat menyimpan berkas.',
        UPLOAD_ERR_EXTENSION  => 'Upload dihentikan oleh ekstensi keamanan server.'
    );
    return isset($messages[$code]) ? $messages[$code] : 'Terjadi kendala saat menerima berkas.';
}

function allowed_upload_fields() {
    return array(
        'leader_id_scan' => array('label' => 'Kartu pelajar ketua', 'extensions' => array('pdf')),
        'member_id_scan' => array('label' => 'Kartu pelajar anggota', 'extensions' => array('pdf')),
        'payment_proof' => array('label' => 'Bukti pembayaran', 'extensions' => array('jpg', 'jpeg', 'png')),
        // Bukti aktivitas boleh gambar agar screenshot tidak perlu diubah menjadi PDF besar.
        'proof_follow_ig' => array('label' => 'Bukti follow Instagram', 'extensions' => array('pdf', 'jpg', 'jpeg', 'png')),
        'proof_repost_feed' => array('label' => 'Bukti repost feeds', 'extensions' => array('pdf', 'jpg', 'jpeg', 'png')),
        'proof_comment_mention' => array('label' => 'Bukti komen dan mention', 'extensions' => array('pdf', 'jpg', 'jpeg', 'png')),
        'proof_twibbon' => array('label' => 'Bukti upload twibbon', 'extensions' => array('pdf', 'jpg', 'jpeg', 'png')),
        'proof_originality' => array('label' => 'Surat Pernyataan Orisinalitas', 'extensions' => array('pdf'))
    );
}

function validate_upload_file($field, $file, $rule) {
    if (!isset($file) || !is_array($file)) {
        temp_fail($rule['label'] . ': berkas belum diterima server.');
    }

    $errorCode = isset($file['error']) ? (int) $file['error'] : UPLOAD_ERR_NO_FILE;
    if ($errorCode !== UPLOAD_ERR_OK) {
        temp_fail($rule['label'] . ': ' . upload_error_text($errorCode));
    }

    $maxBytes = 5 * 1024 * 1024;
    $size = isset($file['size']) ? (int) $file['size'] : 0;
    if ($size <= 0 || $size > $maxBytes) {
        temp_fail($rule['label'] . ': ukuran berkas maksimal 5MB.');
    }

    $tmpName = isset($file['tmp_name']) ? (string) $file['tmp_name'] : '';
    if ($tmpName === '' || !is_uploaded_file($tmpName)) {
        temp_fail($rule['label'] . ': file sementara tidak ditemukan di server.');
    }

    $extension = strtolower(pathinfo(isset($file['name']) ? (string) $file['name'] : '', PATHINFO_EXTENSION));
    if (!in_array($extension, $rule['extensions'], true)) {
        temp_fail($rule['label'] . ': format file tidak sesuai.');
    }

    if (class_exists('finfo')) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = (string) $finfo->file($tmpName);
    } elseif (function_exists('mime_content_type')) {
        $mime = (string) mime_content_type($tmpName);
    } else {
        temp_fail('Server belum mendukung pemeriksaan keamanan berkas.', 500);
    }

    $pdfMimes = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf');
    $imageMimes = array('image/jpeg', 'image/png', 'image/pjpeg');

    if ($extension === 'pdf' && !in_array($mime, $pdfMimes, true)) {
        temp_fail($rule['label'] . ': file harus berupa PDF asli.');
    }
    if (in_array($extension, array('jpg', 'jpeg', 'png'), true) && !in_array($mime, $imageMimes, true)) {
        temp_fail($rule['label'] . ': file harus berupa JPG, JPEG, atau PNG asli.');
    }

    return array('extension' => $extension, 'size' => $size, 'mime' => $mime, 'tmp_name' => $tmpName);
}

function cleanup_old_staging_files($stagingDir) {
    // Dibuat ringan dan hanya berjalan sesekali; file staging yang gagal submit tidak menumpuk.
    if (mt_rand(1, 30) !== 1) {
        return;
    }

    $deadline = time() - (12 * 60 * 60);
    $items = @glob($stagingDir . '*');
    if (!$items) {
        return;
    }

    foreach ($items as $item) {
        if (is_file($item) && @filemtime($item) < $deadline) {
            @unlink($item);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_reply(array('status' => 'error', 'message' => 'Metode request tidak valid.'), 405);
}

try {
    start_upload_session();

    $field = isset($_POST['field']) ? trim((string) $_POST['field']) : '';
    $batchId = isset($_POST['upload_batch_id']) ? trim((string) $_POST['upload_batch_id']) : '';
    $fields = allowed_upload_fields();

    if (!isset($fields[$field])) {
        temp_fail('Jenis berkas tidak valid. Muat ulang halaman lalu coba lagi.');
    }
    if (!preg_match('/^[A-Za-z0-9_-]{16,100}$/', $batchId)) {
        temp_fail('Sesi upload tidak valid. Muat ulang halaman lalu coba lagi.', 400);
    }

    $valid = validate_upload_file($field, isset($_FILES['file']) ? $_FILES['file'] : null, $fields[$field]);

    $uploadRoot = __DIR__ . '/../../uploads/';
    $stagingDir = $uploadRoot . 'staging/';
    if (!is_dir($stagingDir) && !@mkdir($stagingDir, 0755, true) && !is_dir($stagingDir)) {
        temp_fail('Folder staging upload tidak dapat dibuat. Pastikan folder uploads memiliki permission 755 atau 775.', 500);
    }
    if (!is_writable($stagingDir)) {
        temp_fail('Folder staging upload tidak dapat ditulis server. Atur permission folder uploads ke 755 atau 775.', 500);
    }

    // Blokir akses langsung ke berkas sementara pada Apache/LiteSpeed.
    $stagingHtaccess = $stagingDir . '.htaccess';
    if (!is_file($stagingHtaccess)) {
        @file_put_contents($stagingHtaccess, "Options -Indexes\n<IfModule mod_authz_core.c>\n    Require all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\n    Deny from all\n</IfModule>\n");
    }

    cleanup_old_staging_files($stagingDir);

    if (!isset($_SESSION['manifest_upload_staging']) || !is_array($_SESSION['manifest_upload_staging'])) {
        $_SESSION['manifest_upload_staging'] = array();
    }
    if (!isset($_SESSION['manifest_upload_staging'][$batchId]) || !is_array($_SESSION['manifest_upload_staging'][$batchId])) {
        $_SESSION['manifest_upload_staging'][$batchId] = array();
    }

    // Saat peserta memilih ulang file yang sama, file staging lama langsung diganti.
    if (isset($_SESSION['manifest_upload_staging'][$batchId][$field]['filename'])) {
        $oldFilename = basename((string) $_SESSION['manifest_upload_staging'][$batchId][$field]['filename']);
        if ($oldFilename !== '') {
            @unlink($stagingDir . $oldFilename);
        }
    }

    try {
        $filename = bin2hex(random_bytes(16)) . '.' . $valid['extension'];
    } catch (Throwable $e) {
        $filename = uniqid('manifest_', true) . '.' . $valid['extension'];
    }

    if (!move_uploaded_file($valid['tmp_name'], $stagingDir . $filename)) {
        temp_fail($fields[$field]['label'] . ': server gagal menyimpan berkas.', 500);
    }

    $_SESSION['manifest_upload_staging'][$batchId][$field] = array(
        'filename' => $filename,
        'extension' => $valid['extension'],
        'size' => $valid['size'],
        'uploaded_at' => time()
    );
    session_write_close();

    json_reply(array(
        'status' => 'success',
        'message' => $fields[$field]['label'] . ' berhasil disimpan.',
        'field' => $field,
        'size' => $valid['size']
    ));
} catch (TempUploadException $e) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
    }
    $status = (int) $e->getCode();
    if ($status < 400 || $status > 599) {
        $status = 422;
    }
    json_reply(array('status' => 'error', 'message' => $e->getMessage()), $status);
} catch (Throwable $e) {
    error_log('upload_temp.php unexpected error: ' . $e->getMessage());
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
    }
    json_reply(array('status' => 'error', 'message' => 'Server tidak dapat menyimpan berkas sementara. Silakan coba lagi.'), 500);
}
