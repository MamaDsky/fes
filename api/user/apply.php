<?php
// Matikan tampilan error HTML kasar agar tidak merusak JSON parser JavaScript
error_reporting(0); 
ini_set('display_errors', 0);

header("Content-Type: application/json");
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $base_price = 150000;

    // 1. Sanitasi Input Teks & Validasi Kategori
    $competition_type = $_POST['competition_type'] ?? '';
    if (!in_array($competition_type, ['BPC', 'BCC', 'EBPC'])) {
        echo json_encode(["status" => "error", "message" => "Kategori kompetisi tidak valid!"]);
        exit;
    }

    $team_name        = htmlspecialchars(strip_tags(trim($_POST['team_name'] ?? '')));
    $leader_name      = htmlspecialchars(strip_tags(trim($_POST['leader_name'] ?? '')));
    $leader_school    = htmlspecialchars(strip_tags(trim($_POST['leader_school'] ?? '')));
    $leader_grade     = htmlspecialchars(strip_tags(trim($_POST['leader_grade'] ?? '')));
    $leader_whatsapp  = htmlspecialchars(strip_tags(trim($_POST['leader_whatsapp'] ?? '')));
    
    $member_name      = htmlspecialchars(strip_tags(trim($_POST['member_name'] ?? '')));
    $member_school    = htmlspecialchars(strip_tags(trim($_POST['member_school'] ?? '')));
    $member_grade     = htmlspecialchars(strip_tags(trim($_POST['member_grade'] ?? '')));
    $member_whatsapp  = htmlspecialchars(strip_tags(trim($_POST['member_whatsapp'] ?? '')));
    
    $account_holder   = htmlspecialchars(strip_tags(trim($_POST['account_holder'] ?? '')));
    $payment_method   = htmlspecialchars(strip_tags(trim($_POST['payment_method'] ?? '')));
    $referral_code    = strtoupper(htmlspecialchars(strip_tags(trim($_POST['referral_code'] ?? ''))));

    // 2. Hitung Ulang Nominal di Server (Anti-Tampering)
    $final_amount = $base_price;
    if (!empty($referral_code)) {
        $stmt_ref = $conn->prepare("SELECT discount_percentage FROM referral_codes WHERE code = ?");
        $stmt_ref->bind_param("s", $referral_code);
        $stmt_ref->execute();
        $res_ref = $stmt_ref->get_result();
        if ($res_ref->num_rows > 0) {
            $row_ref = $res_ref->fetch_assoc();
            $final_amount = $base_price - (($row_ref['discount_percentage'] / 100) * $base_price);
        } else {
            $referral_code = null; 
        }
        $stmt_ref->close();
    }

    // 3. Pengecekan & Manajemen Folder Upload (Path disesuaikan dari posisi api/user/)
    $upload_dir = "../../uploads/";
    if (!is_dir($upload_dir)) {
        @mkdir($upload_dir, 0755, true);
    }

    /**
     * Helper Upload File Alternatif yang Lebih Kompatibel & Super Aman
     */
    function secureUpload($file, $allowed_exts, $target_dir) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return false;
        
        // Batasi ukuran file (maksimal 5MB)
        if ($file['size'] > 5 * 1024 * 1024) return false;

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_exts)) return false;

        // Fallback validasi MIME Type jika class finfo dinonaktifkan di hosting/XAMPP
        if (class_exists('finfo')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $real_mime = $finfo->file($file['tmp_name']);
            
            $check_image = ['image/jpeg', 'image/png', 'image/jpg'];
            $check_pdf   = ['application/pdf'];

            if (in_array($ext, ['jpg', 'jpeg', 'png']) && !in_array($real_mime, $check_image)) return false;
            if ($ext === 'pdf' && !in_array($real_mime, $check_pdf)) return false;
        }

        // Rename file acak unik demi keamanan berkas
        $filename = bin2hex(random_bytes(16)) . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
            return $filename;
        }
        return false;
    }

    // Aturan Ekstensi Berkas
    $pdf_exts  = ['pdf'];
    $img_exts  = ['jpg', 'jpeg', 'png'];

    $leader_id_scan   = secureUpload($_FILES['leader_id_scan'] ?? null, $pdf_exts, $upload_dir);
    $member_id_scan   = secureUpload($_FILES['member_id_scan'] ?? null, $pdf_exts, $upload_dir);
    $payment_proof    = secureUpload($_FILES['payment_proof'] ?? null, $img_exts, $upload_dir);
    $proof_follow_ig  = secureUpload($_FILES['proof_follow_ig'] ?? null, $pdf_exts, $upload_dir);
    $proof_repost_feed= secureUpload($_FILES['proof_repost_feed'] ?? null, $pdf_exts, $upload_dir);
    $proof_twibbon    = secureUpload($_FILES['proof_twibbon'] ?? null, $pdf_exts, $upload_dir);

    if (!$leader_id_scan || !$member_id_scan || !$payment_proof || !$proof_follow_ig || !$proof_repost_feed || !$proof_twibbon) {
        echo json_encode(["status" => "error", "message" => "Gagal mengunggah berkas. Pastikan format sesuai aturan (PDF untuk dokumen, JPG/PNG untuk bukti bayar) dan ukuran < 5MB."]);
        exit;
    }

    // 4. Simpan Pendaftaran via MySQLi Prepared Statement Native
    $sql = "INSERT INTO registrations (
                competition_type, team_name, leader_name, leader_school, leader_grade, leader_id_scan, leader_whatsapp,
                member_name, member_school, member_grade, member_id_scan, member_whatsapp,
                account_holder, payment_method, referral_code_used, final_amount, payment_proof,
                proof_follow_ig, proof_repost_feed, proof_twibbon
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssissss", 
        $competition_type, $team_name, $leader_name, $leader_school, $leader_grade, $leader_id_scan, $leader_whatsapp,
        $member_name, $member_school, $member_grade, $member_id_scan, $member_whatsapp,
        $account_holder, $payment_method, $referral_code, $final_amount, $payment_proof,
        $proof_follow_ig, $proof_repost_feed, $proof_twibbon
    );

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Pendaftaran tim Anda berhasil disimpan!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan ke database: " . $conn->error]);
    }
    $stmt->close();
}
$conn->close();
?>