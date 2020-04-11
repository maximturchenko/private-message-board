@extends('layouts.app')

@section('content')

    @if(Auth::user())
        <form action="/add/mes" method="post" class="form-horizontal" style="margin-bottom: 50px;">
            <div class="alert alert-error">
                Сообщение не может быть пустым
            </div>
            <div class="control-group">
                <textarea style="width: 100%; height: 50px;" type="password" id="inputText" placeholder="Ваше сообщение..."
                    data-cip-id="inputText"></textarea>
            </div>
            <div class="control-group">
                <button type="submit" class="btn btn-primary">Отправить сообщение</button>
            </div>
        </form>
    @endif

    @foreach($messages as $mes)
        <div class="well">
            <h5>{{$mes->created_at}} {{ $mes->user->name }}:</h5>
            {{$mes->message}}
        </div>
    @endforeach
@endsection
