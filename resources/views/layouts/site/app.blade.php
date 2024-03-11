@include('layouts.site.header')
@yield('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@yield('content')

@include('layouts.site.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.bindClickHandler();
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });


        function successtoast(message){
            toastMixin.fire({
                animation: true,
                title: message
            });
        }

        function errortoast(message){
            toastMixin.fire({
                title: message,
                icon: 'error'

            });
        }
        @if (Session::has('success'))
        successtoast('{{ Session::get('success') }}');
        @endif
        @if (Session::has('error'))
        errortoast('{{ Session::get('error') }}');
        @endif



        function like(id){
            $.ajax({
            url: "{{ route('like.event') }}",
            method: "POST",
            data: {
                event_id:id,
                _token:"{{csrf_token()}}",

            },
            success: function(data) {
                if (data.status == 1) {

                successtoast(data.message);

                }

                 else {
                    errortoast(data.message);
                }
            },
            error: function(error) {
                errortoast('something went wrong');

            }
        });



        }
        </script>
@yield('js')


