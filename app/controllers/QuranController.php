<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return __constructor
 * */
require_once '../app/core/Controller.php'; 
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

class QuranController extends Controller {
    public function __construct() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Content-Type: application/json');
        header('Accept: application/json');

        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
    }

    public function index() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Content-Type: application/json');
        header('Accept: application/json');

        echo json_encode([
            "author" => "Puji Ermanto <pujiermanto@gmail.com>",
            "message" => "Welcome to AlQuran Indo",
            "api" => [
                "surah" => "/quran/:number",
                "ayat" => "/surah/:number/:ayat"
            ]
        ]);
    }

    public function surah($number) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Content-Type: application/json');
        header('Accept: application/json');

        $model = $this->model('QuranModel');
        $data = $model->getSurah($number);
        echo json_encode($data);
    }

    public function ayat($number, $ayat) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Content-Type: application/json');
        header('Accept: application/json');

        $model = $this->model('QuranModel');
        $data = $model->getAyat($number, $ayat);
        echo json_encode($data);
    }

    public function listSurah() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Content-Type: application/json');
        header('Accept: application/json');
        
        $model = $this->model('QuranModel');
        $data = $model->getListSurah();
        echo json_encode($data);
    }
}
