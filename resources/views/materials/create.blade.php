<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet" -->

        <!-- Styles -->
        <link rel="stylesheet" href="/css/appStyle.css">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/datatables.css">
        <link rel="stylesheet" href="/datatables/css/dataTables.dataTables.css">
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
        {{-- <link rel="stylesheet" href="{{ asset('custom/plugins/datatables/jquery.dataTables.min.css') }}"> --}}
        {{-- <script src="/datatables/css/jquery.dataTables.css"></script>
        <script src="/datatables/css/dataTables.jqueryui.css"></script> --}}

        <link rel="stylesheet" href="{{ asset('custom/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('custom/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('custom/plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">


        <!-- Scripts -->
        @routes
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        <script src="/js/adminlte.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script>

<body class="bg-light sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
    <div style="padding: 20px">
    <section class="content" id="app">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Ajout de matériel(s)</strong></h3>
                </div>
                <div class="modal-body overflow-hidden">
                
                    <div class="card card-primary">
                        <form action="{{ route('user.materials.addMat') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">

                                        <div class="table-responsive">
                                            <span id="error"></span>
                                            <table class="table table-bordered" id="other_piece">
                                            <tr>
                                                {{-- <th>Code article<span class="text-red">*</span></th> --}}
                                                <th>Désignation<span class="text-red">*</span></th>
                                                <th>Qté à ajouter<span class="text-red">*</span></th>
                                                <th><button type="button" onclick="addField()" id="addd" class="btn btn-success bg-green btn-sm"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                                
                                            </table>
                                        </div> 
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>

                                <button type="submit" class="btn btn-info btn-style text-white"  style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
      </div>

        <!-- jQuery -->
        <script src="/js/jquery.js"></script>

        <script src="{{ asset('custom/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- AdminLTE App -->
        {{-- <script src="{{ asset('custom/dist/js/adminlte.min.js') }}"></script> --}}

        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('custom/dist/js/demo.js') }}"></script> --}}

        <!-- jQuery UI -->
        <script src="{{ asset('custom/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        {{-- SOCKET IO CDN --}}
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>


        <!-- include summernote css/js -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

        {{-- cKEditor --}}
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script> --}}
        <script src="/js/datatables.min.js"></script>
        <script src="/datatables/js/dataTables.dataTables.js"></script>
        {{-- <script src="/datatables/js/jquery.dataTables.js"></script>
        <script src="/datatables/js/dataTables.jqueryui.js"></script> --}}

        <!-- fullCalendar 2.2.5 -->
        <script src="{{ asset('custom/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('custom/plugins/fullcalendar/main.js') }}"></script>

        <!-- SweetAlert2 -->
        <script src="{{ asset('custom/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('custom/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Page specific script -->

        <script>

            // ***************************************************************

         $(document).ready(function() {
                $('.summernote').summernote();
            });
            
        $(document).ready(function(){
            var i=0
            
            // if ( typeof this.i == 'undefined' ) this.i = 2;
            $(document).on('click', '#addd', function(){
                if(i < 20){
                    var html = '';
                    // if (i = 1) {
                    //     html +='<tr><th>Code article</th><th>Désignation</th><th>Unité</th><th>Qté demandée</th></tr>';
                    // }
                
                    html += '<tr>';
                    html += '<td><select class="form-control" name="designation[]" id="designation" required><option value="">-- Sélectionner --</option> @foreach($materials_lists as $material) <option value="<?= $material->name ?>"><?= $material->name ?></option> @endforeach </select></td>';
                    html += '<td><input type="number" class="form-control" name="qte[]" id="qte'+i+'" placeholder="13" min="1" maxlength="6" required /></td>';
                    html += '<td><button type="button" onclick="removeField()" class="btn btn-danger btn-sm removee" style="background-color:darkred"><span class="fa fa-minus"></span></button></td></tr>';
                    
                        
                    $('#other_piece').append(html);   
                        i++;
                    console.log(i);
                    const parent = document.getElementById('newRow');
                    parent.value = i;
                }
                max_val = i
            })
            $(document).on('click', '.removee', function(){
            $(this).closest('tr').remove();
            i--;
            console.log(i);
            
        }) 
        });


      </script>
</body>
</html>