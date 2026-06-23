<?php
header('Content-Type: application/json');
session_start();
require_once '../../config/database.php';

// PERBAIKAN: Gunakan validasi REQUEST_METHOD standar PHP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill all fields.']);
    exit;
}

// Cari admin di database
$stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    
    // Verifikasi password ber-hash
    if (password_verify($password, $admin['password'])) {
        // Set session jika sukses
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $username;

        echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
exit;
?>