<?php

use Eloquence\Database\Traits\CamelCaseModel;

class Channel extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;

    protected $fillable = array('name', 'admin', 'public');
    public $timestamps = false;
}