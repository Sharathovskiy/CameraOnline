<?php

namespace App\Http\Controllers;

class PhotoController {

    function uploadPhoto() {
        $upload_dir = "uploadedPhotos/";
        \App\lib\utils\File::mkDirIfNotExists($upload_dir);
        $img = $_POST['hidden_data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir . time() . ".png";
        file_put_contents($file, $data);
    }
}