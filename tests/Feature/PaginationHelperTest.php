<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

/**
 * Description of PaginationHelperTest
 *
 * @author Szary
 */
class PaginationHelperTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    private function getFixture($rows, $itemsPerRow, $pageNumber, $items)
    {
        return new \App\lib\PaginationHelper($rows, $itemsPerRow, $pageNumber, $items);
    }

    public function testForTotalPages()
    {
        //arrange
        $expected = 3;
        $items = new Collection(array(
            'item1' => 'item1',
            'item2' => 'item2',
            'item3' => 'item3',
            'item4' => 'item4',
            'item5' => 'item5',
        ));
        //act
        $result = $this->getFixture(1, 2, 1, $items)->getTotalPages();

        //assert
        $this->assertEquals($expected, $result);
    }

    public function testForTotalPagesFromEmptyCollection()
    {
        //arrange
        $expected = 1;
        $items = new Collection();

        //act
        $result = $this->getFixture(1, 2, 1, $items)->getTotalPages();

        //assert
        $this->assertEquals($expected, $result);
    }

    public function testForGettingNextPage()
    {
        //assert
        $expected = array(
            0 => array('item1' => 'item1', 'item2' => 'item2'),
            1 => array('item3' => 'item3', 'item4' => 'item4')
        );
        $items = new Collection(array(
            'item1' => 'item1',
            'item2' => 'item2',
            'item3' => 'item3',
            'item4' => 'item4',
            'item5' => 'item5',
        ));
        //act
        $result = $this->getFixture(2, 2, 1, $items)->getNextPage();

        //assert
        $this->assertEquals($expected, $result->toArray());
    }


    /**
     * @expectedException \Exception
     */
    public function testForGettingNextPageWithIndexOutOfBounds()
    {
        //assert
        $items = new Collection(array(
            'item1' => 'item1',
            'item2' => 'item2',
            'item3' => 'item3',
            'item4' => 'item4',
            'item5' => 'item5',
        ));
        //act
        $result = $this->getFixture(2, 2, 99, $items)->getNextPage();
    }


    /**
     * @expectedException \Exception
     */
    public function testForConstructWithArray()
    {
        //act
        $this->getFixture(1, 1, 1, array('test' => 'test'));
    }
}
