<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'date', 'price', 'number_guest', 'location' , 'status', 'created_at', 'updated_at', 'category_id'
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}