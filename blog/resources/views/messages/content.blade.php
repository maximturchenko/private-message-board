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
