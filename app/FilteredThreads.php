<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait FilteredThreads
{
    public function scopeLatestThreads($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopePopularThreads($query)
    {
        return $query->where('replies_count', '>', 0)->orderBy('replies_count', 'desc');
    }

    public function scopeOldestThreads($query)
    {
        return $query->orderBy('id', 'asc');
    }

}
