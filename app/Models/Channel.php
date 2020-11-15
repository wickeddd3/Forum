<?php

namespace App\Models;

use App\Models\BaseModel;

class Channel extends BaseModel
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
