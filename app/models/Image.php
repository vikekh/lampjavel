<?php

use Eloquence\Database\Traits\CamelCaseModel;

class Image extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;
    
    protected $fillable = array('url');
    public $timestamps = false;

    public function channels()
    {
        return $this->belongsToMany('Channel', 'channel_images', 'channel_name', 'image_id');
    }
}