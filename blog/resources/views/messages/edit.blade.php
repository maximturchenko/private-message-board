@extends('layouts.app')

@section('content')

@can('update-message' , $message)
    <h2>Редактирование сообщение </h2>
    <form action="/message/{{$message->id}}" method="post" class="form-horizontal" style="margin-bottom: 50px;">
        {{csrf_field()}}
        @method('PUT')
        @include('layouts.errors')
        <div class="control-group">
            <textarea style="width: 100%; height: 50px;" type="password" id="inputText" name="message" placeholder="Ваше сообщение..."
                data-cip-id="inputText">{{$message->message}}</textarea>
        </div>
        <div class="control-group">
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </div>
    </form>
@else
    <p>Вы только можете изменять свои записи</p>
@endcan

@endsection
