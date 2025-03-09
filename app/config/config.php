<?php
// === [LOAD ENV CONFIGURATION] ===
$env = parse_ini_file(__DIR__ . '/../.env');

// === [DATABASE CONFIGURATION] ===
define("DB_SERVER", $env['DB_SERVER']);
define("DB_USERNAME", $env['DB_USERNAME']);
define("DB_PASSWORD", $env['DB_PASSWORD']);
define("DB_NAME", $env['DB_NAME']);

// === [SITE SETTINGS] ===
define("SITE_PATH", $env['SITE_PATH']);

// === [TIMEZONE] ===
date_default_timezone_set($env['TIMEZONE']);