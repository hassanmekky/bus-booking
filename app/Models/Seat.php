<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function trip()
    {
        return $this->belongsTo('App\Models\Trip');
    }

    public function seat_reservations()
    {
        return $this->hasMany('App\Models\SeatReservation');
    }
}
