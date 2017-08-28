<?php

namespace App\lib\utils;

class File {

    public static function mkDirIfNotExists($dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}