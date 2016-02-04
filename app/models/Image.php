<?php

namespace Vikekh\Lampjavel\Api\Models;

use \Eloquence\Database\Traits\CamelCaseModel as CamelCaseTrait;
use \Illuminate\Database\Eloquent\Model as Model;
use \Vikekh\Lampjavel\Api\Models\Traits\PagingTrait;
use \Vikekh\Lampjavel\Api\Models\Traits\SortingTrait;
use \Vikekh\Lampjavel\Api\Models\Traits\ValidatingTrait;

class Image extends Model {
    use CamelCaseTrait;
    use PagingTrait;
    use SortingTrait;
    use ValidatingTrait;

    protected $fillable = array('url');
    protected $hidden = array(
        'pivot',
        'pivot_channel_id',
        'pivot_image_id'
    );

    public function channels() {
        return $this->belongsToMany('Vikekh\Lampjavel\Api\Models\Channel', 'channel_images',
            'image_id', 'channel_id');
    }

    public function validate() {
        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    } 
}