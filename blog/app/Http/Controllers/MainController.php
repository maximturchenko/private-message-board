<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Privatemessages;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = Privatemessages::all(); 
        return view('messages.messages', compact('messages')); 
    } 
}
