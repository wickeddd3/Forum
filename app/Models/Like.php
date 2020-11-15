<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Traits\RecordsActivity;

class Like extends BaseModel
{
    use RecordsActivity;

    public function liked()
    {
        return $this->morphTo();
    }

}
