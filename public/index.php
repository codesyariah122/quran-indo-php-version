<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return response
 * */
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/autoload.php';

use Controllers\QuranController;

$controller = new QuranController();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(200);
    exit();
}

$uri = explode('/', trim(str_replace('/quran-indo', '', $_SERVER['REQUEST_URI']), '/'));

switch ($uri[0]) {
    case 'home':
    $controller->home();
    break;
    case 'quran':
    if (isset($uri[1])) {
        $controller->getSurah($uri[1]);
    } else {
        http_response_code(404);
    }
    break;
    case 'surah':
    if (isset($uri[1]) && isset($uri[2])) {
        $controller->getAyat($uri[1], $uri[2]);
    } else {
        http_response_code(404);
    }
    break;
    case 'list-surah':
    $controller->listSurah();
    break;
    default:
    $controller->emptyEndPoint();
    http_response_code(404);
    break;
}
