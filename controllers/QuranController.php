<?php
namespace Controllers;

use Models\Quran;

class QuranController
{
    private $quran;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header('Content-Type: application/json');

        $this->quran = new Quran();
    }

    public function home()
    {
        header('Content-Type: application/json');
        echo json_encode([
            'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
            'message' => 'Welcome to AlQuran Indo',
            'api' => [
                'surah' => '/quran/{number}',
                'ayat' => '/surah/{number}/{ayat}'
            ]
        ]);
    }

    public function getSurah($number)
    {
        try {
            header('Content-Type: application/json');
            $data = $this->quran->getSurah($number);
            echo json_encode([
                'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
                'message' => "Surah number $number",
                'data' => $data
            ]);    
        } catch(Exception $e) {
            echo json_encode([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getAyat($number, $ayat)
    {
        try {
            header('Content-Type: application/json');
            $data = $this->quran->getAyat($number, $ayat);
            echo json_encode([
                'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
                'message' => "Surah number $number / Ayat $ayat",
                'data' => $data
            ]);
        } catch(Exception $e) {
            echo json_encode([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function listSurah()
    {
        try {
            header('Content-Type: application/json');
            $data = $this->quran->listSurah();
            echo json_encode([
                'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
                'message' => 'Fetch list surah',
                'data' => $data
            ]);
            exit;
        } catch(Exception $e) {
            echo json_encode([
                'message' => $e->getMessage()
            ]);
        }
    }


    public function emptyEndPoint()
    {
        try {
            $data = [
                'author' => 'puji Ermanto <pujiermanto@gmail.com>',
                'message' => 'Endpoint Not Found, please follow the home'
            ];
            echo json_encode($data);
        } catch(Exception $e) {
            echo json_encode([
                'message' => $e->getMessage()
            ]);
        }
    }
}
