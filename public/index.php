<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return callback
 * */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Cek apakah permintaan adalah OPTIONS dan respon dengan status 200 untuk preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	http_response_code(200);
	exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/core/Router.php';

Router::route();

