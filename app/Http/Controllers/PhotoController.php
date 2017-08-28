<?php

namespace App\Http\Controllers;

use App\Photo;
use DB;

class PhotoController {

    function uploadPhoto() {
        $dataURL = $_POST['hidden_data'];
        $preparedDataURL = $this->getPreparedDataURL($dataURL);
        $this->uploadPhotoToDb($preparedDataURL);
    }

    /**
     * Removes specific characters from data URL so it can be decoded and saved as a normal file.
     * @param type $dataURL - data URL from 
     * @return type $dataURL
     */
    private function getPreparedDataURL($dataURL) {
        $dataURL = str_replace('data:image/png;base64,', '', $dataURL);
        $dataURL = str_replace(' ', '+', $dataURL);
        return $dataURL;
    }

    /**
     * Decodes and uploads photo to servers directory
     * @param type $preparedDataURL
     */
    function uploadPhotoToServer($preparedDataURL) {
        $upload_dir = "uploadedPhotos/";
        \App\lib\utils\File::mkDirIfNotExists($upload_dir);
        $file = $upload_dir . time() . ".png";
        $data = base64_decode($preparedDataURL);
        file_put_contents($file, $data);
    }

    function uploadPhotoToDb($dataURL) {
        $photo = new Photo();
        $photo->name = time() . '.png';
        $photo->image = $dataURL;
        $photo->save();
    }

    function showPhotosFromDb() {
        $photos = Photo::all();

        foreach ($photos as $photo) {
            echo '<image width="400" height="300" src="data:image/png;base64,' . $photo->image . '" /> ';
        }
    }

}
