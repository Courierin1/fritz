@include('layouts.admin.header')
@yield('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@yield('content')

@include('layouts.admin.footer')
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
            timer: 3000,
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
</script>    
@yield('js')


