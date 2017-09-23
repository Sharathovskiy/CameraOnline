<?php

namespace App\Http\Controllers;

use App\Photo;
use App\lib\PaginationHelper;
use DB;

class PhotoController extends Controller {

    const IMAGE_PREFFIX = 'data:image/png;base64,';
    
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
        $dataURL = str_replace(self::IMAGE_PREFFIX, '', $dataURL);
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
        $paginationHelper = new PaginationHelper(5, PHOTO::TABLE_NAME);
        return view('pages.photos', ['paginationHelper' => $paginationHelper]);
    }
    
    function showPhoto($photoId){
        $photo = DB::table(Photo::TABLE_NAME)->where('id', '=', $photoId)->first();
        return view('pages.photo', ['photo' => $photo]);
    }
}
