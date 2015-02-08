<?php

use Eloquence\Database\Traits\CamelCaseModel;

class Channel extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;

    protected $fillable = array('name', 'public');
    public $primaryKey = 'name';
    public $timestamps = false;

    public function images()
    {
        return $this->belongsToMany('Image', 'channel_images', 'channel_name', 'image_id');
    }
}