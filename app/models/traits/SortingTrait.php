<?php namespace Vikekh\Lampjavel\Api\Models\Traits;

trait SortingTrait {
    public function scopeSort($query, array $params) {
        $sort = null;

        $sortKey = 'sort';

        //if (array_key_exists($sortKey, $params) && !empty($params[$sortKey]) &&
        //        is_numeric($params[$pageNumberKey]) && intval($params[$pageNumberKey]) >= 0) {

        switch ($sort) {
            case 'asc':
            case 'desc':
                $query->orderBy('id', $sort);
                break;

            case 'rand':
            case 'random':
                $query->orderByRaw('rand()');
                break;
        }

        return $query;
    }
}