<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'content', 'status', 'tour_id', 'blog_id'
    ];

    /**
     * @function tour
     */
    public function tour() {
        return $this->belongsTo('App\Models\Tour', 'tour_id');
    }

    /**
     * @function blog
     */
    public function blog() {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }
}