<?php

namespace Vikekh\Lampjavel\Api\Models;

use \Eloquence\Database\Traits\CamelCaseModel as CamelCaseTrait;
use \Illuminate\Database\Eloquent\Model as Model;
use \Vikekh\Lampjavel\Api\Models\Traits\ValidationTrait;

class Image extends Model {
    use CamelCaseTrait;
    use ValidationTrait;

    protected $fillable = array('url');
    protected $hidden = array(
        'pivot',
        'pivot_channel_name',
        'pivot_image_id'
    );
    public $timestamps = false;

    public function channels() {
        return $this->belongsToMany('Channel', 'channel_images', 'image_id', 'channel_name');
    }

    public function scopeSort($query, $sort) {
        switch ($sort) {
            case 'asc':
            case 'desc':
                return $query->orderBy('id', $sort);
                break;

            case 'rand':
            case 'random':
                return $query->orderByRaw('rand()');
                break;
            
            default:
                return $query;
                break;
        }
    }

    public function validate() {
        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    } 
}