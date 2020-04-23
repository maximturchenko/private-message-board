@extends('layouts.app')

@section('content')
<div class="span4"></div>
<div class="span8">
    <form action="{{ route('register') }}" method="post" class="form-horizontal">
        @csrf
        <div class="control-group">
            <b> {{ __('Регистрация') }}</b>
        </div>
        <div class="control-group error">
            <input type="text" id="name" name="name" placeholder="Логин" data-cip-id="name"
                   autocomplete="off" value="{{ old('name') }}" required>
                @error('name')
                   <span class="help-inline">    {{ $message }}</span>
                @enderror
        </div>
        <div class="control-group error">
            <input type="email" id="email" name="email" placeholder="Email"
                   data-cip-id="email" required autocomplete="email" value="{{ old('email') }}">
             @error('email')
                 <span class="help-inline">  {{ $message }} </span>
              @enderror
        </div>
        <div class="control-group error">
            <input type="password" id="password" name="password" placeholder="Пароль"
                   data-cip-id="password" required autocomplete="new-password">
             @error('password')
              <span class="help-inline">  {{ $message }} </span>
              @enderror
        </div>
        <div class="control-group error">
            <input type="password" id="password-confirm" name="password_confirmation" placeholder="Повторите пароль"
                   data-cip-id="password-confirm" required autocomplete="new-password">
                @error('password_confirmation')
                <span class="help-inline">  {{ $message }} </span>
                @enderror
        </div>
        <div class="control-group">
            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>
</div>
@endsection




