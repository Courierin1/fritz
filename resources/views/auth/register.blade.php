<!DOCTYPE html>
<html>

<head>
    <style>


select#role {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}
        /* button#btn10 {
            position: fixed;
        } */

        input::placeholder {
            color: white !important;
            font-size: 16px;
            font-family: Calibri;
        }
        input:focus{box-shadow: none !important}

        input#email {
            background-color: unset;
            border: unset;
            border-bottom: 1px solid white;
            border-radius: 0px;
            padding-left: 8%;
            margin-bottom: 3%;
            color: white;
        }

        body {

            min-height: 100vh;
            padding-bottom: 1.5rem !important;
            background-image: url('{{ asset('assets/images/loginbanner.png') }}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div#login09 {
            width: 25%;
        }

        p#flop {
            text-align: center;
            font-size: 53px;
            color: #ffffff;
            font-family: Calibri;
            font-weight: 700;
        }

        a.btn.btn-link {
            float: right;
            color: white;
            text-decoration: unset;
            font-weight: 100;
        }

        a#btn1 {
            background-color: unset;
            border: unset;
            border-radius: unset;
            padding: 10px 20px 10px 20px;
            font-family: Calibri;
            border: 1px solid white;
            margin-left: 3%;
        }

        button#btn10 {
            background-color: #fa5efc;
            border: 1px solid #fa5efc;
            border-radius: unset;
            padding: 10px 20px 10px 20px;
            font-family: Calibri;
            border: 1px solid white;
            margin-left: 1%;
        }

        .form-check {
            margin-top: 8%;
            margin-bottom: 10% !important;
            color: #ffffff;
            font-weight: 100;
        }

        a.btn.btn-link {
            float: right;
            color: white;
            text-decoration: unset;
            font-style: italic;
        }

        input#password {
            background-color: unset;
            border: unset;
            border-bottom: 1px solid white;
            border-radius: 0px;
        }


        input#password::placeholder {
            color: white;
            font-size: 16px;
            font-family: Calibri;
        }

        input#password {
            background-color: unset;
            border: unset;
            border-bottom: 1px solid white;
            border-radius: 0px;
            padding-left: 8%;
            margin-bottom: 3%;
            color: white;
        }

        input#name::placeholder {
            color: white;
            font-size: 16px;
            font-family: Calibri;
        }

        input#name {
            background-color: unset;
            border: unset;
            border-bottom: 1px solid white;
            border-radius: 0px;
            padding-left: 8%;
            margin-bottom: 3%;
            color: white;
        }
        input#phone {
            background-color: unset;
            border: unset;
            border-bottom: 1px solid white;
            border-radius: 0px;
            padding-left: 8%;
            margin-bottom: 3%;
            color: white;
        }
        input#fname {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}
    input#lname {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}
    input#dob {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
    color-scheme:dark
}
        input#password-confirm::placeholder {
            color: white;
            font-size: 16px;
            font-family: Calibri;
        }

        input#password-confirm {
            background-color: unset;
            border: unset;
            border-bottom: 1px solid white;
            border-radius: 0px;
            padding-left: 8%;
            margin-bottom: 3%;
            color: white;
        }

        i.fa-solid {
            position: relative;
            top: 31px;
            color: white;
        }

        .col-md-12 {
            margin-bottom: 5%;
        }



        @media (max-width: 1280px) {

div#login09 {

    width: 35%;
}



}





@media (max-width: 991px) {
div#login09 {
    width: 45%;
}

}


@media (max-width: 767px) {

    a#btn1 {
    background-color: unset;
    border: unset;
    border-radius: unset;
    padding: 10px 20px 10px 20px;
    font-family: Calibri;
    border: 1px solid white;
    margin-left: 0;
    width: 100%;
}

    button#btn10 {
    background-color: #fa5efc;
    border: 1px solid #fa5efc;
    border-radius: unset;
    padding: 10px 20px 10px 20px;
    font-family: Calibri;
    border: 1px solid white;
    margin-left: 1%;
    width: 100%;
    margin-bottom: 2%;
}
    div#login09 {
    width: 50%;
}

    a#btn10 {
    background-color: unset;
    border: unset;
    border-radius: unset;
    padding: 10px 20px 10px 20px;
    font-family: Calibri;
    border: 1px solid white;
    margin-left: 1%;
    width: 100%;
}



button#btn1 {
    background-color: #fa5efc;
    border: 1px solid #fa5efc;
    border-radius: unset;
    padding: 10px 20px 10px 20px;
    font-family: Calibri;
    width: 100%;
    margin-bottom: 3%;
}



}




@media (max-width: 480px) {

div#login09 {
    width: 70%;
}


}
@media (max-width: 320px) {

    input#password-confirm {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}

    input#password {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}

    input#email {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}

select#role {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 8%;
    margin-bottom: 3%;
    color: white;
}


}

    </style>


    <title>Frimix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@200;300;400;500;600;700&family=Poppins:wght@300;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f960907f8.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@500&display=swap"
        rel="stylesheet">











</head>

<body>
    <div class="container-fluid" id="login09">
        <div class="row">
            <div class="col-md-12">

                <p id="flop"> <img src="{{ asset('assets/images/loginicon.png') }}" alt=""></p>

                <p id="flop">{{ __('Register') }}</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-user-check"></i> <input id="fname" placeholder="First Name" type="text"
                                class="form-control @error('fname') is-invalid @enderror" name="fname"
                                value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                            @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-user-check"></i> <input id="lname" placeholder="Last Name" type="text"
                                class="form-control @error('lname') is-invalid @enderror" name="lname"
                                value="{{ old('lname') }}" required autocomplete="lname" >

                            @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>


                    <input id="role" type="hidden" name="role" value="{{$_GET['is_planner'] ?? '0'}}">

                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-phone"></i> <input id="phone" placeholder="Phone" type="Phone no"
                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-envelope"></i> <input id="email" placeholder="Email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-lock"></i> <input id="password" placeholder="Password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-lock"></i> <input id="password-confirm" placeholder="Password Confirm"
                                type="password" class="form-control" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col-md-12">
                            <i class="fa-solid fa-calendar"></i> <input id="dob" placeholder="Date of birth" type="date"
                                class="form-control @error('dob') is-invalid @enderror" name="dob"
                                value="{{ old('dob') }}" required autocomplete="dob">

                            @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">



                        <div class="col-md-4">
                        <button style="margin-left:0%;" type="submit" id="btn10" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>


                            </div>
                            <div class="col-md-8">
                            <a href="{{ route('login')}}" id="btn1" class="btn btn-primary">
                                {{ __('Login') }}
                            </a>


                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>






</html>
