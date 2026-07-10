<?php
/**
 * Fallback bila aturan rewrite hosting membaca URL /admin sebagai admin.php.
 * Redirect ini menjaga akses tetap menuju folder admin yang sebenarnya.
 */
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/admin.php');
$projectBase = rtrim(dirname($scriptName), '/');
$target = ($projectBase === '' || $projectBase === '/') ? '/admin/' : $projectBase . '/admin/';

header('Location: ' . $target, true, 302);
exit;
