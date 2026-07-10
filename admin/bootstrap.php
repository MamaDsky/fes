<?php
/**
 * Helper path untuk halaman admin.
 * Membuat URL admin tetap benar saat website dipasang di domain utama
 * maupun di dalam subfolder, serta memperbaiki akses /admin tanpa slash.
 */

function manifest_admin_base_path(): string
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/admin/index.php');

    // Tetap menemukan folder /admin baik URL dibuka sebagai /admin/login
    // maupun /admin/login.php (termasuk ketika hosting melakukan rewrite URL).
    if (preg_match('#^(.*?/admin)(?:/|$)#', $scriptName, $matches)) {
        return rtrim($matches[1], '/') ?: '/admin';
    }

    $base = rtrim(dirname($scriptName), '/');
    return $base === '' ? '/admin' : $base;
}

function manifest_project_base_path(): string
{
    $adminBase = manifest_admin_base_path();
    $projectBase = rtrim(dirname($adminBase), '/');

    return $projectBase === '/' ? '' : $projectBase;
}

function manifest_admin_url(string $path = ''): string
{
    $base = rtrim(manifest_admin_base_path(), '/');
    $path = ltrim($path, '/');

    return $path === '' ? $base . '/' : $base . '/' . $path;
}

function manifest_admin_api_url(string $path = ''): string
{
    $base = rtrim(manifest_project_base_path(), '/');
    $url = ($base === '' ? '' : $base) . '/api/admin/';
    $path = ltrim($path, '/');

    return $path === '' ? $url : $url . $path;
}

function manifest_start_admin_session(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function manifest_canonicalize_admin_root(): void
{
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
    $adminBase = rtrim(manifest_admin_base_path(), '/');

    // Ketika URL /admin (tanpa slash) menjalankan index.php, relative redirect
    // seperti "login.php" akan terbaca sebagai /login.php. Paksa ke /admin/ dulu.
    if ($requestPath === $adminBase) {
        header('Location: ' . manifest_admin_url(), true, 302);
        exit;
    }
}
