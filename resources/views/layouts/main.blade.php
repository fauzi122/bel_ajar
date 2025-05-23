<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/avatar/icon.jpg') }}" type="image/x-icon">
    <!-- Custom styles -->
    <link href="{{ asset('assets/css/bootstraps.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

    {{-- Modal --}}
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    {{-- End Modal --}}

    <!-- Chart library -->
    {{-- <script src="{{ asset('assets/plugins/chart.min.js') }}"></script> --}}
    <!-- Icons library -->
    <script src="{{ asset('assets/plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <style>
        .signature {
            cursor: pointer;
        }
    </style>
    <title>E-SPP</title>
</head>

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        @include('sweetalert::alert')
        @include('partials.sidebar')
        <div class="main-wrapper">
            <!-- ! Main nav -->
            @include('partials.navbar')
            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                @yield('content')
                @include('partials.footer')
            </main>
        </div>
    </div>

</body>

<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    function confirmDelete(e, elem) {
        e.preventDefault();
        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data Ini Tidak Dapat Di Kembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batalkan!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                elem.closest('form').submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Di Batalkan!',
                    'Data Anda Aman !',
                    'error'
                )
            }
        })
    }
    $('#dataTable').DataTable({
        "oLanguage": {
            "sSearchPlaceholder": "Silahkan Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [10, 20, 50,100,500],
        "pageLength": 10
    });
    
</script>
@stack('script')

</html>
