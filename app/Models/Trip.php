<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->belongsToMany('App\Models\City')
            ->withPivot('number');
    }

    public function from()
    {
        return $this->cities->toArray();
    }
}
