<?php

use Eloquence\Database\Traits\CamelCaseModel;

class Image extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;
    
    protected $fillable = array('url');
    protected $hidden = array('pivot', 'pivot_channel_name', 'pivot_image_id');
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
}