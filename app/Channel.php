<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function thread()
    {
        return $this->hasMany(Thread::class);
    }
}
