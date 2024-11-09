<?php
namespace Controllers;

use Models\Quran;

class QuranController
{
    private $quran;

    public function __construct()
    {
        $this->quran = new Quran();
    }

    public function home()
    {
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
        $data = $this->quran->getSurah($number);
        echo json_encode([
            'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
            'message' => "Surah number $number",
            'data' => $data
        ]);
    }

    public function getAyat($number, $ayat)
    {
        $data = $this->quran->getAyat($number, $ayat);
        echo json_encode([
            'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
            'message' => "Surah number $number / Ayat $ayat",
            'data' => $data
        ]);
    }

    public function listSurah()
    {
        $data = $this->quran->listSurah();
        echo json_encode([
            'author' => 'Puji Ermanto <pujiermanto@gmail.com>',
            'message' => 'Fetch list surah',
            'data' => $data
        ]);
    }
}
