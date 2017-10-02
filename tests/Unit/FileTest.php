<?php

namespace Tests\Unit;

use Tests\TestCase;

class FileTest extends TestCase
{

    public function tearDown()
    {
        parent::tearDown();
        rmdir('testDir');
    }

    public function testCreatingFile()
    {
        \App\lib\utils\File::mkDirIfNotExists('testDir');
        $this->assertTrue(file_exists('testDir'));
    }

}