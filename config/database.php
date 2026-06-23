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

function base_url() {
    // 1. Deteksi protokol (http atau https)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
    // 2. Ambil nama host / domain (misal: localhost atau domainanda.com)
    $host = $_SERVER['HTTP_HOST'];
    
    // 3. Ambil request URI bersih tanpa query string (?action=detail dst)
    $request_uri = strtok($_SERVER['REQUEST_URI'], '?');
    
    // 4. Pecah URL berdasarkan tanda '/' untuk membuang folder internal backend
    $segments = explode('/', $request_uri);
    $clean_segments = [];
    
    foreach ($segments as $segment) {
        // Jika menemukan folder 'api' atau 'admin', hentikan pembacaan ke kanan
        if ($segment === 'api' || $segment === 'admin') {
            break;
        }
        $clean_segments[] = $segment;
    }
    
    // 5. Satukan kembali menjadi URL utama proyek (pasti menghasilkan http://localhost/fes-1f4b575b71f2.../)
    $path = implode('/', $clean_segments);
    return $protocol . $host . rtrim($path, '/') . '/';
}
?>