<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return __construct
 * */

namespace Models;

class Quran
{
    private $data;

    public function __construct()
    {
        $filePath = __DIR__ . '/../data/quran.json';

        if (!file_exists($filePath)) {
            die(json_encode(['message' => 'JSON file not found at ' . $filePath]));
        }

        $jsonContent = file_get_contents($filePath);

        if ($jsonContent === false || empty(trim($jsonContent))) {
            die(json_encode(['message' => 'Failed to read JSON file or the file is empty']));
        }

        $this->data = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            die(json_encode(['message' => 'Error parsing JSON data: ' . json_last_error_msg()]));
        }
    }


    public function getSurah($number)
    {
        foreach ($this->data['data'] as $surah) {
            if ($surah['number'] == $number) {
                return $surah;
            }
        }
        return null;
    }

    public function getAyat($number, $ayat)
    {
        foreach ($this->data['data'] as $surah) {
            if ($surah['number'] == $number) {
                foreach ($surah['verses'] as $verse) {
                    if ($verse['number']['inSurah'] == $ayat) {
                        return $verse;
                    }
                }
            }
        }
        return null;
    }

    public function listSurah()
    {
        $listSurah = [];
        foreach ($this->data['data'] as $surah) {
            $audioList = [];
            foreach ($surah['verses'] as $verse) {
                $audioList[] = $verse['audio']['primary'];
            }

            $listSurah[] = [
                'number' => $surah['number'],
                'name' => $surah['name'],
                'audios' => $audioList
            ];
        }
        return $listSurah;
    }
}
