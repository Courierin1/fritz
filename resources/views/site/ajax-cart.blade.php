@if(\Cart::session(Auth()->user()->id)->isEmpty())
<tr class="cart__table--body__items empty">
                                        <td></td>
                                        <td></td>
                                        <td style="color:red;font-size:30px;font-weight:bold"><img src="{{asset ('assets/images/empty.png')}}" alt=""></td>
                                        </td></td>
                                        </tr>
@else
@php $items = \Cart::session(Auth()->user()->id)->getContent(); @endphp
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
                                                    </a>
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

                           