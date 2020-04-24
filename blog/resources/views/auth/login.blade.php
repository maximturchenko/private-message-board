@extends('layouts.app')

@section('content')
    <div class="span4"></div>
    <div class="span3">
        <form action="{{ route('login') }}" method="post" class="form-horizontal">
            @csrf
            <div class="control-group">
                <b> {{ __('Авторизация') }}</b>
            </div>
            <div class="control-group">
                <input type="email" id="email" name="email" placeholder="Логин" data-cip-id="email"
                    autocomplete="off" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="control-group">
                <input type="password" id="password" name="password" placeholder="Пароль"
                    data-cip-id="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="control-group">
                <label class="checkbox">
                    <input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>   {{ __('Запомнить меня') }}
                </label>
                <button type="submit" class="btn btn-primary btn-login"> {{ __('Вход') }}</button>
            </div>
        </form>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Забыли пароль?') }}
            </a>
         @endif
    </div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
              });

           $(document).on('click' ,function(e){
                $(".alert").remove();
            });
            $(document).on('click','.btn-login',function(e){
               e.preventDefault();
                var form = $(this).closest("form");
                var email =$("#email").val();
                var password =$("#password").val();
                var remember =$("#remember:checked").length;
                $.ajax({
                    url:"{{route('login')}}",
                    method: "POST",
                    data:{email:email,password:password,remember:remember},
                    success:function(data){
                        location.href = "{{route('home')}}";
                    },
                    error:function(error){
                        debugger;
                        if(error.responseJSON.errors){
                           Object.keys(error.responseJSON.errors).forEach(function (key){
                                form.before('<div class="alert alert-error">'+error.responseJSON.errors[key]+'</div>');
                           });

                        }
                    }
                })
            });

        });
    </script>
@endsection



