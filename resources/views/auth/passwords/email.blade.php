<!DOCTYPE html>
<html>

<head>
    <style>

button#btn1 {
    background-color: #fa5efc;
    border: 1px solid #fa5efc;
    border-radius: unset;
    padding: 10px 20px 10px 20px;
    font-family: Calibri;
    width: max-content;
}
        button#btn10 {
            position: fixed;
        }

        input#email::placeholder {
            color: white;
            font-size: 16px;
            font-family: Calibri;
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
            /* text-align: center; */
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

        button#btn1 {
            background-color: #fa5efc;
            border: 1px solid #fa5efc;
            border-radius: unset;
            padding: 10px 20px 10px 20px;
            font-family: Calibri;
        }

        a#btn10 {
            background-color: unset;
            border: unset;
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

        i.fa-solid {
            position: relative;
            top: 31px;
            color: white;
        }

        div#login09 {
    width: 40%;
}

        @media (max-width: 1280px) {

            div#login09 {
    width: 45%;
}





}





@media (max-width: 991px) {
    div#login09 {
    width: 55%;
}

}


@media (max-width: 767px) {

    p#flop {
    /* text-align: center; */
    font-size: 39px;
    color: #ffffff;
    font-family: Calibri;
    font-weight: 700;
}

    div#login09 {
    width: 65%;
}

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

    p#flop {
    /* text-align: center; */
    font-size: 29px;
    color: #ffffff;
    font-family: Calibri;
    font-weight: 700;
}

div#login09 {
    width: 70%;
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


                <p id="flop">{{ __('Reset Password') }}</p>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">


                        <div class="col-md-12">
                        <i class="fa-solid fa-envelope"></i>  <input id="email" type="email" Placeholder="Email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" id="btn1" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>

                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>




</body>

</html>
