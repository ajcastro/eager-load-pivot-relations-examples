<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCar extends Pivot
{
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
