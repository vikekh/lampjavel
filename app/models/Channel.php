<?php

namespace Vikekh\Lampjavel\Api\Models;

use \Eloquence\Database\Traits\CamelCaseModel as CamelCaseTrait;
use \Illuminate\Database\Eloquent\Model as Model;
use \Vikekh\Lampjavel\Api\Models\Traits\FilterTrait;

class Channel extends Model {
    use CamelCaseTrait;
    use FilterTrait;

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

    public function __construct(array $attributes = array()) {
        $this->isPublic = true;
        parent::__construct($attributes);
    }

    public function images() {
        return $this->belongsToMany('Vikekh\Lampjavel\Api\Models\Image', 'channel_images', 'channel_id', 'image_id');
    }
}