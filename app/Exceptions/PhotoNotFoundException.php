<?php
/**
 * Created by PhpStorm.
 * User: Szary
 * Date: 2017-10-02
 * Time: 12:23
 */

namespace App\Exceptions;


class PhotoNotFoundException extends \Exception implements IExceptionRenderer
{
    public function render($exception)
    {
        return response()->view('pages.error', ['errorMsg' => $exception->getMessage()]);
    }
}