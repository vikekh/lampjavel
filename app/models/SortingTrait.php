<?php

namespace Vikekh\Lampjavel\Api\Models\Traits;

trait SortingTrait {
    public function scopeSort($query, $sort) {
        switch ($sort) {
            case 'asc':
            case 'desc':
                return $query->orderBy('id', $sort);
                break;

            case 'rand':
            case 'random':
                return $query->orderByRaw('rand()');
                break;
            
            default:
                return $query;
                break;
        }
    }
}