<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body id="login">
<div>
    <div>
        <div id="left_decorative">
        </div>
        <form id="login_form" name="login" method="post" action="{{route('login')}}">

            <img id="login_logo" src="{{asset('images/logo_tp.png')}}"><br>
            @csrf
            <h1>Login</h1><br>

            <div>
                <input type="email" name="email" placeholder="email" id="user">
                @error('user')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br><br>

            <div>
                <input  id="password" type="password"
                        placeholder="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br><br>

            <div>
                <input type="submit" value="Login" id="login_button">
            </div>
        </form>
    </div>
</div>
</body>
</html>
