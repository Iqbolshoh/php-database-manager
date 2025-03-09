<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// === [DATABASE CONFIGURATION] ===
define("DB_SERVER", $_ENV['DB_SERVER']);
define("DB_USERNAME", $_ENV['DB_USERNAME']);
define("DB_PASSWORD", $_ENV['DB_PASSWORD']);
define("DB_NAME", $_ENV['DB_NAME']);

// // === [SITE SETTINGS] ===
define("SITE_PATH", ($_SERVER['REQUEST_SCHEME'] ?? 'http') . "://" . $_SERVER['HTTP_HOST']);

// // === [TIMEZONE] ===
date_default_timezone_set('Etc/GMT-5');
