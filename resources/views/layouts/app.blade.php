<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arib - Task</title>
    @if(app()->getLocale() == 'ar')
        <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="{{asset('admin/css/ar.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{asset('admin/css/main.css')}}">
    @endif

    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/confirm.css')}}">
</head>
<body class="app sidebar-mini rtl">
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            toastr()->error($error);
        @endphp
    @endforeach
@endif
<header class="app-header">
    <a class="app-header__logo" href="#">
        <img height="57px" src="{{asset('logo.svg')}}" class="logo" alt=""/>
    </a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                    class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="#" onclick="confirmation('FormLogout', 'Logout')"><i
                            class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                @if(getAuthUser()->manager_id == null)
                <form id="FormLogout" class="d-none" action="{{route('logout')}}" method="post">@csrf</form>
                @else
                <form id="FormLogout" class="d-none" action="{{route('employee.logout')}}" method="post">@csrf</form>
                @endif
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    @include('layouts.sidebar')
</aside>
@yield('content')
<div id="scroller"></div>
@include('layouts.footer')
</body>
</html>
