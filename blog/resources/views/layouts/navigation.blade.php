<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Сайтсофт</a>
        
                <ul class="nav">
                        <li class="active"><a href="{{ url('/home') }}">Главная</a></li>
                    @guest
                        <li><a href="{{ route('login') }}">Авторизация</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Регистрация</a></li>
                        @endif            
                 </ul>
                     @else
                  </ul>
                     <ul class="nav pull-right">
                        <li><a>  {{ Auth::user()->name }} </a></li>
                        <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выход</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </li>  
                      </ul>
                @endguest
       
    </div>
</div>


