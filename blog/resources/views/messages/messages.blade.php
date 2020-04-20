@extends('layouts.app')

@section('content')

    @can('add-message')
        <form action="/" method="post" class="form-horizontal" style="margin-bottom: 50px;">
            @include('layouts.errors')
            <div class="control-group">
                <textarea style="width: 100%; height: 50px;" type="password" id="inputText" name="message" placeholder="Ваше сообщение..."
                    data-cip-id="inputText"></textarea>
            </div>
            <div class="control-group">
                <label class="checkbox">
                    <input type="checkbox" id="privatemessage" name="privatemessage" value="privatemessage"> Приватное сообщение
                </label>
            </div>
            <div class="control-group">
                <button type="submit" class="btn btn-primary add">Отправить сообщение</button>
            </div>
        </form>
    @endcan

    @foreach($messages as $mes)
        <div class="well" data-id-message="{{$mes->id}}">

        <div class="privatemessage-panel">
            @if($mes->privatemessage)
             <i class="icon-eye-close open"></i>
            @else
             <i class="icon-eye-open"></i>
            @endif
        </div>

            @can('update-message' , $mes)
                <div class="control-panel">
                   <a href="#" class="link-edit"><i class="icon-edit"></i></a>
                   @can('delete-message' , $mes)
                    <form action="/" method="post">
                        <i class="icon-trash delete"></i>
                    </form>
                   @endcan
                </div>
            @endcan
            <h5>{{$mes->created_at}} {{ $mes->user->name }}: </h5>
            @if($mes->privatemessage)
                <p class="hidden-secret">Сообщение является приватным</p>
            @else
             <p>{{$mes->message}}</p>
            @endif
        </div>
    @endforeach



    <form id="form" class="myform">
        <input type="name" name="name" placeholder="Ваше имя"><br>
        <input type="number" name="phone" placeholder="+79999999"><br>
        <button type="submit">Отправить</button>
      </form>
    <style>
        .myform{
            display: none;
        }
    </style>

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

            $(document).on('click','.add',function(e){
               e.preventDefault();
                var form = $(this).closest("form");
                var message =$("[name='message']").val();
                var privatemessage =$("#privatemessage:checked").length;
                $.ajax({
                    url:"{{route('add_message')}}",
                    method: "POST",
                    data:{message:message,privatemessage:privatemessage},
                    success:function(data){
                        form.append('<div class="alert alert-success">Успешно добавлено.</div>');
                    }
                })
            });


            $(document).on('click','.open',function(e){
                $(".myform").show();
            });


            $(document).on('click','.link-edit',function(e){
                e.preventDefault();
                $(".update_form").remove();
                var content = $(this).closest(".well");
                var textmessage = content.find("p").text();
                content.append('<form action="/" class="update_form" method="post">'+'<textarea style="width: 100%; height: 50px;" type="password" id="inputText" name="message" placeholder="Ваше сообщение...">'+textmessage+'</textarea>'
                +'<input type="hidden" name="_method" value="PUT"><button type="submit" class="edit"><i class="icon-ok"></i> </button></form>');
            });



            $(document).on('click','.edit',function(e){
                e.preventDefault();
                var content = $(this).closest(".well");
                var id = content.data("id-message");
                var message =content.find("textarea").val();
                $.ajax({
                    url: `/message/${id}`,
                    method:"PUT",
                    data: {id:id,message:message},
                    success:function(data){
                        var data = JSON.parse(data);
                        $(".update_form").remove();
                        content.find("p").text(data.message);
                        content.before('<div class="alert alert-success">Успешно обновлено.</div>');
                    }
                })

            });



            $(document).on('click','.delete',function(e){
                e.preventDefault();
                var content = $(this).closest(".well");
                var id = content.data("id-message");
                $.ajax({
                    url: `/message/${id}`,
                    method:"DELETE",
                    data: {_method: 'delete', _token :"{{csrf_token()}}"},
                    success:function(data){
                        content.remove();
                    }
                })

            });
        });
    </script>
@endsection
