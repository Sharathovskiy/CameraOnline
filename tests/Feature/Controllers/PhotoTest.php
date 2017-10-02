<?php
/**
 * Created by PhpStorm.
 * User: Szary
 * Date: 2017-10-02
 * Time: 17:23
 */

namespace Tests\Feature\Controllers;

use App\Http\Controllers\PhotoController;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Description of PaginationHelperTest
 *
 * @author Szary
 */
class PhotoTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testShow()
    {
        //arrange
        $photo = factory(\App\Photo::class)->create();
        $user = User::find($photo->user_id);

        //act
        $response = $this->actingAs($user)->call('GET', '/photo/1', ['photo' => $photo]);

        //assert
        $response->assertViewIs('pages.photo');
    }

    public function testDelete()
    {
        //arrange
        $photo = factory(\App\Photo::class)->create();
        $user = User::find($photo->user_id);

        //act
        $response = $this->actingAs($user)->call('DELETE', '/photo/' . $photo->id);

        //assert
        $response->isRedirect(back());
    }

    public function testUpload()
    {
        //arrange
        $user = factory(\App\User::class)->create();
        $_POST = array(
            'hidden_data' => PhotoController::IMAGE_PREFFIX . 'dataUrl'
        );
        //act
        $response = $this->actingAs($user)->call('POST', '/photo/' );

        //assert
        $response->assertViewIs('pages.home');
        $response->assertViewHas(['isUploaded' => true]);
    }


    public function testUploadWithInvalidDataUrl()
    {
        //arrange
        $user = factory(\App\User::class)->create();
        $_POST = array(
            'hidden_data' => 'dataUrl'
        );
        //act
        $response = $this->actingAs($user)->call('POST', '/photo/' );

        //assert
        $response->assertStatus(500);
    }

    public function testForAddingDuplicatedPhoto()
    {
        //arrange
        $user = factory(\App\User::class)->create();
        $photo = factory(\App\Photo::class)->create([
            'image' => 'dataUrl',
            'user_id' => $user->id
        ]);

        $_POST = array(
            'hidden_data' => PhotoController::IMAGE_PREFFIX . 'dataUrl'
        );
        //act
        $response = $this->actingAs($user)->call('POST', '/photo/' );

        //assert
        $response->assertStatus(500);
    }

    public function testForAddingAboveMaxPhotosCount()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\Photo::class, $user->max_photos_count)->create();

        //act
        $response = $this->actingAs($user)->call('POST', '/photo/' );

        //assert
        $response->assertStatus(500);
    }
}