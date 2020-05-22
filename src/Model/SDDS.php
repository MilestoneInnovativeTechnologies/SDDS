<?php

namespace Milestone\SDDS\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SDDS extends Model
{
    protected $table = 'sdds';
    protected $guarded = [];

    protected static function booted()
    {
        static::saved(function(){ Cache::forget(config('sdds.cache')); });
    }
}
