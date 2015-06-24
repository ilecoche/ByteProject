<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BYTE - Admin</title>

    <!-- Custom CSS -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('additionalstyles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">BYTE</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-nav navbar-right">
											<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">admin <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="http://localhost:8888/ByteProject/public/auth/logout">Logout</a></li>
							</ul>
						</li>
									</ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ url('placed_orders')  }}"><span class="glyphicon glyphicon-star"></span> Placed Orders</a>
                    </li>
                    <li>
                        <a href="{{ url('testimonials')}}"><span class="glyphicon glyphicon-comment"></span> Testimonials</a>
                    </li>
                     <li>
                        <a href="{{ url('products_admin') }}"><span class="glyphicon glyphicon-list-alt"></span> Menu</a>
                    </li>
                    <li>
                        <a href="{{ url('tables')}}"><span class="glyphicon glyphicon-book"></span> Reservations</a>
                    </li>
                    <li>
                        <a href="{{ url('wait') }}"><span class="glyphicon glyphicon-time"></span> Wait Time</a>
                    </li>
                    <li>
                        <a href="{{ url('orderstats') }}"><span class="glyphicon glyphicon-signal"></span> Order Stats</a>
                    </li>
                    <li>
                        <a href="{{ url('restaurantAdmin') }}"><span class="glyphicon glyphicon-cog"></span> Info </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <!--<div class="container-fluid">-->

                    @yield('content')

            <!--</div>-->
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
 <!-- Stripe -->
            <script src="https://js.stripe.com/v2/"></script>
            @yield('additionalscripts')

</body>

</html>
