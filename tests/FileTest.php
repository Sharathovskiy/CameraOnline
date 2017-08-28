<?php
namespace Tests;

use Tests\TestCase;
use App\Utils\File;

class FileTest extends TestCase{
    
    public function tearDown() {
        parent::tearDown();
        rmdir('testDir');
    }
    
    public function testCreatingFile(){
        \App\Utils\File::mkDirIfNotExists('testDir');
        $this->assertTrue(file_exists('testDir'));
    } 
    
}
