<?php namespace Vikekh\Lampjavel\Api\Models\Traits;

trait PagingTrait {
    public function scopePage($query, array $params) {
        $pageNumber = 0;
        $pageSize = 0;
        $pageNumberKey = 'pageNumber';
        $pageSizeKey = 'pageSize';

        if (array_key_exists($pageNumberKey, $params) && !empty($params[$pageNumberKey]) &&
                is_numeric($params[$pageNumberKey]) && intval($params[$pageNumberKey]) >= 0) {
            $pageNumber = intval($params[$pageNumberKey]);
        }

        if (array_key_exists($pageSizeKey, $params) && !empty($params[$pageSizeKey]) &&
                is_numeric($params[$pageSizeKey]) && intval($params[$pageSizeKey]) > 0) {
            $pageSize = intval($params[$pageSizeKey]);
        }

        if ($pageNumber > 0) {
            $query->skip($pageNumber*$pageSize);
        }

        if ($pageSize > 0) {
            $query->take($pageSize);
        }

        return $query;
    }
}