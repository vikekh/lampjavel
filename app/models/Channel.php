<?php

namespace Vikekh\Lampjavel\Api\Models;

use \Eloquence\Database\Traits\CamelCaseModel as CamelCaseTrait;
use \Illuminate\Database\Eloquent\Model as Model;

class Channel extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseTrait;

    protected $fillable = array(
        'id',
        'is_public'
    );
    protected $hidden = array(
        'pivot',
        'pivot_channel_id',
        'pivot_image_id'
    );

    public function images() {
        return $this->belongsToMany('Image', 'channel_images', 'channel_name', 'image_id');
    }
}