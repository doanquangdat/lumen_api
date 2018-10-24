<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTour extends Model
{
    protected $table = 'booking_tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'tour_id', 'created_at', 'updated_at'
    ];

    public function tour() {
        return $this->belongsTo('App\Models\Tour', 'tour_id');
    } 
}