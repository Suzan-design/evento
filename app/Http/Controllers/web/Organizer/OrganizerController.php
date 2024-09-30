<?php

namespace App\Http\Controllers\web\Organizer;

use App\Http\Controllers\Controller;
use App\Models\User\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index(){
        $organizers = Organizer::all();
        return view("organizer.index",compact("organizers"));
    }
    public function show($id){
        $organizer = Organizer::findOrFail($id);
        return view("organizer.show",compact("organizer"));
    }
}
