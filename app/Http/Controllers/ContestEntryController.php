<?php

namespace App\Http\Controllers;

use App\Models\ContestEntry;
use Illuminate\Http\Request;
use App\Events\NewEntryReceivedEvent;

class ContestEntryController extends Controller
{
    public function store(Request $request){

       

        $data = $request->validate([
            'email' => 'required|email',
        ]);

        ContestEntry::create($data);

        //event(NewEntryReceivedEvent::class);
        NewEntryReceivedEvent::dispatch();
     
    }
}