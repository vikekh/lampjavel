<?php

use Eloquence\Database\Traits\CamelCaseModel;

class Image extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;
    
    protected $fillable = array('channel_name', 'url');
    public $timestamps = false;
}