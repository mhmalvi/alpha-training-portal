<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ATR | Login</title>

    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('assets/admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div class="d-flex justify-content-center" style="padding: 50px 0px 15px 0px;">
                <img src="{{asset('assets/ATR.png')}}" alt="" style="max-width: 130px;">
            </div>
            <div class="py-3">
                <h3>Welcome Back!</h3>
                <p>Login to continue</p>
            </div>
            @if ($errors->any())
                <div class="text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <small>{{ $error }}</small>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" id="email" class="form-control" name="email" :value="old('email')" placeholder="Your Email" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control" name="password" autocomplete="current-password" placeholder="Your Password" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>
                @endif --}}
                
            </form>
            <p class="m-t"> <small>QuadQue Technologies ltd &copy; <script>document.write(new Date().getFullYear())</script></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{asset('assets/admin/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.js')}}"></script>

</body>

</html>

