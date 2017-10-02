<?php
/**
 * Created by PhpStorm.
 * User: Szary
 * Date: 2017-10-02
 * Time: 13:00
 */

namespace App\Exceptions;


interface IExceptionRenderer
{
    public function render($exception);
}