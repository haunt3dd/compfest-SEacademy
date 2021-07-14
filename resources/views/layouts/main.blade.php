<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        body {
            background-color: black;
        }
    </style>


    <title>@yield('title')</title>
</head>

<style>
    html,
    body {
        height: 100%;
    }

    h2 {
        font-family: georgia;
    }

    .container-big {
        flex-basis: 5cm;
    }

    
    .appointment,.appointment_description {
        color: #E09F5A;
    }

    .registrant_name{
        color: #E09F5A;
        font-size:30px;
    }



    .content {
        background-color: #153040;
        color: white;
    }


    .links {
        color: #E09F5A;
        font-size: 25px;
        background-color: transparent;
        text-decoration: none;
    }

    .links:hover {
        color: #FFC619;
        background-color: transparent;
        text-decoration: underline;
    }

    .font-typo {
        font-family: 'Kelly Slab', cursive;
    }

    #doctor,#desc{
        margin: 1% auto;
        width:250px;
        
    }
    
</style>


<body>
    <nav class="font-typo navbar navbar-expand-lg navbar-light bg-warning rounded-0 bd-highlight ">
        <a class="navbar-brand ml-3 font-typo" href="/home">Hospital X</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if($users->role == 'patient')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('appointment.user')}}">My Appointments</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('page.create')}}">Create Appointment</a>
                </li>
                @endif

                @if(Session::get('token')->token != null || Session::get('token')->token != '')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logoutUser')}}">Logout</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('container')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    @stack('custom_js')

</body>

</html>