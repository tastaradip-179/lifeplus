<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="position-relative d-flex align-items-center justify-content-center  vh-100">
            <div class="position-absolute top-0 right-0 px-6 py-4">
                @auth
                    <a href="{{ url('api/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ url('api/login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    <a href="{{ url('api/register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endauth
            </div>
            <form style="width: 400px">
                <div class="mb-3 form-control">
                    <label for="InputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="InputEmail">
                </div>
                <div class="mb-3 form-control">
                    <label for="InputEmail" class="form-label">Username</label>
                    <input type="text" class="form-control" id="InputName">
                </div>
                <div class="mb-3 form-control">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword">
                </div>
                <div class="mb-3 form-control">
                    <label for="selectAccountType" class="form-label">Account type</label>
                    <select class="form-select" id="selectAccountType" aria-label="selectAccountType">
                    <option value="individual">Individual</option>
                    <option value="business">Business</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="btn-register">Registration</button>
                <a href="{{url('api/login')}}">Login</a>
            </form>
        </div>
    </div>
  </body>
  <script>
    jQuery(document).ready(function($){
    // STORE
    $("#btn-register").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
             email: jQuery('#InputEmail').val(),
             password: jQuery('#InputPassword').val(),
             username: jQuery('#InputName').val(),
             type: jQuery('#selectAccountType').val(),
        };
        var type = "POST";
        var ajaxurl = 'http://127.0.0.1:8000/api/register';
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