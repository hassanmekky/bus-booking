<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatReservation extends Model
{
    use HasFactory;
    protected $fillable = ['seat_id','user_id','from_station','to_station'];

    public function seat()
    {
        return $this->belongsTo('App\Models\Seat');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
