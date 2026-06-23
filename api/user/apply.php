<?php
// Matikan tampilan error kasar ke publik agar tidak membocorkan informasi struktur server
error_reporting(0); 
ini_set('display_errors', 0);

header("Content-Type: application/json");
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $base_price = 150000;

    // 1. Sanitasi & Validasi Ketat Kategori Kompetisi (Whitelist)
    $competition_type = $_POST['competition_type'] ?? '';
    if (!in_array($competition_type, ['BPC', 'BCC', 'EBPC'])) {
        echo json_encode(["status" => "error", "message" => "Kategori kompetisi tidak valid!"]);
        exit;
    }

    // 2. Sanitasi Input Teks Pengguna
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

    // ---- TAMBAHAN AMAN: Validasi Kosong & Panjang Data Minimal ----
    if (empty($team_name) || empty($leader_name) || empty($leader_school) || empty($member_name) || empty($member_school) || empty($account_holder)) {
        echo json_encode(["status" => "error", "message" => "Mohon lengkapi seluruh kolom input data tim!"]);
        exit;
    }

    // ---- TAMBAHAN AMAN: Whitelist Validasi Tingkat Kelas (Cegah Penyelundupan Teks Bebas) ----
    if (!in_array($leader_grade, ['10', '11', '12']) || !in_array($member_grade, ['10', '11', '12'])) {
        echo json_encode(["status" => "error", "message" => "Tingkat kelas pilihan tidak valid!"]);
        exit;
    }

    // ---- TAMBAHAN AMAN: Validasi Regex Nomor WhatsApp (Hanya Izinkan Angka 9-15 Digit) ----
    if (!preg_match('/^[0-9]{9,15}$/', $leader_whatsapp) || !preg_match('/^[0-9]{9,15}$/', $member_whatsapp)) {
        echo json_encode(["status" => "error", "message" => "Format nomor WhatsApp tidak valid! Harus berupa angka (9-15 digit)."]);
        exit;
    }

    // 3. Hitung Ulang Nominal di Server (Anti-Tampering)
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

    // 4. Pengecekan & Manajemen Folder Upload
    $upload_dir = "../../uploads/";
    if (!is_dir($upload_dir)) {
        @mkdir($upload_dir, 0755, true);
    }

    /**
     * Helper Upload Berkas Versi Super Aman & Kebal Manipulasi Konten (Anti-Kamuflase File)
     */
    function secureUpload($file, $allowed_exts, $target_dir) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return false;
        
        // Batasi ukuran file (maksimal 5MB)
        if ($file['size'] > 5 * 1024 * 1024) return false;

        // Ambil dan cek ekstensi file luar
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_exts)) return false;

        // Ambil MIME Type asli dari isi biner file (Cegah manipulasi nama berkas)
        if (class_exists('finfo')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $real_mime = $finfo->file($file['tmp_name']);
        } else if (function_exists('mime_content_type')) {
            $real_mime = mime_content_type($file['tmp_name']);
        } else {
            return false; // Tolak unggah jika server tidak mendukung pengecekan tipe data asli berkas
        }
        
        // Validasi silang kecocokan pasangan ekstensi dengan isi konten biner asli
        $check_image = ['image/jpeg', 'image/png', 'image/jpg'];
        $check_pdf   = ['application/pdf'];

        if (in_array($ext, ['jpg', 'jpeg', 'png']) && !in_array($real_mime, $check_image)) return false;
        if ($ext === 'pdf' && !in_array($real_mime, $check_pdf)) return false;

        // Rename nama berkas total menjadi karakter acak unik (Kebal serangan Double Extension bypass)
        $filename = bin2hex(random_bytes(16)) . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
            return $filename;
        }
        return false;
    }

    // Definisi Aturan Ekstensi Berkas
    $pdf_exts  = ['pdf'];
    $img_exts  = ['jpg', 'jpeg', 'png'];

    // Eksekusi Unggah Berkas Persyaratan
    $leader_id_scan   = secureUpload($_FILES['leader_id_scan'] ?? null, $pdf_exts, $upload_dir);
    $member_id_scan   = secureUpload($_FILES['member_id_scan'] ?? null, $pdf_exts, $upload_dir);
    $payment_proof    = secureUpload($_FILES['payment_proof'] ?? null, $img_exts, $upload_dir);
    $proof_follow_ig  = secureUpload($_FILES['proof_follow_ig'] ?? null, $pdf_exts, $upload_dir);
    $proof_repost_feed= secureUpload($_FILES['proof_repost_feed'] ?? null, $pdf_exts, $upload_dir);
    $proof_twibbon    = secureUpload($_FILES['proof_twibbon'] ?? null, $pdf_exts, $upload_dir);

    // Jika salah satu proses verifikasi biner gagal atau file korup/palsu, batalkan transaksi
    if (!$leader_id_scan || !$member_id_scan || !$payment_proof || !$proof_follow_ig || !$proof_repost_feed || !$proof_twibbon) {
        echo json_encode(["status" => "error", "message" => "Gagal mengunggah berkas. Pastikan format sesuai aturan (PDF untuk dokumen kelompok, Gambar JPG/PNG untuk bukti bayar) dan ukuran berkas masing-masing < 5MB."]);
        exit;
    }

    // 5. Simpan Pendaftaran via MySQLi Prepared Statement Native (Kebal SQL Injection)
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
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan ke database."]);
    }
    $stmt->close();
}
$conn->close();
?>