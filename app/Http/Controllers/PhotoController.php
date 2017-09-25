<?php

namespace App\Http\Controllers;

use App\Photo;
use App\lib\PaginationHelper;
use DB;

class PhotoController extends Controller {

    const IMAGE_PREFFIX = 'data:image/png;base64,';
    
    public function uploadPhoto() {
        $dataURL = $_POST['hidden_data'];
        $preparedDataURL = $this->getPreparedDataURL($dataURL);
        
        if(!$this->uploadPhotoToDb($preparedDataURL)){
            throw new \Illuminate\Database\QueryException('The photo could not be saved.');
            
        };
        return redirect()->back();
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
    
    private function uploadPhotoToDb($dataURL) {
        $photo = new Photo();
        $photo->name = time() . '.png';
        $photo->image = $dataURL;
        $isUploaded = $photo->save();
        return $isUploaded;
    }

    public function showPhotosFromDb() {
        $paginationHelper = new PaginationHelper(5, PHOTO::TABLE_NAME);
        return view('pages.photos', ['paginationHelper' => $paginationHelper]);
    }
    
    public function showPhoto($photoId){
        $photo = Photo::findOrFail($photoId);
        return view('pages.photo', ['photo' => $photo]);
    }
    
    public function deletePhoto($photoId){
        $photo = Photo::findOrFail($photoId);
        $photo->delete();
        return redirect()->back();
    }
    
    /**
     * Decodes and uploads photo to servers directory
     * @param type $preparedDataURL
     */
    private function uploadPhotoToTheServer($preparedDataURL) {
        $upload_dir = "uploadedPhotos/";
        \App\lib\utils\File::mkDirIfNotExists($upload_dir);
        $file = $upload_dir . time() . ".png";
        $data = base64_decode($preparedDataURL);
        file_put_contents($file, $data);
    }
}
