<?php
/**
 * Konfigurasi database MANIFEST untuk hosting.
 * Isi 3 nilai di bawah dari menu MySQL Databases / Database Management hosting.
 */
error_reporting(0);
ini_set('display_errors', '0');

$host = 'localhost';
$user = 'itsr8765_fes';
$pass = 'n9fvacw@NiyrtEF';
$db   = 'itsr8765_manifest';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode([
        'status' => 'error',
        'message' => 'Koneksi database gagal. Periksa konfigurasi database hosting.'
    ], JSON_UNESCAPED_UNICODE));
}

$conn->set_charset('utf8mb4');

if (!function_exists('base_url')) {
    function base_url() {
        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);

        $protocol = $https ? 'https://' : 'http://';
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';

        // Domain ini dipasang langsung di public_html, bukan /manifest/.
        return $protocol . $host . '/';
    }
}
?>
