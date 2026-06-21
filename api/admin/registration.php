<?php
header("Content-Type: application/json");
require_once '../../config/database.php';

$action = $_GET['action'] ?? '';

// 1. Ambil Semua Data Pendaftar (BPC, BCC, EBPC)
if ($action === 'list') {
    $result = $conn->query("SELECT id, competition_type, team_name, leader_name, final_amount, payment_method, created_at FROM registrations ORDER BY id DESC");
    $list = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }
    echo json_encode($list);
    exit;
}

// 2. Ambil Detail Lengkap Satu Tim berdasarkan ID
if ($action === 'detail') {
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("SELECT * FROM registrations WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak ditemukan."]);
    }
    $stmt->close();
    exit;
}

// 3. Edit / Update Data & Status Verifikasi Pendaftar
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