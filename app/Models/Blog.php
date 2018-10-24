<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'content', 'view', 'like', 'author_id', 'created_at	', 'updated_at'
    ];

    public function author() {
        return $this->belongsTo('App\Models\Author', 'author_id');
    }
}