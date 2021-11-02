{{--<div class="header_inside">--}}
{{--    <div class="user_profile">--}}
{{--        <img alt="Пользователь" src="{{ asset('assets/images/user.jpg') }}" class="user_avatar">--}}
{{--        <div class="user_info">--}}
{{--           @guest--}}
{{--               <p></p>--}}
{{--                <p class="white_text user_name">--}}
{{--                    <a class="logout" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                </p>--}}

{{--            @else--}}
{{--               <a class="logout" href="{{ route('changepwd') }}">--}}
{{--                <p class="white_text user_name">{{ Auth::user()->name }}</p>--}}
{{--               </a>--}}
{{--                <a class="logout" href="{{ route('logout') }}">--}}
{{--                    {{ __('Logout') }}--}}
{{--                </a>--}}
{{--            @endguest--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="time_block">--}}
{{--        <p>{{Carbon\Carbon::now()}}</p>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="header_inside">--}}
{{--    <div class="header_container">--}}

{{--    </div>--}}
{{--    <ul>--}}
{{--        <li><a href="#">Главная</a></li>--}}
{{--        <li><a href="#">Контакты</a></li>--}}
{{--    </ul>--}}
{{--    <div class="user_profile">--}}
{{--        <img alt="Пользователь" src="{{ asset('assets/images/user.jpg') }}" class="user_avatar">--}}
{{--        <div class="user_info">--}}
{{--            @guest--}}
{{--                <p></p>--}}
{{--                <p class="white_text user_name">--}}
{{--                    <a class="logout" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                </p>--}}

{{--            @else--}}
{{--                <a class="logout" href="{{ route('changepwd') }}">--}}
{{--                    <p class="white_text user_name">{{ Auth::user()->name }}</p>--}}
{{--                </a>--}}
{{--                <a class="logout" href="{{ route('logout') }}">--}}
{{--                    {{ __('Logout') }}--}}
{{--                </a>--}}
{{--            @endguest--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="header">
    <div class="logo_block">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img alt="Логотип" src="{{ asset('assets/images/logo.svg') }}" class="header_logo">
        </a>
    </div>
    <div class="header_container">
        @auth
            <ul class="header_menu">
                <li><a href="/" style="padding-right: 37px;">Временные показатели</a></li>
                <li><a href="/maintable" style="padding-right: 37px;">Таблица</a></li>
                <li><a href="/sumreports" style="padding-right: 37px;">Сводный отчет</a></li>
            </ul>
            <div class="user_profile">
                <img alt="Пользователь" src="{{ asset('assets/images/user.jpg') }}" class="user_avatar">
                <div class="user_info">

                    {{--               <a class="logout" href="{{ route('changepwd') }}">--}}
                    <h7 class="logout">
                        <p class="white_text user_name">{{ Auth::user()->name }}</p>
                    </h7>
                    <a class="logout" href="{{ route('logout') }}">
                        {{ __('Logout') }}
                    </a>

                </div>
            </div>

        @endauth
    </div>
</div>
