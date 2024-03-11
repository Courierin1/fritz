@extends('layouts.site.app')

@section('title', 'Event Page')

@section('content')


<style>
    .order-details {
        padding: unset !important;
        border: unset !important;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .order-table {
        margin-top: unset !important;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
        padding: 30px;
        background-color: #fff;
        /* margin-bottom: 50px; */
    }

    button.btn.btn-default {
        font-size: 13px;
        font-weight: 500;
        background-color: transparent;
        background-image: linear-gradient(180deg, #d1410c 0%, #db6f06 100%);
        border-radius: unset;
        padding: 10px 15px 10px 15px;
        color: #fff !important;
        margin-left: unset;
        margin-top: 3%;
        border: unset;
    }

    #user-table th,
    td {
        padding: 0px !important;
        font-family: 'Poppins', sans-serif !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }


    #user-table tr th {
        font-weight: 800 !important;
        color: black !important;
    }

    #img2 {
        height: 81px;
    }

    /* img {
            cursor: pointer;
        } */


    table {
        border-collapse: collapse;
        border-spacing: 0;
    }


    /* Form Styles */
    form {
        width: 100%;
    }

    input[type="text"],
    [type="number"],
    input[type="password"],
    select,
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    textarea {
        border: 1px solid #ddd;
        background-color: #fff;
        color: #959595;
        width: 100%;
        padding: 10px;
        font-size: 12px;
        margin: 7px 0 25px 0;
    }

    label {
        font-size: 14px;
    }

    select {
        height: 37px;
    }

    input[type="checkbox"] {
        margin: 5px 10px 5px 0px;
    }

    .user-pswd input[type="checkbox"] {
        margin: 5px 10px 5px 15px;
    }

    input[type="checkbox"]+p,
    input[type="radio"]+p {
        font-size: 15px;
        padding: 0 5px;
        display: inline;
        color: #959595;
    }

    input[type="radio"]+p {
        font-size: 13px;
        padding: 0 0 0 20px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        color: #fff;
        background-image: linear-gradient(180deg, #d1410c 0%, #db6f06 100%);
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        margin: 10px auto;
        display: block;
    }

    input[type="submit"]:hover {
        background-color: #D6544E;
        border: none;
    }

    .coupon input[type="text"] {
        width: 160px;
    }

    .coupon input[type="submit"] {
        margin: 0 0 0 20px;
    }

    .order .redbutton {
        background-color: #D6544E;
        padding: 13px 30px;
        font-size: 14px;
        font-weight: 100;
        margin-top: 25px;
    }

    .order .redbutton:hover {
        background-color: #000;
        border: none;
    }

    textarea {
        height: 120px;
    }

    textarea:hover,
    input:hover {
        border: 1px solid #D6544E;
        background-color: #fff;
    }

    textarea:active,
    input:active {
        border: 1px solid #D6544E;
        background-color: #f5f5f5;
    }

    textarea:focus,
    input:focus {
        border: 1px solid #000;
        background-color: #f5f5f5;
    }

    label:not(.notes):after {
        content: "*";
        color: red;
        padding-left: 5px;
    }

    .notes {
        display: block;
        padding-top: 20px;
    }


    /* Grid Styles */
    * {
        box-sizing: border-box;
    }

    .wrapper {
        width: 100%;
        margin: 50px auto;
        margin-bottom: 100px;
    }

    .row:before,
    .row:after {
        content: " ";
        display: table;
    }

    .row:after {
        clear: both;
    }

    .col {
        margin-right: 16px;
        float: left;
    }

    .col:last-child {
        margin-right: 0;
    }

    .col-1,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-10,
    .col-11,
    .col-12 {
        width: 100%;
    }

    .col-push-1,
    .col-push-2,
    .col-push-3,
    .col-push-4,
    .col-push-5,
    .col-push-6,
    .col-push-7,
    .col-push-8,
    .col-push-9,
    .col-push-10,
    .col-push-11 {
        margin-left: 0;
    }

    /* TABLET STARTS HERE */

    @media(max-width: 480px) {  

        .wrapper .col-7.col {
    width: 80%;
    margin: 0 AUTO;
}
        .wrapper .col-5.col.order {
    width: 80%;
    margin: 0 AUTO;
}



    }







    @media(max-width: 767px) {  

    .wrapper .col-7.col {
    width: 80%;
    margin: 0 AUTO;
}
        .wrapper .col-5.col.order {
    width: 80%;
    margin: 0 AUTO;
}


    }


    @media(min-width: 768px) {


       
        .wrapper {
            width: 768px;
        }

        .col-1,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-10,
        .col-11 {
            width: 376px;
        }

        .col-12 {
            width: 100%;
        }

        .col-push-1,
        .col-push-2,
        .col-push-3,
        .col-push-4,
        .col-push-5,
        .col-push-6,
        .col-push-7,
        .col-push-8,
        .col-push-9,
        .col-push-10,
        .col-push-11 {
            margin-left: 392px;
        }

        .col:nth-child(2n+2) {
            margin-right: 0;
        }

    }


    /*DESKTOP STARTS HERE*/

    @media(min-width: 1136px) {
        .wrapper {
            width: 1136px;
        }

        .col-1 {
            width: 80px;
        }

        .col-2 {
            width: 176px;
        }

        .col-3 {
            width: 272px;
        }

        .col-4 {
            width: 368px;
        }

        .col-5 {
            width: 464px;
        }

        .col-6 {
            width: 560px;
        }

        .col-7 {
            width: 656px;
        }

        .col-8 {
            width: 752px;
        }

        .col-9 {
            width: 848px;
        }

        .col-10 {
            width: 944px;
        }

        .col-11 {
            width: 1040px;
        }

        .col-12 {
            width: 100%;
        }

        .col-push-1 {
            margin-left: 96px;
        }

        .col-push-2 {
            margin-left: 192px;
        }

        .col-push-3 {
            margin-left: 288px;
        }

        .col-push-4 {
            margin-left: 384px;
        }

        .col-push-5 {
            margin-left: 480px;
        }

        .col-push-6 {
            margin-left: 576px;
        }

        .col-push-7 {
            margin-left: 672px;
        }

        .col-push-8 {
            margin-left: 768px;
        }

        .col-push-9 {
            margin-left: 864px;
        }

        .col-push-10 {
            margin-left: 960px;
        }

        .col-push-11 {
            margin-left: 1056px;
        }

        .col:nth-child(2n+2) {
            margin-right: 16px;
        }

        .col:last-child {
            margin-right: 0;
        }
    }


    /* Main CSS Starts Here */
    body {
        font-family: 'Raleway', sans-serif;
        color: #959595;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        text-transform: uppercase;
        font-weight: 900;
        padding: 20px 0;
        color: #000;
    }

    h1 {
        font-size: 72px;
        color: #000;
    }

    /* Heading Top Border Styles Start Here */
    h3 {
        position: relative;
    }

    h3.topborder {
        margin-top: 0;
    }

    h3.topborder:before {
        content: "";
        display: block;
        border-top: 1px solid #c2c2c2;
        width: 100%;
        height: 1px;
        position: absolute;
        top: 50%;
        z-index: 1;
    }

    h3.topborder span {
        background: #fff;
        padding: 0 10px 0 0;
        position: relative;
        z-index: 5;
    }

    /* Heading Top Border Styles End Here */




    .white-space {
        height: 90px;
        border-bottom: 1px solid #ddd;
        box-shadow: 0px 12px 14px -10px #DDDDDD;
        -webkit-box-shadow: 0px 12px 14px -10px #DDDDDD;
        -moz-box-shadow: 0px 12px 14px -10px #DDDDDD;
        -o-box-shadow: 0px 12px 14px -10px #DDDDDD;

    }

    .fa-info {
        font-size: 24px;
        padding: 0 20px;
        color: #757575;
        line-height: 56px;
        vertical-align: middle;
    }

    a {
        color: #D6544E;
        font-size: 13px;
        text-decoration: none;
    }

    a:hover {
        color: #000;
    }

    .info-bar {
        height: 56px;
        background-color: #f5f5f5;
        margin: 20px 0;
    }

    .info-bar p:first-child {
        padding: 0;
    }





    .order a {
        display: block;
    }

    .order p {
        padding: 0;
        line-height: 20px;
    }

    .order h4,
    h5 {
        padding: 0;
    }

    .order div:nth-child(6) {
        border: none;
    }

    .width50 {
        width: 50%;
        float: left;
    }

    .width100 {
        width: 100%;
        float: left;
    }

    .padleft {
        margin-left: 39px;
    }

    .padright {
        padding-right: 40px;
    }

    .inline {
        display: inline-block;
    }

    .alignright {
        float: right;
    }

    .prod-description {
        text-transform: uppercase;
        color: #000;
    }

    .qty {
        font-weight: 900;
        font-size: 13px;
        color: #000;
        padding-left: 4px;
    }

    .smalltxt {
        font-size: 9px;
        vertical-align: middle;
    }

    .paymenttypes {
        border: 1px solid #DDDDDD;
        width: 135px;
        padding: 0 8px;
        margin: 0 0 20px 10px;
        display: inline-block;
        vertical-align: middle;
    }

    .paypal {
        width: 39px;
        height: 13px;
    }

    .cards {
        width: 135px;
        height: 24px;
    }

    .difwidth {
        width: 150px;
        line-height: 20px;
    }

    .order .center {
        line-height: 40px;
        color: #000;
    }

    .ptb--100 {
        padding: 10rem 0;
    }

    .ptb--60 {
        padding: 6rem 0;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    .order-details {
        padding: 2rem;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .checkout-payment {
        border: 1px solid #EDEDED;
        padding: 1rem;
        border-radius: 10px;
    }

    .zeref-payment-info {
        padding-left: 35px;
        padding-top: 10px;
    }

    .zeref-input-form {
        width: 100%;
        border-radius: 6px;
        padding: 1rem;
        border: 1px solid rgba(182, 190, 203, 0.8);
        margin-bottom: 20px;
    }

    .breadcumb-area {
        background: url(../images/breadcrumb.jpg) no-repeat scroll center/cover;
    }

    .zeref-breadcumb {
        position: relative;
        display: inline-block;
        padding-right: 1.2rem;
    }

    .zeref-breadcumb-link.current {
        color: #FE0606;
    }

    .zeref-breadcumb-link {
        color: #fff;
        font-size: 2rem;
    }

    .zeref-radio-input {
        display: none;
    }

    .zeref-radio-label {
        display: block;
        margin-bottom: 0;
        font-size: 1rem;
        cursor: pointer;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: flex;
        -webkit-box-align: center;
        -ms-box-align: center;
        -webkit-align-items: center;
        -moz-align-items: center;
        align-items: center;
    }

    .zeref-radio-label span {
        width: 1.5rem;
        height: 1.5rem;
        background: #fff;
        border: 1px solid #606060;
        display: inline-block;
        position: relative;
        border-radius: 50%;
        margin-right: 1.5rem;
    }

    .zeref-form-group span {
        font-size: 20px;
        padding-right: 18px;
    }

    .zeref-radio-input:checked+.zeref-radio-label span:before {
        -webkit-transform: translate(-50%, -50%) scale(1, 1);
        -moz-transform: translate(-50%, -50%) scale(1, 1);
        -ms-transform: translate(-50%, -50%) scale(1, 1);
        -o-transform: translate(-50%, -50%) scale(1, 1);
        transform: translate(-50%, -50%) scale(1, 1);
    }

    .zeref-radio-label span:before {
        position: absolute;
        content: '';
        left: 50%;
        top: 50%;
        background: #2C2E3D;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        -webkit-transform: translate(-50%, -50%) scale(0, 0);
        -moz-transform: translate(-50%, -50%) scale(0, 0);
        -ms-transform: translate(-50%, -50%) scale(0, 0);
        -o-transform: translate(-50%, -50%) scale(0, 0);
        transform: translate(-50%, -50%) scale(0, 0);
    }

    .zeref-radio-input:checked+.zeref-radio-label span:before {
        visibility: visible;
        opacity: 1;
    }

    .country_select.nice-select {
        width: 100%;
        height: 4.5rem;
        line-height: 4rem;
        border-radius: 10px;
        border: 1px solid rgba(182, 190, 203, 0.8);
    }

    .nice-select {
        float: none;
    }

    .nice-select {
        -webkit-tap-highlight-color: transparent;
        background-color: #fff;
        border-radius: 5px;
        border: 1px solid #E8E8E8;
        box-sizing: border-box;
        clear: both;
        cursor: pointer;
        display: block;
        float: left;
        font-family: inherit;
        font-size: 14px;
        font-weight: 400;
        height: 42px;
        line-height: 40px;
        outline: 0;
        padding-left: 18px;
        padding-right: 30px;
        position: relative;
        text-align: left !important;
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        white-space: nowrap;
        width: auto;
    }

    select.country_select {
        width: 100%;
        border-radius: 6px;
        padding: 1rem;
        border: 1px solid rgba(182, 190, 203, 0.8);
        margin-bottom: 20px;
        color: #777;
    }

    .order-table {
        width: 100%;
    }

    .zeref-form-group {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: flex;
        -webkit-box-align: center;
        -ms-box-align: center;
        -webkit-align-items: center;
        -moz-align-items: center;
        align-items: center;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        -webkit-justify-content: flex-start;
        -moz-justify-content: flex-start;
        justify-content: flex-start;
    }

    .checkout-payment a {
        background-color: #FFC439;
        padding: 14px 30px;
        border-radius: 5px;
        margin: 0 auto;
        display: table;
        color: #000;
        font-size: 20px;
        width: 60%;
        text-align: center;
    }

</style>
<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    section.innerbanner {
        margin-top: -65px;
    }

    .wrapper h2 {
        color: #858bcc;
    }

    .wrapper input#email {
        border: 1px solid #ccc;
    }

    thead {
        background-color: #858bcc !important;
    }

    .wrapper th,
    .wrapper td {
        text-align: center;
    }

</style>

<!-- Banner Section -->
<section class="innerbanner">
    <div class="inner-image">
        <img src="{{asset ('assets/images/blue-banner.jpg')}}" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->

<form action="{{route('invoice_payment_type')}}" method="post" class="form" id="payment-form">
    @csrf
    <div class="wrapper">
        @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @include('alerts')

        <div class="row">
            <div class="col-7 col">
                <h2>Billing Details</h2>

                <input type="hidden" name="payment_type" value="paypal">
                <div class="width50 padright">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{Auth::user()->first_name ?? ''}}">
                </div>
                <div class="width50 padright">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{Auth::user()->last_name ?? ''}}">
                </div>
                <div class="width100 padright">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" value="{{Auth::user()->email ?? ''}}">
                </div>
                <!-- <div class="width100 padright" id="card-element-div">
                        <label for="email">Debit/Credit Card Details</label>
                        <div id="card-element"></div>
                        <div id="card-errors"></div>
                    </div> -->

                <!-- <input style="display: inline;" id="pay_now" type="submit" name="credit_submit" class="btn btn-default" value="Pay Now"> -->
                <!-- <hr> -->

                <div class="row">
                    <!-- <div class="col-lg-5 col-md-offset-1">
                            <div class="inline1" >
                                <img style="width: 100%; height: 100px; object-fit: contain;" src="{{ asset('assets\images\userimages\stripe.png') }}" alt="">
                            </div>
                            <input id="pay_now" type="submit" name="stripe_submit" class="btn btn-default" value="Pay Now with Stripe">
                            <hr>
                        </div> -->
                    <div class="col-lg-5">
                        <!-- <div class="inline1" >
                                <img style="width: 100%; height: 100px; object-fit: contain;" src="{{ asset('assets\images\userimages\paypal.png') }}" alt="">
                            </div>
                            <input id="pay_now" type="submit" name="paypal_submit" class="btn btn-default" value="Pay Now with Paypal"> -->
                        <button id="pay_now" type="submit" name="paypal_submit" class="btn"
                            style="background-color: #FFC439; color: #FFFFFF"><img
                                src="{{ asset('assets\images\download.svg') }}" alt=""> Checkout</button>
                    </div>
                </div>
