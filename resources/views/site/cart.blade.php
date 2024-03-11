@extends('layouts.site.app')

@section('title', 'Event Page')

@section('content')

<style>
        #right1 {
  float: right;
  margin-top: 20px;
}
        .align-items-center {
            -webkit-box-align: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
            display: inline-flex;
        }
        .cart__remove--btn {
            margin-right: 1.5rem;
        }
        .cart__thumbnail {
            max-width: 10rem;
            line-height: 1;
        }
        .cart__content {
            padding-left: 1.5rem;
        }
        .cart__content--title {
            line-height: 2.5rem;
            font-size: 16px;
            font-weight: bold;
        }
        .cart__table--body__list {
            padding: 2rem 2rem 2rem 0;
        }
        .align-items-center {
            -webkit-box-align: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
        }
        a.theme-btn {
            background-color: #f6931e;
            padding: 10px 20px;
            border-radius: 50px;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            overflow: hidden;
            display: block;
            width: fit-content;
            text-align: center;
        }
        .coupon__code--field__input.border-radius-5 {
            padding: 7%;
            border: 1px solid #c8c9ca;
        }
        h2 {
            color: #f6931e;
            font-size: 54px;
            font-weight: bold;
        }
        .cart__table--inner {
            width: 100%;
            border-spacing: 0;
        }
        .cart__table--header__list {
            padding: 10px 0px;
            text-transform: uppercase;
            text-align: center;
            border-bottom: 1px solid #e4e4e4;
            font-size: 18px;
            color: #fff;
        }
        .continue__shopping {
            padding-top: 2rem;
        }
        .cart__remove--btn {
            font-weight: 600;
            width: 3rem;
            height: 3rem;
            text-align: center;
            line-height: 3.5rem;
            background: var(--white-color);
            -webkit-box-shadow: 0 2px 22px rgb(0 0 0 / 16%);
            box-shadow: 0 2px 22px rgb(0 0 0 / 16%);
            margin-right: 1rem;
            border-radius: 50%;
            border: 0;
            padding: 0;
            cursor: pointer;
            position: absolute;
            left: 22% !important;
        }
        .cart__thumbnail img {
            width: 100px;
        }
        .up,
        .down {
            display: block;
            color: black;
            font-size: 18px;
            padding: 0 7px;
            margin: 5px;
            box-sizing: border-box;
            cursor: pointer;
            border-radius: 20px;
            width: 24px;
            line-height: 24px;
            height: 24px;
            user-select: none;
            background: #e4e4e4;
        }
        .counter input {
            appearance: none;
            border: 0;
            background: white;
            text-align: center;
            width: 42px;
            line-height: 24px;
            font-size: 15px;
            border-radius: 5px;
        }
        .counter {
            width: 120px;
            margin: 50px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cart__summary {
            -webkit-box-shadow: 0 2px 22px rgb(0 0 0 / 16%);
            box-shadow: 0 2px 22px rgb(0 0 0 / 16%);
            padding: 2rem;
            background: #fff;
            position: sticky;
            top: 0;
        }
        a.theme-btn {
            background-color: #f6931e;
            padding: 10px 20px;
            border-radius: 50px;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            overflow: hidden;
        }
        .cart__table--body__list {
            border-bottom: 1px solid #e4e4e4;
            padding: 2rem 0.5rem 2rem 0;
            text-align: center;
        }
        .continue__shopping--clear {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff !important;
            border: 0;
            padding: 0;
            background: inherit;
            cursor: pointer;
            background: #f6931e;
            padding: 10px 20px;
            border-radius: 30px;
        }
        .continue__shopping--link {
            font-size: 16px;
            font-weight: 600;
            color: #f068ed;
        }
        .cart__content {
            padding-left: 1.5rem;
        }
        .cart__content--title {
            line-height: 2.5rem;
            font-size: 16px;
            font-weight: bold;
        }
        .cart__thumbnail {
            max-width: 10rem;
            line-height: 1;
        }

        .section--margin {
            margin-bottom: 50px;
        }
        .innercaption h2 {
    color: black;
}


a.continue__shopping--clear {
    font-size: 13px;
    font-weight: 500;
    background-color: transparent;
    background-color: #f068ed;
    border-radius: unset;
    padding: 10px 15px 10px 15px;
    color: #fff !important;
    margin-left: 60px;
}
thead {
    background-color: #858bcc !important;
}

@media (max-width: 1366px) {
    .cart__remove--btn {
        position: absolute;
        left: 10% !important;
    }
}

    </style>

















<!-- Coins sec -->
<!-- Banner Section -->
<div class="container">
    
@if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
</div>
<!-- Banner Section -->
<section class="innerbanner">
    <div class="inner-image">
        <img src="{{asset ('assets/images/blue-banner.jpg')}}" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                  
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->
<!-- Banner Section -->

<!-- Product Sec -->
<section class="cart__section section--margin py-5 my-5">
    <div class="container">
        <div class="cart__section--inner">
            <form action="#">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart__table">
                        <h2 style="color:black;">Shopping Cart</h2>
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Product</th>
                                        <th class="cart__table--header__list">Price</th>
                                        <th class="cart__table--header__list">Quantity</th>
                                        <th class="cart__table--header__list">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                    @if(\Cart::session(Auth()->user()->id)->isEmpty())
                                        <tr class="cart__table--body__items empty">
                                        <td></td>
                                        <td></td>
                                        <td style="color:red;font-size:30px;font-weight:bold"><img src="{{asset ('assets/images/empty.png')}}" alt=""></td>
                                        </td></td>
                                        </tr>
                                    @else
                                    @php 
                                        $items = \Cart::session(Auth()->user()->id)->getContent(); 
                                    @endphp
                                    @foreach($items as $row)
                                    <tr class="cart__table--body__items">
                                        <td class="cart__table--body__list">
                                            <div class="cart__product d-flex align-items-center justify-content-center">
                                                <button class="cart__remove--btn" aria-label="search button"
                                                    type="button" onclick="removeProduct({{$row->id}})">
                                                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" width="16px" height="16px">
                                                        <path
                                                            d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <div class="cart__thumbnail">
                                                    <a href="{{ route('site.event.details', ['id' => $row->id]) }}">
                                                        @php 
                                                            $img1 =  ($row->associatedModel->image != null) ? (explode('storage/', $row->associatedModel->image)[1]) : '';
                                                        @endphp
                                                        @if($row->associatedModel->image !=null && file_exists(public_path('storage/'.$img1)))
                                                            <img src="{{ asset($row->associatedModel->image) }}" class="border-radius-5" width="50" alt="event image">
                                                        @else
                                                            <img src="{{asset('assets/images/dummy.png')}}" class="border-radius-5" width="50" alt="event image">
                                                        @endif
                                                </div>
                                                <div class="cart__content">
                                                    <h4 class="cart__content--title"><a
                                                            href="{{ route('site.event.details', ['id' => $row->id]) }}">{{$row->name}}</a></h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">${{number_format($row->price,2)}}</span>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <div class='counter'>
                                                <div class='down' onclick='decreaseCount({{$row->id}})'>-</div>
                                                <input type='number' id="{{$row->id}}" min="1" max="{{$row->associatedModel->available_quantity}}" value="{{$row->quantity}}" disabled>
                                                <div class='up' onclick='increaseCount({{$row->id}})'>+</div>
                                            </div>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price end" id="sum{{$row->id}}">${{number_format(\Cart::get($row->id)->getPriceSum(),2)}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="{{route('home')}}">Continue shopping</a>
                                <a class="continue__shopping--clear" onclick="javascript:clearCart();">Clear Cart</a>
                            </div>
                            <div>
                            <a href="{{route('checkout')}}" class="continue__shopping--clear" id="right1">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:red;">WARNING</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 style="color:red;">Can Not Checkout When Cart Is Empty!</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Product Sec -->
@endsection

@section('js')
<script type="text/javascript">
function clearCart(){
        $.ajax({
            url: "{{ route('clear.cart') }}",
            method: "GET",
            data: {
                
            },
            success: function (data) {
                if (data.status == 1) {
                    $(".cart__table--body").html(data.view);
                    successtoast(data.message);
                   
                } else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
   

}

function decreaseCount(id){

    var count=$("#"+id).val();
    if(count == 1){
   
        errortoast('Can not be zero!');
    }
    else{
    $.ajax({
            url: "{{ route('cart.minus.quantity') }}",
            method: "GET",
            data: {
                'event_id':id,
                'qty':1, 
            },
            success: function (data) {
                if (data.code == 200) {
                    $(".cart__table--body").html(data.view);
                    successtoast(data.message);
                  
                   
                }
                else{
                    errortoast(data.message);
            }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
    }

}

function increaseCount(id){
    
    $.ajax({
            url: "{{ route('cart.plus.quantity') }}",
            method: "GET",
            data: {
                'event_id':id,
                'qty':1, 
            },
            success: function (data) {
                if (data.code == 200) {
                    $(".cart__table--body").html(data.view);
                    successtoast(data.message);
                }
                else{
                    errortoast(data.message);
            }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });

}

function removeProduct(id){
    $.ajax({
            url: "{{ route('cart.remove.product') }}",
            method: "GET",
            data: {
                id:id, 
            },
            success: function (data) {
                if (data.code == 200) {
                    $(".cart__table--body").html(data.view);
                    successtoast(data.message);
                } else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');
            }
        });
}
</script>
@endsection
