<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="publishable-key" content="{{Config::get('stripe.publishable_key')}}">
        <meta name="csrf-token" content="{!! csrf_token() !!}">

        <title>My Restaurant | @yield('title') </title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        @yield('additionalstyles')
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
            <div id="container-fluid">
                <nav class="navbar navbar-default navbar-static-top" role="navigation">
                    <!--    <div class="container">-->
                    <div class="navbar-header">
                        <!-- hamburger button -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="{{ url('/')}}"><img id="logo" src="images/logo.png"></a>
                    </div>

                    <!-- toggling -->
                    <div class="collapse navbar-collapse " id="collapse-1">
                        <ul class="nav navbar-nav navbar-static-top right-align">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <!--</div>-->
                </nav>

                <div >
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <p>&#169; 2015 BYTE All rights reserved.</p>
            </footer>
            <!-- Scripts -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
            <!-- Stripe -->
            <script src="https://js.stripe.com/v2/"></script>
            @yield('additionalscripts')

    </body>
</html>
