<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Privatemessages;
use App\Http\Requests\CustomRequest;
use App\Http\Requests\UpdateMessage;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = Privatemessages::all()->sortByDesc('created_at');
        return view('messages.messages', compact('messages'));
    }


   /**
     * Store message.
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
        return true;
    }


    /**
     * Edit message.
     *
     * @return Response
     */
    public function edit(Privatemessages $message)
    {
        return view('messages.edit', compact('message'));
    }




     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Privatemessages $message, UpdateMessage $request)
    {
        dd($message);
        dd($request);
        /*
        $data = $request->only('title', 'body');
        $data['slug'] = str_slug($data['title']);
        $post->fill($data)->save();
        return back();*/

    // $message->update(request(['lastname','firstname','middlename','phone','email']));
         return redirect('/yep/update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privatemessages $message)
    {
        $message->delete();
        return redirect('/');
    }



}
