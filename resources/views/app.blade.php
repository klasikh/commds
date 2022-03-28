<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
      
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet" -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="/css/appStyle.css">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/datatables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="/css/overlayscrollbars.min.css">

        <!-- Font Awesome -->
        <!-- fullCalendar -->
        <link rel="stylesheet" href="{{ asset('custom/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('custom/plugins/fullcalendar/main.css') }}">
        {{-- Theme style --}}
        {{-- <link rel="stylesheet" href="{{ asset('custom/dist/css/adminlte.min.css') }}"> --}}

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('custom/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('custom/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('custom/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('custom/plugins/datatables/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/datatables/css/jquery.dataTables.css') }}">
        <link rel="stylesheet" href="{{ asset('/datatables/css/dataTables.jqueryui.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/plugins/datatables/jquery.dataTables.min.css') }}">
      
        <link rel="stylesheet" href="{{ asset('custom/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('custom/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('custom/plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">


        <!-- Scripts -->
        @routes
        <script src="/js/jquery.js"></script>
        {{-- <script src="/js/jquery.signature.js"></script> --}}
        <script src="{{ mix('js/app.js') }}" defer></script>
        {{-- <script src="/js/jquery.signature.js"></script> --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        <script src="/js/adminlte.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script>
        <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
        
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    </head>
    <body class="bg-light sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
        @inertia

        @env ('local')
            <script type="text/javascript" src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv

        <!-- jQuery -->
        <script src="/js/jquery.js"></script>

        <script src="{{ asset('custom/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- AdminLTE App -->
        {{-- <script src="{{ asset('custom/dist/js/adminlte.min.js') }}"></script> --}}

        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('custom/dist/js/demo.js') }}"></script> --}}

        <!-- jQuery UI -->
        <script src="{{ asset('custom/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- include summernote css/js -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

        {{-- cKEditor --}}
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script> --}}
        <script src="/js/datatables.min.js"></script>
        <script src="/datatables/js/dataTables.dataTables.js"></script>
        <script src="/datatables/js/jquery.dataTables.js"></script>
        <script src="/datatables/js/dataTables.jqueryui.js"></script>

        <script src="{{ asset('custom/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <!-- fullCalendar 2.2.5 -->
        <script src="{{ asset('custom/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('custom/plugins/fullcalendar/main.js') }}"></script>

        <!-- SweetAlert2 -->
        <script src="{{ asset('custom/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('custom/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Page specific script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
        <script>

            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

            var images = document.getElementById("file").value,
            
            // ***************************************************************
            function getCurrentTime() {
                return moment().format('h:mm A');
            }

            function getCurrentDateTime() {
                return moment().format('MM/DD/YY h:mm A');
            }

            function dateFormat(datetime) {
                return moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('MM/DD/YY h:mm A');
            }

            function timeFormat(datetime) {
                return moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('h:mm A');
            }

         $(document).ready(function() {
                $('.summernote').summernote();
            });
        </script>

    </body>
</html>
