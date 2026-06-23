<?php
// Sembunyikan error kasar dari publik demi keamanan informasi server
error_reporting(0);
ini_set('display_errors', 0);

header("Content-Type: application/json");
require_once '../../config/database.php';

// 1. PROTEKSI UTAMA: Validasi Session Login Admin (Anti-Bypass Eksternal)
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(["status" => "error", "message" => "Akses ditolak! Silakan login terlebih dahulu."]);
    exit;
}

$action = $_GET['action'] ?? '';

// 2. Ambil List Semua Data Pendaftar (BPC, BCC, EBPC)
if ($action === 'list') {
    $result = $conn->query("SELECT id, competition_type, team_name, leader_name, final_amount, payment_method, created_at FROM registrations ORDER BY id DESC");
    $list = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }
    echo json_encode($list);
    exit;
}

// 3. Ambil Detail Lengkap Satu Tim berdasarkan ID + Inject URL Berkas Dinamis
if ($action === 'detail') {
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("SELECT * FROM registrations WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        
        // ---- DINAMIS URL GENERATOR FOR HOSTING & LOCALHOST ----
        // Menggunakan fungsi base_url() otomatis dari config/database.php
        $baseUrl = base_url() . "uploads/";
        
        $data['leader_id_scan_url']    = $baseUrl . $data['leader_id_scan'];
        $data['member_id_scan_url']    = $baseUrl . $data['member_id_scan'];
        $data['payment_proof_url']     = $baseUrl . $data['payment_proof'];
        $data['proof_follow_ig_url']   = $baseUrl . $data['proof_follow_ig'];
        $data['proof_repost_feed_url'] = $baseUrl . $data['proof_repost_feed'];
        $data['proof_twibbon_url']     = $baseUrl . $data['proof_twibbon'];
        
        echo json_encode($data);
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak ditemukan."]);
    }
    $stmt->close();
    exit;
}

// 4. Edit / Update Data Pendaftar dari Modal Audit Dasbor
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id               = intval($_POST['id'] ?? 0);
    $team_name        = htmlspecialchars(strip_tags(trim($_POST['team_name'] ?? '')));
    $leader_name      = htmlspecialchars(strip_tags(trim($_POST['leader_name'] ?? '')));
    $leader_whatsapp  = htmlspecialchars(strip_tags(trim($_POST['leader_whatsapp'] ?? '')));
    $member_name      = htmlspecialchars(strip_tags(trim($_POST['member_name'] ?? '')));
    $member_whatsapp  = htmlspecialchars(strip_tags(trim($_POST['member_whatsapp'] ?? '')));

    if ($id <= 0 || empty($team_name) || empty($leader_name)) {
        echo json_encode(["status" => "error", "message" => "Data input tidak valid!"]);
        exit;
    }

    $sql = "UPDATE registrations SET 
                team_name = ?, 
                leader_name = ?, 
                leader_whatsapp = ?, 
                member_name = ?, 
                member_whatsapp = ? 
            WHERE id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $team_name, $leader_name, $leader_whatsapp, $member_name, $member_whatsapp, $id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data registrasi tim berhasil diperbarui!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui data pendaftar."]);
    }
    $stmt->close();
    exit;
}

$conn->close();
?>