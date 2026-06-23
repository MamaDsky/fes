<?php
error_reporting(0);
ini_set('display_errors', 0);

$host = "localhost";
$user = "root";
$pass = "";
$db   = "manifest_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal: " . $conn->connect_error]));
}

// Fungsi base_url yang aman dan tidak merusak segmentasi AJAX API
function base_url() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    
    // Cara paling aman: Cukup ambil nama subfolder proyek secara langsung dari script name pembuka
    $project_path = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    
    // Jika diakses dari dalam folder api/user/ atau admin/, bersihkan path-nya agar kembali ke root proyek
    $project_path = preg_replace('/(api\/user\/|api\/admin\/|admin\/|config\/)$/', '', $project_path);
    
    return $protocol . $host . rtrim($project_path, '/') . '/';
}
?>