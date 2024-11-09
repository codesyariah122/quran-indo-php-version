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
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
    }

    public function index() {
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
        $model = $this->model('QuranModel');
        $data = $model->getSurah($number);
        echo json_encode($data);
    }

    public function ayat($number, $ayat) {
        $model = $this->model('QuranModel');
        $data = $model->getAyat($number, $ayat);
        echo json_encode($data);
    }

    public function listSurah() {
        $model = $this->model('QuranModel');
        $data = $model->getListSurah();
        echo json_encode($data);
    }
}
