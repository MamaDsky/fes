<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => 'Akses tidak diizinkan. Silakan login sebagai admin terlebih dahulu.'
    ]);
    exit;
}

require_once '../../config/database.php';

function sendJson(array $payload, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode($payload);
    exit;
}

$action = $_GET['action'] ?? '';

// 1. Ambil seluruh kode referral.
// Kolom discount_amount berisi nominal rupiah, misalnya 10000 = Rp10.000.
if ($action === 'list') {
    $result = $conn->query('SELECT id, code, discount_amount FROM referral_codes ORDER BY id DESC');

    if (!$result) {
        sendJson([
            'status' => 'error',
            'message' => 'Gagal memuat data referral. Pastikan struktur tabel sudah memakai kolom discount_amount.'
        ], 500);
    }

    $list = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }

    $result->free();
    $conn->close();
    sendJson($list);
}

// 2. Tambah kode referral dengan diskon nominal rupiah.
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = strtoupper(trim((string) ($_POST['code'] ?? '')));
    $discountInput = trim((string) ($_POST['discount'] ?? ''));

    // Kode hanya boleh huruf, angka, underscore, atau strip agar aman dan konsisten.
    if ($code === '' || !preg_match('/^[A-Z0-9_-]{3,50}$/', $code)) {
        sendJson([
            'status' => 'error',
            'message' => 'Kode referral harus terdiri dari 3–50 karakter: huruf, angka, strip, atau underscore.'
        ], 422);
    }

    // Form admin meminta angka polos: 10000 berarti Rp10.000.
    if ($discountInput === '' || !preg_match('/^\d+$/', $discountInput)) {
        sendJson([
            'status' => 'error',
            'message' => 'Nominal diskon harus berupa angka tanpa titik atau koma. Contoh: 10000.'
        ], 422);
    }

    $discountAmount = (int) $discountInput;

    if ($discountAmount < 1000 || $discountAmount > 10000000) {
        sendJson([
            'status' => 'error',
            'message' => 'Nominal diskon harus berada di antara Rp1.000 hingga Rp10.000.000.'
        ], 422);
    }

    $stmt = $conn->prepare('INSERT INTO referral_codes (code, discount_amount) VALUES (?, ?)');

    if (!$stmt) {
        sendJson([
            'status' => 'error',
            'message' => 'Sistem tidak dapat menyiapkan data referral.'
        ], 500);
    }

    $stmt->bind_param('si', $code, $discountAmount);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        sendJson([
            'status' => 'success',
            'message' => 'Kode referral berhasil ditambahkan dengan potongan Rp' . number_format($discountAmount, 0, ',', '.') . '.'
        ]);
    }

    $isDuplicateCode = $conn->errno === 1062;
    $stmt->close();
    $conn->close();

    sendJson([
        'status' => 'error',
        'message' => $isDuplicateCode
            ? 'Kode referral tersebut sudah digunakan. Gunakan kode lain.'
            : 'Kode referral gagal ditambahkan.'
    ], $isDuplicateCode ? 409 : 500);
}

// 3. Hapus kode referral.
if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id || $id <= 0) {
        sendJson([
            'status' => 'error',
            'message' => 'ID referral tidak valid.'
        ], 422);
    }

    $stmt = $conn->prepare('DELETE FROM referral_codes WHERE id = ?');

    if (!$stmt) {
        sendJson([
            'status' => 'error',
            'message' => 'Sistem tidak dapat menyiapkan penghapusan data.'
        ], 500);
    }

    $stmt->bind_param('i', $id);

    if (!$stmt->execute()) {
        $stmt->close();
        $conn->close();

        sendJson([
            'status' => 'error',
            'message' => 'Kode referral gagal dihapus.'
        ], 500);
    }

    $affectedRows = $stmt->affected_rows;
    $stmt->close();
    $conn->close();

    if ($affectedRows === 0) {
        sendJson([
            'status' => 'error',
            'message' => 'Kode referral tidak ditemukan atau sudah dihapus.'
        ], 404);
    }

    sendJson([
        'status' => 'success',
        'message' => 'Kode referral berhasil dihapus.'
    ]);
}

sendJson([
    'status' => 'error',
    'message' => 'Aksi API tidak valid.'
], 400);
?>