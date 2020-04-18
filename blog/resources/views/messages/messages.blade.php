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
                <button type="submit" class="btn btn-primary add">Отправить сообщение</button>
            </div>
        </form>
    @endcan


    @foreach($messages as $mes)
        <div class="well" data-id-message="{{$mes->id}}">
            @can('update-message' , $mes)
                <div class="control-panel">
                   <a href="#" class="link-edit"><i class="icon-edit"></i></a>

                   @can('delete-message' , $mes)
                    <form action="/" method="post">
                        @method('delete')
                        <button type="submit delete"><i class="icon-trash"></i> </button>
                    </form>
                   @endcan
                </div>
            @endcan
            <h5>{{$mes->created_at}} {{ $mes->user->name }}: </h5>
            {{$mes->message}}
        </div>
    @endforeach
@endsection



@section('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $(document).on('click','.add',function(e){
               e.preventDefault();
                var form = $(this).closest("form");
                var message =$("[name='message']").val();

                $.ajax({
                    url:"{{route('add_message')}}",
                    method: "POST",
                    data:{message:message},
                    success:function(data){
                        form.append('<div class="alert alert-success">Успешно добавлено.</div>');
                    }
                })

            });

            $(document).on('click','.link-edit',function(e){
                e.preventDefault();
                var content = $(this).closest(".well");
                var idmessage = content.data("id-message");
                var textmessage = content.clone().children().remove().end().text().replace(/\s{2,}/g, ' ');
                content.append('<form action="/" method="post">'+'<textarea style="width: 100%; height: 50px;" type="password" id="'+idmessage+'" name="message" placeholder="Ваше сообщение...">'+textmessage+'</textarea>'
                +'<button type="submit edit"><i class="icon-ok"></i> </button></form>');
            });

            $(document).on('click','.edit',function(e){
                e.preventDefault();

                var id =$(this).closest("textarea[name='message']").attr('id');
                var message =$(this).closest("textarea[name='message']").val();

                console.log(id);
                console.log(message);

                $.ajax({
                    url:"{{route('update_message')}}",
                    method:"POST",
                    data: data,
                    success:function(data){

                    }

                })


            });


            $(document).on('click','.delete',function(e){
                e.preventDefault();

            });
        });
    </script>
@endsection
