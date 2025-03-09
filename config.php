<?php
// === [DATABASE CONFIGURATION] ===

define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "php_database_menager");

// Dynamically determine the base site URL
define("SITE_PATH", ($_SERVER['REQUEST_SCHEME'] ?? 'http') . "://" . $_SERVER['HTTP_HOST']);

// Set the system timezone to GMT-5
date_default_timezone_set('Etc/GMT-5');

// Define user roles and their corresponding dashboard paths
define('ROLES', [
    'admin' => '/admin/',
    'user' => '/'
]);