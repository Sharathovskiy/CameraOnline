<?php

namespace App\lib;

use DB;

class PaginationHelper {

    private $table,
            $totalRows,
            $itemsPerTableRow,
            $currentPage,
            $rowsPerPage;

    public function __construct($rowsPerPage, $itemsPerTableRow, $pageNumber, $tableName) {
        $this->table = DB::table($tableName);
        $this->itemsPerTableRow = $itemsPerTableRow;
        $this->totalRows = ceil($this->table->count() / $this->itemsPerTableRow);
        $this->currentPage = $pageNumber;
        $this->rowsPerPage = $rowsPerPage;
    }
    
    /**
     * Gets items for page and returns a chunked array, 
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
        $page = $this->table->forPage($this->currentPage, $this->rowsPerPage * $this->itemsPerTableRow);
        $this->currentPage++;
        return $page->get()->chunk($this->itemsPerTableRow);
    }

    public function getTotalPages() {
        $totalPages = ceil($this->totalRows / $this->rowsPerPage);
        return empty($totalPages) ? 1 : $totalPages ;
    }
}
