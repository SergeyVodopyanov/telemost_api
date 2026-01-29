<?php 

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginatorFormatter {
    protected function formatMetaData(LengthAwarePaginator $collection): array
    {
        return [
            'links' => [
                'first' => $collection->url(1),
                'last' => $collection->url($collection->lastPage()),
                'prev' => $collection->previousPageUrl(),
                'next' => $collection->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $collection->currentPage(),
                'from' => $collection->firstItem(),
                'last_page' => $collection->lastPage(),
                'path' => $collection->path(),
                'per_page' => $collection->perPage(),
                'to' => $collection->lastItem(),
                'total' => $collection->total(),
            ],
        ];
    }
}