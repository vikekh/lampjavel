<?php namespace Vikekh\Lampjavel\Api\Models\Traits;

trait SortingTrait {
    public function scopeSort($query, array $params) {
        $sort = null;
        $sortValues = array('asc', 'ascending', 'desc', 'descending', 'rand', 'random');
        $sortKey = 'sort';

        if (array_key_exists($sortKey, $params) && !empty($params[$sortKey]) &&
                in_array(strtolower($params[$sortKey]), $sortValues)) {
            $sort = strtolower($params[$sortKey]);
        }

        if ($sort === 'asc' || $sort === 'ascending') {
            $query->orderBy('id', 'asc');
        }

        if ($sort === 'desc' || $sort === 'descending') {
            $query->orderBy('id', 'desc');
        }

        if ($sort === 'rand' || $sort === 'random') {
            $query->orderByRaw('rand()');
        }

        return $query;
    }
}