<!DOCTYPE html>
<html>

<head>
    <style>
.btn-primary {
    color: #fff;
    background-color: #fa5efc!important;
    border-color: #fa5efc!important;
    display: block!important;
    width: fit-content!important;
    margin: 0 auto!important;
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
        /* button#btn10 {
            position: fixed;
        } */

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
            width: 50%;
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
    padding-left: 15%;
    margin-bottom: 3%;
    color: white;
}

    input#password {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 15%;
    margin-bottom: 3%;
    color: white;
}

    input#email {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 15%;
    margin-bottom: 3%;
    color: white;
}

    input#name {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 15%;
    margin-bottom: 3%;
    color: white;
}
select#role {
    background-color: unset;
    border: unset;
    border-bottom: 1px solid white;
    border-radius: 0px;
    padding-left: 15%;
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">  <b>{{ __('Verify Your Email Address') }}</b> </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
	                </form>

<br><br>
<a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                </div>
            </div>
        </div>
    </div>
</div>



</body>






</html>



