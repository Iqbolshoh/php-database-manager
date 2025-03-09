<?php
// === [DATABASE CONFIGURATION] ===
define("DB_SERVER", 'localhost');
define("DB_USERNAME", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'php_database_menager');

// // === [SITE SETTINGS] ===
define("SITE_PATH", ($_SERVER['REQUEST_SCHEME'] ?? 'http') . "://" . $_SERVER['HTTP_HOST']);

// // === [TIMEZONE] ===
date_default_timezone_set('Etc/GMT-5');