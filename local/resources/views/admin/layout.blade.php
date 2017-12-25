<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>
    <header id="header" class="">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="home">COIN SMART</a>

            </div>
        </nav>
    </header><!-- /header -->

    @yield('content')

    <footer>

    </footer> <!-- /footer -->
    <!-- script -->
    <script type="text/javascript" src="public/js/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/jquery-slim.min.js"></script>
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
