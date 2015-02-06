<?php

class Image extends \Illuminate\Database\Eloquent\Model {
    protected $fillable = array('channel_name', 'url');
    public $timestamps = false;
}