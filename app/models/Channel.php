<?php

class Channel extends \Illuminate\Database\Eloquent\Model {
    protected $fillable = array('name', 'admin', 'public');
    public $timestamps = false;
}