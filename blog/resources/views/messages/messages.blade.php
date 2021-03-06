@extends('layouts.app')

@section('content')
<div class="span2"></div>
<div class="span8">
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

    <div class="content">
        @include('messages.content')
    </div>
    <div id="myModal" class="modal hide fade">
        <form id="form" class="myform">
             <h1>Введите пароль</h1>
            <input type="password" name="password" id="password"><br>
            <button type="submit" class="checkprivate">Отправить</button>
        </form>
    </div>
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
                        $(".content").html(data);
                        $("textarea#inputText").val("");
                        if(data){
                            form.before('<div class="alert alert-success">Успешно добавлено.</div>');
                        }
                    },
                    error:function(error){
                        if(error.responseJSON.errors){
                            error.responseJSON.errors.forEach(element =>  form.before('<div class="alert alert-error">'+element+'</div>'));
                        }
                    }
                })
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

            $(document).on('click','.open',function(e){
                var content = $(this).closest(".well");
                var id = content.data("id-message");
                $('#myModal').data("id-message",id);
                $('#myModal').modal();
            });

            $(document).on('click','.checkprivate',function(e){
                e.preventDefault();

                var password =$("#password").val();
                var content = $(this).closest("form");
                var id = $('#myModal').data("id-message");
                $.ajax({
                    url: `/checkpassword/${id}`,
                    method:"POST",
                    data: {password:password},
                    success:function(data){
                        var data = JSON.parse(data);
                       if(data){
                            content.before('<div class="alert alert-success">Вы можете посмотреть скрытое сообщение</div>');
                            var showtext = $(".span8").find("[data-id-message='" + id + "']");
                           showtext.find("p").removeClass().text(data);
                            setTimeout(function () {
                                $('#myModal').modal('toggle');
                            }, 800);
                        }else{
                            content.before('<div class="alert alert-error"> Неверный пароль</div>');
                        }
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
