<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    @yield('css')
</head>
<body>
    <header id="header" class="">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="{{ url('home')}}">COIN SMART</a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="login">Login <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register">Register</a>
                    </li>
                    @else
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('info')}}" titlt="Profile">{{ Auth::user()->name }} <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('transaction')}}">Transaction <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('logout')}}">Logout <span class="sr-only">(current)</span></a>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header><!-- /header -->

    @yield('content')

    <footer>

    </footer> <!-- /footer -->
    <!-- script -->
    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('public/js/jquery-slim.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/vendor/popper.min.js') }}"></script> -->
    @yield('js')
    <script>
        (function () {
            window.addEventListener('load', function () {
                var form = document.getElementById('needs-validation');
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();

        $(document).ready(function () {
//                $(".tb").fadeTo(2000, 500).slideUp(500, function () {
//                    $(".tb").slideUp(500);
//                });
});

</script>
</body>
</html>
