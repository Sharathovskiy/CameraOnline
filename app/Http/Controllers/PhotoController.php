<?php

namespace App\Http\Controllers;

use App\Exceptions\DatabaseException;
use App\Exceptions\NotLoggedInException;
use App\Exceptions\PhotoNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\lib\PaginationHelper;

class PhotoController extends Controller
{
    const IMAGE_PREFFIX = 'data:image/png;base64,';

    public function uploadPhoto()
    {
        $dataURL = $_POST['hidden_data'];
        $preparedDataURL = $this->getPreparedDataURL($dataURL);

        if (!$this->uploadPhotoToDb($preparedDataURL)) {
            throw new DatabaseException('The photo could not be saved.');
        };

        return view('pages.home', ['isUploaded' => true]);
    }

    /**
     * Removes specific characters from data URL so it can be decoded and saved as a normal file.
     *
     * @param type $dataUrl - image' src value
     * @return type $dataUrl
     */
    private function getPreparedDataURL($dataUrl)
    {
        $dataUrl = str_replace(self::IMAGE_PREFFIX, '', $dataUrl);
        $dataUrl = str_replace(' ', '+', $dataUrl);
        return $dataUrl;
    }


    /**
     * Uploads photo to database.
     *
     * @param $dataUrl - image' src value
     * @return mixed bool - indicates whether photo is uploaded.
     * @throws NotLoggedInException
     */
    private function uploadPhotoToDb($dataUrl)
    {
        if (Auth::guest()) {
            throw new NotLoggedInException("You need to login in order to add photos!");
        }
        $photo = new Photo();
        $photo->name = time() . '.png';
        $photo->image = $dataUrl;

        $user = Auth::user();

        if ($this->checkIfPhotoAlreadyExists($user, $photo->image)){
            return false;
        }
        $isUploaded = $user->photos()->save($photo);

        return $isUploaded;
    }

    /**
     * Compares dataUrl with each of user's photo and returns true if this photo already exists
     *
     * @param $user
     * @param $dataUrl
     * @return bool - indicates whether photo with given dataUrl already exists in user's photos.
     */
    private function checkIfPhotoAlreadyExists($user, $dataUrl)
    {
        $photos = $user->photos()->get();

        foreach ($photos as $photo) {
            if ($photo->image == $dataUrl)
                return true;
        }
        return false;
    }


    /**
     * Shows all of the users photos.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws NotLoggedInException
     */
    public function showUserPhotos()
    {
        if (Auth::guest()) {
            throw new NotLoggedInException("You need to login in order to see photos!");
        }
        $pageNumber = 1;
        if (array_key_exists('page', $_GET)) {
            $pageNumber = $_GET['page'];
        };

        $photos = Photo::where('user_id', '=', Auth::id())->get();

        $rowsPerPage = 2;
        $itemsPerRow = 5;
        $paginator = new PaginationHelper($rowsPerPage, $itemsPerRow, $pageNumber, $photos);

        return view('pages.photos', ['paginator' => $paginator, 'page' => $pageNumber]);
    }

    /**
     * Shows the photo with given ID, each user has it's separate group of ID's
     * For example: user XYZ has 3 photos, to his first photo we may access
     * by link /photo/1, to second through /photo/2 etc.
     *
     * @param $photoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws PhotoNotFoundException
     */
    public function showPhoto($photoId)
    {
        $photos = Photo::where('user_id', '=', Auth::id())->get();

        $photo = $photos->get($photoId - 1);

        if ($photo == null) {
            throw new PhotoNotFoundException('Photo not found');
        }

        return view('pages.photo', ['photo' => $photo]);
    }

    /**
     * Deletes the photo with given ID.
     */
    public function deletePhoto($photoId)
    {
        $photos = Photo::where('user_id', '=', Auth::id())->get();

        $photo = $photos->where('id', $photoId)->first();

        if ($photo == null) {
            throw new PhotoNotFoundException('Photo not found');
        }

        $photo->delete();

        return redirect()->back();
    }

    /**
     * Decodes and uploads photo to servers directory
     *
     * @param type $preparedDataURL
     */
    private function uploadPhotoToTheServer($preparedDataURL)
    {
        $upload_dir = "uploadedPhotos/";
        \App\lib\utils\File::mkDirIfNotExists($upload_dir);
        $file = $upload_dir . time() . ".png";
        $data = base64_decode($preparedDataURL);
        file_put_contents($file, $data);
    }
}
