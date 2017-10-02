<?php

namespace App\lib;

use App\Exceptions\PageNotFoundException;
use App\Exceptions\PhotoNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class PaginationHelper
{

    private $items,
        $itemsPerRow,
        $currentPage,
        $rowsPerPage;

    public function __construct($rowsPerPage, $itemsPerRow, $pageNumber, $items)
    {
        if (!$items instanceof Collection) {
            throw new \Exception('$items have to be a collection!');
        }
        $this->items = $items;
        $this->itemsPerRow = $itemsPerRow;
        $this->currentPage = $pageNumber;
        $this->rowsPerPage = $rowsPerPage;

        if ($pageNumber > $this->getTotalPages()) {
            throw new PageNotFoundException("There is no such page!");
        }
    }

    /**
     * Gets items for page and returns a chunk array,
     * so it can be easily displayed in table rows.
     *
     * @return chunked collection of items that will be displayed.
     * @throws \Exception when trying to access page which is > than
     * total pages.
     */
    public function getNextPage()
    {
        $elementsPerPage = $this->rowsPerPage * $this->itemsPerRow;
        $page = $this->items->forPage($this->currentPage, $elementsPerPage);

        $this->currentPage++;

        return $page->chunk($this->itemsPerRow);
    }

    public function getTotalPages()
    {
        $totalRows = ceil($this->items->count() / $this->itemsPerRow);
        $totalPages = ceil($totalRows / $this->rowsPerPage);
        return empty($totalPages) ? 1 : $totalPages;
    }
}
