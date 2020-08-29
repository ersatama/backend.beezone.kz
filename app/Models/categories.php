<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    public function goods() {
        return $this->hasOne('App\Models\goods', 'id', 'goods_id');
    }
}
