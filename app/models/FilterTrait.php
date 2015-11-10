<?php

namespace Vikekh\Lampjavel\Api\Models\Traits;

trait FilterTrait {
    public function scopeFilter($query, array $params) {
        if (array_key_exists('sort', $params)) {
            $query->sort($params['sort']);
        }

        if (array_key_exists('offset', $params)) {
            $query->skip(intval($params['offset']));
        }

        if (array_key_exists('limit', $params)) {
            $query->take(intval($params['limit']));
        }

        return $query;
    }

    public function scopeSort($query, $sort) {
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