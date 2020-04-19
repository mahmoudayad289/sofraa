<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('front/css') }}/style.css">
    <!-- Custom fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>

<!--==============navbar section=======-->
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-light" style="background-color: #ECECEC;">
            <div class="col-md-4">
                <a href="{{ route('cart') }}">
                     <span>
                <i class="fas fa-shopping-cart"></i>
                </span>
                </a>

                <div class="dropdown">
                    <i class="fas fa-user-circle dropdown"></i>
                    <div class="dropdown-content">

                        {{ optional(Auth::guard('front_client')->user())->name }}
                        {{ optional(Auth::guard('front_restaurant')->user())->name }}

                            @if(Auth::guard('front_client')->check() && !Auth::guard('front_restaurant')->check() )
                            <a href="{{ route('logout.client') }}">Logout</a>
                                @elseif(Auth::guard('front_restaurant')->check() && !Auth::guard('front_client')->check() )
                            <a href="{{ route('logout.restaurant') }}">Logout</a>
                            @else
                            <a href="{{ route('show.login.client') }}">Login</a>
                            <a href="{{ route('show.register.client') }}">Register</a>
                            <a href="{{ route('show.login.restaurant') }}">Login Restaurant</a>
                            <a href="{{ route('show.register.restaurant') }}">Register Restaurant</a>
                            @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 logo-up">
                <img class="logo" src="{{ asset('front/images') }}/sofra%20logo-1@2x.png">
            </div>
            <div class="col-md-4 burger">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01"
                        aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-hamburger"></i>
                </button>
            </div>


            <div class="collapse navbar-collapse " id="navbarsExample01">
                <ul class="navbar-nav custom">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.home') }}">Home</a>
                        <a class="nav-link" href="{{ route('show.register.client') }}">Register</a>
                        <a class="nav-link" href="{{ route('show.login.client') }}">Login</a>
                        <a class="nav-link" href="{{ route('show.register.restaurant') }}">Register Restaurant</a>
                        <a class="nav-link" href="{{ route('show.login.restaurant') }}">Login Restaurant</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        <a class="nav-link" href="{{ route('restaurants') }}">Restaurants</a>
                        <a class="nav-link" href="{{ route('product.form') }}">Create Products</a>
                        <a class="nav-link" href="{{ route('offer.form') }}">Create Offer</a>
                        <a class="nav-link" href="{{ route('all.offers') }}">Offers</a>
                        <a class="nav-link" href="{{ route('all.product') }}">Products</a>
                    </li>

                </ul>

            </div>
        </nav>
    </div>
</div>


@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-desc">
                    <div class="who-us">
                        <i class="fa fa-pencil"></i>
                        <h3>من نحن</h3>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Nam enim voluptatibus ullam deleniti culpa accusamus <br> fugit doloremque blanditiis provident pariatur, maiores harum error<br> porro nihil quidem eligendi magnam sunt aut?</p>
                    <ul class="list-unstyled links">
                        <li>
                            <a href="#" class="fa fa-facebook-square"></a>
                        </li>
                        <li>
                            <a href="#" class="fa fa-twitter"></a>
                        </li>
                        <li>
                            <a href="#" class="fa fa-instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <a href="index.html" class="footer-logo">
                    <img src="{{ asset('front/images') }}/sofra logo-1.png" alt="Footer-logo">
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
