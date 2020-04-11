<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Privatemessages;
use App\Http\Requests\CustomRequest;


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


   /**
     * Store user.
     *
     * @return Response
     */
    public function store(CustomRequest $request)
    {

      Privatemessages::create([
            "user_id" => Auth::id(),
            "message" => $request->message,
        ]
      );
      return redirect('/');
    }



}
