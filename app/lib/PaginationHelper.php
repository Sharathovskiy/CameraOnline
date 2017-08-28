<?php

namespace App\lib;

use DB;

/**
 * Description of PaginationHelper
 *
 * @author Szary
 */
class PaginationHelper {

    private $photos,
            $totalPages,
            $itemsPerPage,
            $currentPage;

    public function __construct($itemsPerPage) {
        $this->photos = DB::table('users_photos');
        $this->itemsPerPage = $itemsPerPage;
        $this->totalPages = ceil($this->photos->count() / $this->itemsPerPage);
        $this->currentPage = 1;
    }

    public function getNextPage() {
        if($this->currentPage > $this->totalPages){
            return;
        }
        $chunk = $this->photos->forPage($this->currentPage, $this->itemsPerPage);
        $this->currentPage++;
        return $chunk->get();
    }

    public function getTotalPages() {
        return $this->totalPages;
    }
}
