<?php

namespace App\Utils;

class File {

    public static function mkDirIfNotExists($dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}