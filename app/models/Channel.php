<?php

use Eloquence\Database\Traits\CamelCaseModel;

class Channel extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;

    protected $fillable = array(
        'name',
        'public'
    );
    protected $hidden = array(
        'pivot',
        'pivot_channel_name',
        'pivot_image_id'
    );
    public $primaryKey = 'name';
    public $timestamps = false;

    public function images() {
        return $this->belongsToMany('Image', 'channel_images', 'channel_name', 'image_id');
    }
}