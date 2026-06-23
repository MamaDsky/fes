<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access. Please login first.']);
    exit;
}
header("Content-Type: application/json");
require_once '../../config/database.php';

$action = $_GET['action'] ?? '';

// 1. Ambil List Semua Kode Referral
if ($action === 'list') {
    $result = $conn->query("SELECT * FROM referral_codes ORDER BY id DESC");
    $list = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }
    echo json_encode($list);
}

// 2. Tambah Kode Referral Baru beserta Diskon Persen
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $code     = strtoupper(trim($_POST['code'] ?? ''));
    $discount = intval($_POST['discount'] ?? 0);

    if (empty($code) || $discount <= 0) {
        echo json_encode(["status" => "error", "message" => "Format input kode/diskon salah!"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO referral_codes (code, discount_percentage) VALUES (?, ?)");
    $stmt->bind_param("si", $code, $discount);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Kode referral berhasil ditambahkan!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Kode gagal ditambahkan (mungkin duplikat)."]);
    }
    $stmt->close();
}

// 3. Hapus Kode Referral
if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM referral_codes WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Kode referral berhasil dihapus!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menghapus kode."]);
    }
    $stmt->close();
}

$conn->close();
?>