</form>


<!-- <div >
                        <div id="card-element"></div>
                        <div class="radio">
                            <label>
                                <input type="radio" class="pay-by-paypal" name="optionsRadios"
                                    id="optionsRadios2" value="option2">
                                Sign into your PayPal account to complete your purchase.
                            </label>
                            <div class="row paypal">
                                <div class="col-md-6">
                                    <div id="paypal-button-container" style="margin-top: 20px;"></div>
                                </div>

                            </div>
                        </div>
                    </div> -->

<!-- <form action="{{route('stripe_pay')}}" id="online_payment_form" novalidate="1" method="post">
                        @csrf
                        <input type="hidden" name="order_code" value="2022"/>
                        <div class="radio radio-success online-payment-radio">
                            <input type="radio" value="stripe" id="pm_stripe" name="paymentmode" checked="checked">
                            <label for="pm_stripe">Stripe Checkout</label>
                        </div>
                        <div class="form-group mtop25">
                            <h4 class="bold mbot25">Total: $20</h4>
                        </div>
                        <div id="pay_button">
                        </div>
                        <input type="hidden" name="hash" value="">
                    </form> -->




</div>
<div class="col-5 col order">
    <div id="paste">
        <div class="custom-title">
            <h2>Your Order</h2>
        </div>
        <div class="order-details mb--30">
            <table class="order-table">
                <thead>
                    <tr style="margin-bottom: 50px;">
                        <th style="color:#fff;font-weight:bold;">Product</th>
                        <th style="color:#fff;font-weight:bold;">Quantity</th>
                        <th style="color:#fff;font-weight:bold;">Total</th>

                    </tr>
                </thead>
                <tbody style="margin-top: 50px;">
                    <tr>
                        <td></td>
                    </tr>
                    @foreach(\Cart::session(Auth()->user()->id)->getContent() as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>${{number_format($order->price,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    {{--<tr class="cart-subtotal">
                                                <td>Cart Subtotal</td>
                                                <td></td>
                                                <td>${{number_format(\Cart::session(Auth()->user()->id)->getSubTotal(),2)}}</td>
                    </tr>--}}
                    <tr>
                        <td></td>
                    </tr>
                    <tr class="order-total">
                        <td class="bold_head">Ticket Fee</td>
                        <td></td>
                        <td class="bold_head">${{number_format($ticket_fee,2)}}</td>
                    </tr>
                    <tr class="order-total">
                        <td class="bold_head">Order Total</td>
                        <td></td>
                        <td class="bold_head">${{number_format($grand_total,2)}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal -->
<!-- <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transactions via stripe</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <div id="card-element"></div>
                                    <div id="card-errors"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Checkout</button>
                </div>
            </div>
        </div>
    </div> -->

<!-- <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transactions via Paypal</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div> -->

<!-- <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transactions via Bank Transfer</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <div class="">
                                        <label for="transaction_number">Enter Your Transactions Number</label>
                                        <input type="number" name="transaction_number" id="transaction_number" >
                                    </div>
                                    <p>Account Number : xxxxxxxx</p>
                                    <p>Pay With Bank transfer : xxxxxxxx</p>
                                    <p>Account Name : xxxxxxxx</p>
                                    <p>Account Email : xxxxxxxx</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

@endsection


@section('js')

<!-- <script src="https://js.stripe.com/v3/"></script> -->
<script>
    // $("input[name='stripe_submit']").click(function () {
    //     $("#card-element-div").hide();
    //     $("input[name='payment_type']").val('stripe');
    //     $('#payment-form').submit();
    // });

    $("input[name='paypal_submit']").click(function () {
        $("#card-element-div").hide();
        $("input[name='payment_type']").val('paypal');
        $('#payment-form').submit();
    });





    // var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    // var elements = stripe.elements();

    // var style = {
    //     base: {
    //         color: '#32325d',
    //         lineHeight: '18px',
    //         fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    //         fontSmoothing: 'antialiased',
    //         fontSize: '16px',
    //         '::placeholder': {
    //             color: '#aab7c4'
    //         }
    //     },
    //     invalid: {
    //         color: '#fa755a',
    //         iconColor: '#fa755a'
    //     }
    // };

    // // Create an instance of the card Element.
    // var card = elements.create('card', {style: style});

    // // Add an instance of the card Element into the `card-element` <div>.
    // card.mount('#card-element');

    // // Handle real-time validation errors from the card Element.
    // card.addEventListener('change', function(event) {
    //     var displayError = document.getElementById('card-errors');
    //     if (event.error) {
    //         displayError.textContent = event.error.message;
    //     } else {
    //         displayError.textContent = '';
    //     }
    // });

    // function stripeTokenHandler(token) {
    //   // Insert the token ID into the form so it gets submitted to the server
    //   var form = document.getElementById('payment-form'); // The id of the form that handles payment submission
    //   var hiddenInput = document.createElement('input');
    //   hiddenInput.setAttribute('type', 'hidden');
    //   hiddenInput.setAttribute('name', 'stripeToken');
    //   hiddenInput.setAttribute('value', token.id);
    //   form.appendChild(hiddenInput);

    //   // Submit the form
    //   form.submit();
    // }

    // // Handle form submission.
    // var form = document.getElementById('payment-form');
    // form.addEventListener('submit', function(event) {
    //   event.preventDefault();

    //   stripe.createToken(card).then(function(result) {
    //     if (result.error) {
    //       // Inform the customer that there was an error.
    //       var errorElement = document.getElementById('card-errors');
    //       errorElement.textContent = result.error.message;
    //   } else {
    //       // Send the token to your server.
    //       stripeTokenHandler(result.token);
    //   }
    // });
    // }); 









    // $(".pay-by-paypal").click(function () {
    //         $(".paypal").show();
    //     });


    //     $(".pay-by-card").click(function () {
    //         $(".paypal").hide();
    //     });

    //     $(".pay-by-paypal").click(function () {
    //         $(".card-info").hide();
    //     });

    //     $(document).ready(function () {
    //         $(".card-info").show();
    //         $(".paypal").hide();
    //     });

</script>
<!-- <script
<?php //$client=\App\PaymentGateway::find(1); ?>
    src="https://www.paypal.com/sdk/js?client-id={{-- $client->paypal_client--}}&debug=true&disable-funding=venmo&currency=USD&intent=capture"
    data-sdk-integration-source="button-factory"></script> -->

<!-- <script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'white',
                layout: 'vertical',
                label: 'paypal',
            },
            createOrder: function (data, actions) {
                // tickets = parseInt($('.ticketsNo').val());
                // unitPrice = (event_type != 'paid') ? 0 : (parseFloat($('.unitPrice').val()).toFixed(2));
                // var ticket_fee_percentage = 9;
                // let amount_value = (event_type != 'paid') ? 0 : (parseFloat((tickets * unitPrice) + ((tickets * unitPrice) * ticket_fee_percentage / 100)).toFixed(2));
                return actions.order.create({
                    purchase_units: [{
                        "amount": {
                            "currency_code": "USD",
                            "value": 10 * 100,
                        }
                    }]
                });
            },

            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {

                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    status = orderData['status'];
                    payment_data = data;
                    // console.log(data);
                    console.log('hekllo compor');
                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // createInvoice(); // ahsan
                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function (err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
</script> -->


@endsection
