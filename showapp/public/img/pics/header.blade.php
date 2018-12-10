<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- Main Meta information-->
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <!-- Meta Information-->
    <meta name="robots" content="index, follow">
    <link type="text/plain" rel="author" href="humans.txt">
    <!-- Get html5shiv if this is IE lower or equal to 9-->
    <!--[if lte IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
<div class="menu">
    <div class="span-wrap">
        <span></span>
    </div>
    <div class="left-part-menu column-menu">
        <div class="element logo">
            <p>Showapp</p>
            <div class="img-logo">
                <img src="img/pics/logo.svg" alt="">
            </div>
            <a href="{{route('/')}}"></a>
        </div>
        <div class="element country el">
            <p>Paris</p>
            <div class="arrow">
                <img src="img/pics/arrow.svg" alt="">
            </div>
            <div class="img-cursor">
                <img src="img/pics/snape-country.svg" alt="">
            </div>
            <div class="drope-country">
                <div class="d-c-w">
                    <div class="drope-element">
                        <p>USA</p>
                    </div>
                    <div class="drope-element">
                        <p>Europe</p>
                    </div>
                    <div class="drope-element">
                        <p>Ukraine</p>
                    </div>
                    <div class="drope-element">
                        <p>Russia</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="element language el">
            <p>EN</p>
            <div class="arrow">
                <img src="img/pics/arrow.svg" alt="">
            </div>
            <div class="drope-language">
                <div class="d-r-l-w">
                    <div class="drope-element">
                        <p>RU</p>
                    </div>
                    <div class="drope-element">
                        <p>RU</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right-part-menu column-menu">
        <div class="element search el">
            <img src="{{asset('img/pics/search.svg')}}" alt="">
        </div>
        <a class="element account profile" href="{{route('account')}}">
            @if(isset(Auth::user()->firstName) && !empty(Auth::user()->firstName))
                <p>{{Auth::user()->firstName}}</p>
                <img src="{{asset( stristr(Auth::user()->photo, 'img'))}}" width="70" height="70" alt="">
            @else
            <p>LOG IN</p>
             @endif
        </a>
        <a class="element account login" href="{{route('login-to-account')}}">
            <p>Register / Log In</p>
        </a>
        <a class="element shoping-car" href="{{route('event_cart')}}">
            <img src="{{asset('img/pics/s-cart.svg')}}" alt="">
        </a>
        <div class="element burger-wrap el">
            <div class="burger-wrapper">
                <div class="burger"></div>
            </div>
        </div>
    </div>
    <div class="burger-part-menu el">
        <div class="w-burg-p">
            <div class="wrap-mobile-leng">
                <div class="element language">
                    <p>EN</p>
                    <div class="arrow">
                        <img src="{{asset('img/pics/arrow-down.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="menu-item">
                <a href="{{route('login-to-account')}}">Sign-up</a>
            </div>
            <div class="menu-item">
                <a href="{{route('create-account')}}">Create-account</a>
            </div>
            <div class="menu-item">
                <a href="{{route('account')}}">Account</a>
            </div>
            <div class="menu-item">
                <a href="{{route('buy-ticket')}}">Buy ticket</a>
            </div>
            <div class="menu-item">
                <a href="{{route('create-event')}}">Create event</a>
            </div>
            <div class="menu-item">
                <a href="{{route('my_events')}}">My events</a>
            </div>
            <div class="menu-item">
                <a href="{{route('event')}}">Event</a>
            </div>
            <div class="menu-item">
                <a href="{{route('event_cart')}}">Event cart</a>
            </div>
            <div class="menu-item">
                <a href="{{route('personal_information')}}">Personal information</a>
            </div>
            <div class="menu-item" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="bottom-part-menu el">
        <div class="w-b-p">
            <div class="search-event">
                <div class="content-wrap">
                    <form>
                        <input type="text" name="search" placeholder="SEARCH YOUR EVENT"> </form>
                </div>
            </div>
        </div>
    </div>
</div>
