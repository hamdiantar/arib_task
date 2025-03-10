<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Arib</title>
</head>
<body>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            toastr()->error($error);
        @endphp
    @endforeach
@endif
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Arib | Welcome Back</h1>
    </div>
    <div class="login-box">
        <form id="loginForm" class="login-form" action="{{route('login')}}" method="post">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{__('Login')}}</h3>
            <div class="form-group">
                <label class="control-label">{{__('E-Mail Or Phone')}}</label>
                <input autocomplete="new-email" class="form-control" type="text" placeholder="Email" autofocus name="login" value="{{old('login')}}">
            </div>
            <div class="form-group">
                <label class="control-label">{{__('Password')}}</label>
                <input autocomplete="new-password" class="form-control" type="password" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox"><span class="label-text">{{__('Stay Signed in')}}</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2"><a href="#" data-toggle="flip">{{__('Forgot Password ?')}}</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button type="submit" form="loginForm" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>{{__('Login')}}</button>
            </div>
            <div class="form-group mt-2 pb-2">
            </div>
        </form>
        <form class="forget-form" action="#">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>{{__('Forgot Password ?')}}</h3>
            <div class="form-group">
                <label class="control-label">{{__('E-Mail')}}</label>
                <input class="form-control" type="text" placeholder="Email">
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>{{__('RESET')}}</button>
            </div>
        </form>
    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('admin/js/plugins/pace.min.js')}}"></script>
<script type="text/javascript">
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
</body>
</html>
