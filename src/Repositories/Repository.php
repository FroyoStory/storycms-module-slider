<?php

namespace Story\Cms\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository
{
    /**
     * Create pagination object collection
     *
     * @param  LengthAwarePaginator  $items
     * @return object
     */
    public function paginator(LengthAwarePaginator $items)
    {
        if ($items->items()) {
            return (object) [
                'items' => $items->items(),
                'pagination' => (object) [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'prev' => $items->previousPageUrl()
                ]
            ];
        }
        return false;
    }
}
