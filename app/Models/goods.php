<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class goods extends Model
{
    public function categories() {
        return $this->belongsTo('App\Models\categories');
    }
}
