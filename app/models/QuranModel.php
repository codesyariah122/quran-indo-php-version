<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return []
 * */
class QuranModel {
    private $data;

    public function __construct() {
        $json_data = file_get_contents('../quran.json');
        $this->data = json_decode($json_data, true)['data'];
    }

    public function getSurah($number) {
        $surah = array_filter($this->data, fn($d) => $d['number'] == $number);
        return $surah ? array_values($surah)[0] : ["message" => "Surah not found"];
    }

    public function getAyat($number, $ayat) {
        $surah = $this->getSurah($number);
        if (isset($surah['verses'])) {
            $verse = array_filter($surah['verses'], fn($v) => $v['number']['inSurah'] == $ayat);
            return $verse ? array_values($verse)[0] : ["message" => "Ayat not found"];
        }
        return ["message" => "Surah not found"];
    }

    public function getListSurah() {
        return array_map(fn($d) => ["number" => $d["number"], "name" => $d["name"]], $this->data);
    }
}
