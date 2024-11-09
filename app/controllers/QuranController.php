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
        // Menambahkan header CORS untuk akses dari frontend
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header('Content-Type: application/json');
        header('Accept: application/json');
        
        // Memuat file .env jika perlu
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
    }

    public function options() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        http_response_code(200);
        exit;
    }

    // Endpoint untuk menampilkan data dasar
    public function index() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        echo json_encode([
            "message" => "Welcome to Al-Quran API",
            "author" => "Puji Ermanto",
            "api" => [
                "surah" => "/quran/:number",
                "ayat" => "/surah/:number/:ayat"
            ]
        ]);
    }

    // Endpoint untuk menampilkan surah tertentu berdasarkan nomor
    public function surah($number) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $model = $this->model('QuranModel');
        $data = $model->getSurah($number);

        if (!$data) {
            echo json_encode(["error" => "Data not found"]);
            return;
        }
        
        echo json_encode($data);
    }

    // Endpoint untuk menampilkan ayat berdasarkan nomor surah dan ayat
    public function ayat($number, $ayat) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $model = $this->model('QuranModel');
        $data = $model->getAyat($number, $ayat);
        if (!$data) {
            echo json_encode(["error" => "Data not found"]);
            return;
        }

        echo json_encode($data);
    }

    // Endpoint untuk menampilkan daftar surah
    public function listSurah() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $model = $this->model('QuranModel');
        $data = $model->getListSurah();

        if (!$data) {
            echo json_encode(["error" => "Data not found"]);
            return;
        }

        echo json_encode($data);
    }
}
