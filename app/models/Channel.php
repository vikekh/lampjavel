<?php

namespace Vikekh\Lampjavel\Api\Models;

use \Eloquence\Database\Traits\CamelCaseModel as CamelCaseTrait;
use \Illuminate\Database\Eloquent\Model as Model;

class Channel extends Model {
    use CamelCaseTrait;

    protected $fillable = array(
        'id',
        'isPublic'
    );
    protected $hidden = array(
        'pivot',
        'pivot_channel_id',
        'pivot_image_id'
    );
    public $incrementing = false;

    public function images() {
        return $this->belongsToMany('Image', 'channel_images', 'channel_name', 'image_id');
    }
}