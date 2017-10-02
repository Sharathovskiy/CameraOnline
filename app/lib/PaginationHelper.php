<?php

namespace App\lib;

class PaginationHelper {

    private $items,
            $totalRows,
            $itemsPerRow,
            $currentPage,
            $rowsPerPage;

    public function __construct($rowsPerPage, $itemsPerRow, $pageNumber, $items) {
        if(! $items instanceof \Illuminate\Database\Eloquent\Collection){
            throw new \Exception('$items have to be a collection!');
        }
        $this->items = $items;
        $this->itemsPerRow = $itemsPerRow;
        $this->totalRows = ceil($this->items->count() / $this->itemsPerRow);
        $this->currentPage = $pageNumber;
        $this->rowsPerPage = $rowsPerPage;
    }
    
    /**
     * Gets items for page and returns a chunk array, 
     * so it can be easily displayed in table rows.
     * 
     * @return chunked collection of items that will be displayed.
     * @throws \Exception when trying to access page which is > than
     * total pages.
     */
    public function getNextPage(){
        if($this->currentPage > $this->getTotalPages()){
            throw new \Exception("There is no such page!");
        }
        $elementsPerPage = $this->rowsPerPage * $this->itemsPerRow;
        $page = $this->items->forPage($this->currentPage, $elementsPerPage);
        
        $this->currentPage++;
        return $page->chunk($this->itemsPerRow);
    }

    public function getTotalPages() {
        $totalPages = ceil($this->totalRows / $this->rowsPerPage);
        return empty($totalPages) ? 1 : $totalPages ;
    }
}
