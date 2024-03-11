@extends('layouts.site.app')


@section('content')

<section id="contactpage">
    <div class="container">

    </div>
</section>

<section class="map-sec">
    <div class="container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13004082.928417291!2d-104.65713107818928!3d37.275578278180674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2s!4v1659117424767!5m2!1sen!2s" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<section class="contact_form py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-12">
                <div class="contact_field">
                    <h2 class="text-uppercase">Give us a <b>Message</b></h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="email" class="form-control contact-email" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="inter" id="inter" placeholder="I am interested in...">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone No">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Message" id="message" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="SUBMIT" onclick="javascript:contact()">
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="contact_field">
                    <h2 class="text-uppercase">Get in <b>Touch</b></h2>
                    <ul class="">
                        <li><img src="./assets/images/phone-icon.png" class="" alt="..."><a href="tel:(+1) 123 456 7891">(+1) 123 456 7891</a></li>
                        <li><img src="./assets/images/envelope-icon.png" class="" alt="..."><a href="mailto:info@frimixevents.com">info@frimixevents.com</a></li>
                        <li><img src="./assets/images/web-icon.png" class="" alt="..."><a href="www.frimix.com">www.frimix.com</a></li>
                        <li><img src="./assets/images/clock-icon.png" class="" alt="..."><a href="">Mon - Sat 9:00am - 6:00 pm</a></li>
                    </ul>
                </div>
                <div class="social">
                    <ul class="">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')

<script>
function contact(){ 
$.ajax({
            url: "{{ route('contact.post') }}",
            method: "POST",
            data: {
                name: document.getElementById('name').value,
                email: $('input[name="email"]').val(),
                phone: document.getElementById('phone').value,
                interest: document.getElementById('inter').value,
                message: document.getElementById('message').value,
                _token: '{{csrf_token()}}'


            },
            success: function(data) {
                if (data.status == 1) {

                    successtoast(data.message);
                    document.getElementById('name').value = "";
                    $('input[name="email"]').val('');
                    document.getElementById('phone').value = "";
                    document.getElementById('inter').value = "";
                    document.getElementById('message').value = "";
                } else if (data.status == 2) {
                    errortoast('something went wrong');

                } else {
                    errortoast('something went wrong');
                }
            },
            error: function(error) {
                errortoast('something went wrong');

            }
        });
    }


</script>

@endsection