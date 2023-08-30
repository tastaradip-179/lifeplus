<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <form style="width: 400px">
                <div class="mb-3 form-control">
                    <label for="loginInputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="loginInputEmail">
                </div>
                <div class="mb-3 form-control">
                    <label for="loginInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginInputPassword">
                </div>
                <button type="submit" class="btn btn-primary w-100" id="btn-login">Login</button>
                <a href="{{url('api/register')}}">Register</a>
            </form>
        </div>
    </div>
  </body>
  <script>
    jQuery(document).ready(function($){
    // Login
    $("#btn-login").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
             email: jQuery('#loginInputEmail').val(),
             password: jQuery('#loginInputPassword').val(),
        };
        var type = "POST";
        var ajaxurl = 'http://127.0.0.1:8000/api/login';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                window.location.href = "http://127.0.0.1:8000/api/home";
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    });
  </script>
</html>