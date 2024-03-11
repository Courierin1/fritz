<Footer id="footer" class="pt-3 pb-3">
    <div class="container pt-3 pb-3">
        <div class="row">

            <div class="col-md-12">
                <p class="text-center"> <img src="{{ asset('assets/images/footlogo.png') }}" alt=""> </p>
            </div>

            <div class="col-md-12">


                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item"> <a class="nav-link1" href="{{ route('home') }}">Home</a><i
                            class="fa-solid fa-horizontal-rule"></i></li>
                    <li class="list-group-item"> <a class="nav-link1" href="{{ route('site.about') }}">About Us</a></li>

                    <!-- <li class="list-group-item"><a class="nav-link1" href="#">Tickets</a></li> -->


                    <li class="list-group-item"><a class="nav-link1" href="{{ route('site.contact-us') }}">Contact
                            Us</a></li>

                </ul>

            </div>



        </div>



</Footer>

<section id="copyright">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <p>© Copyright 2022 Frimix. All right reserved.</p>

            </div>

            <div class="col-md-6">

                <ul class="list-group list-group-horizontal">
                    <a href="#">
                        <li class="list-group-item"> <i class="fa-brands fa-facebook-f"></i></li>
                    </a>
                    <a href="#">
                        <li class="list-group-item"><i class="fa fa-instagram" aria-hidden="true"></i></li>
                    </a>



                </ul>

            </div>

        </div>
    </div>

</section>




</body>



<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">







{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script> --}}


<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>





<script type="text/javascript">
    $(document).on('ready', function() {
        $(".regular").slick({
            infinite: true,
            slidesToShow: 4, // Shows a three slides at a time
            slidesToScroll: 3, // When you click an arrow, it scrolls 1 slide at a time
            arrows: true, // Adds arrows to sides of slider
            autoplay: true,
            prevArrow: '<img id="prippp" src="./assets/images/pri.png" />',
            nextArrow: '<img src="./assets/images/next.png" />',
            dots: false // Adds the dots on the bottom

        });
    });

    $(document).on('ready', function() {
        $(".regular1").slick({
            infinite: true,
            slidesToShow: 4, // Shows a three slides at a time
            slidesToScroll: 3, // When you click an arrow, it scrolls 1 slide at a time
            arrows: true, // Adds arrows to sides of slider
            autoplay: true,
            prevArrow: '<img id="prippp" src="./assets/images/pri.png" />',
            nextArrow: '<img src="./assets/images/next.png" />',
            dots: false // Adds the dots on the bottom

        });

    });


    $(document).ready(function() {

        $('#example').DataTable({
            "ordering": false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 20],
                [5, 10, 20]
            ]
        });


    });
</script>










</html>
