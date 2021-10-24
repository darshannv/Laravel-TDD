<?php

namespace App\Models;

use App\Events\NewEntryReceivedEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContestEntry extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted(){

        static::created(function($contest){
            NewEntryReceivedEvent::dispatch();
        });
    }
}
