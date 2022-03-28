<?php
namespace App\Http\Controllers;
    use App\Models\Materials_list;
    use Illuminate\Support\Facades\DB;
?>
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
            @if (($req->user_service_id === $user->service_id && $user->grade_id == 4 && $req->rA_approval === null && $req->deliv_or === null) || ($req->user_service_id === $user->service_id && $req->user_id == $user->id && $req->sent_or == 0 && $req->token === null) || ($req->user_service_id === $user->service_id && $user->grade_id == 7 && $req->wh_chief_approval === null &&  $req->deliv_or == 0) || ($req->user_service_id === $user->service_id && $user->grade_id == 8 && $req->cm_approval === null &&  $req->deliv_or == 0))
                <div class="col-12">
                <div class="card px-2 py-2">
                    <div class="">
                        <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Modifier un bordereau</strong></h3>
                    </div>
                  
                    <div class="modal-body overflow-hidden">
                    
                        <div class="card card-primary">
                            <form action="{{ route('user.mat_transferts.update', $delivery) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <input type="hidden" name="deliv_id" value="<?= $delivery->id ?>">
                                    <input type="hidden" name="request_id" value="<?= $req->id ?>">
                                    <input type="hidden" name="user_grade" value="<?= $user->grade_id ?>">
                                    <input type="hidden" name="request_author" value="<?= $req->user_id ?>">
                                    <div class="d-flex col-lg-12">
                                        <div class="form-group" style="width:100%">
                                        
                                        <div class="d-flex col-lg-12">
                                                @if ($user->grade_id != 7 && $user->grade_id != 8 && $user->grade_id != 4)
                                                <div class="form-group" style="width:100%">
                                                    <label for="deliv_number" class="h5">Numéro du bordereau<span class="text-red">*</span></label>
                                                    <input type="number" value="<?= $delivery->delivery_number ?>" class="form-control" id="deliv_number" name="deliv_number" autocomplete="off" maxlength="12" required>
                                                
                                                </div>
                                                <div class="form-group ml-4" style="width:100%">
                                                    <label for="sens" class="h5">Sens<span class="text-red">*</span></label>
                                                    <select class="form-control" id="sens" name="sens">
                                                        <option> -- Sélectionner -- </option> 
                                                        <option value="1" @if($delivery->sens == 1) selected @else  @endif>ENTREE</option>
                                                        <option value="2" @if($delivery->sens == 2) selected @else  @endif >SORTIE</option>
                                                        <option value="3" @if($delivery->sens == 3) selected @else  @endif>REINTEGRATION</option>
                                                    </select>
                                                </div>
                                            @endif
                                        
                                        </div>
                                        
                                        @if ($req->dPal_approval == 1 && $user->grade_id == 7)
                                            <div>
                                                <div class="d-flex col-lg-12">
                                                    <div class="form-group" style="width:100%">
                                                        <label for="leaving_mag" class="h5">Magasin cédant<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" id="leaving_mag" name="leaving_mag"  value="<?= $delivery->leaving_mag ?>" autocomplete="off" minlength="3" maxlength="60" required>
                                                    </div>
                                                    <div class="form-group ml-4" style="width:100%">
                                                        <label for="benef_mag" class="h5">Magasin bénéficiaire<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control"  value="<?= $delivery->benef_mag ?>" id="benef_mag" name="benef_mag" autocomplete="off" minlength="3" maxlength="60" required>
                                                    </div>
                                                </div>

                                                <div class=" form-group col-lg-12">
                                                    <label for="destination" class="h5">Destination<span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" id="destination" name="destination"  value="<?= $delivery->destination ?>" autocomplete="off" minlength="3" maxlength="150" required>
                                                    
                                                </div>

                                                <div class=" form-group col-lg-12">
                                                    <label for="other_refs" class="h5">Autres références<span class="text-red">*</span></label>
                                                    <input type="text" class="form-control" id="other_refs" name="other_refs" autocomplete="off"  value="<?= $delivery->other_refs ?>" minlength="3" maxlength="200" required>
                                                    
                                                </div>
                                            </div>
                                        @endif

                                        <div class="table-responsive">
                                            <span id="error"></span>
                                            <table class="table table-bordered" id="other_piece">
                                            <tr>
                                                @if ($user->grade_id == 4)
                                                    <th>Code article<span class="text-red">*</span></th>    
                                                @endif
                                                @if ($user->grade_id != 7)
                                                    <th>Désignation<span class="text-red">*</span></th>
                                                    <th>Unité<span class="text-red">*</span></th>
                                                    <th>Qté demandée<span class="text-red">*</span></th>
                                                @endif
                                                @if ($req->dPal_approval == 1 && $user->grade_id == 8)
                                                    <th>Qté livrée<span class="text-red">*</span></th>
                                                    <th>Observations<span class="text-red">*</span></th>
                                                @endif
                                                @if ($user->id == $req->user_id)
                                                    <th><button type="button" onclick="addField()" id="addd" class="btn btn-success bg-green btn-sm"><i class="fa fa-plus"></i></button></th>
                                                @endif
                                            </tr>
                                            @if ($user->grade_id != 7)
                                            
                                            @foreach ($materials as $mater)
                                                <tr>
                                                    <input type="hidden" name="mat_id[]" value="<?= $mater->id ?>">
                                                    
                                                    @if ($user->grade_id == 4)
                                                    <td>
                                                        <input type="text" class="form-control" name="article_code[]" id="article_code" value="<?= $mater->article_code ?>" minlength="2" maxlength="14" required />
                                                    </td>
                                                    @endif
                                                    <?php
                                                 
                                                        $all_materials = Materials_list::select('*')->where('category', $mater->designation)->orderByDesc('id')->get();

                                                        // $this_mats = Materials_list::select('*')->where('name', $mater->designation)->orderByDesc('id')->get();

                                                        // $new_maters = Materials_list::select('*')->where('category', $this_mats)->orderByDesc('id')->get();
                                                        // dd($mater);
                                                    ?>
                                                    @if($user->id != $req->user_id)
                                                    <td>
                                                        <select class="form-control" name="title[]" id="title">
                                                            <option value="">-- Sélectionner --</option>
                                                            @foreach($all_materials as $material)
                                                                <option value="<?= $material->name ?>" @if($material->name == $mater->designation) selected @else  @endif><?= $material->name ?></option>
                                                            @endforeach
                                                            {{-- @if($all_materials && $user->grade_id == 4)
                                                                @foreach($new_maters as $maters)
                                                                    <option value="<?= $maters->name ?>" @if($mater->designation) selected @else  @endif><?= $mater->designation ?></option>
                                                                @endforeach
                                                            @endif --}}
                                                            @if($all_materials)
                                                                <option value="<?= $mater->designation ?>" @if($mater->designation) selected @else  @endif><?= $mater->designation ?></option>
                                                            @endif
                                                    </select>
                                                    </td>
                                                    @endif
                                                    @if($user->id == $req->user_id)
                                                        <td>
                                                            <select class="form-control" name="title[]" id="title" required>
                                                                <option value="">-- Sélectionner --</option>
                                                                
                                                                @foreach($materials_categories as $mat_cat) 
                                                                    <option value="<?= $mat_cat->name ?>" @if($mat_cat->name == $mater->designation) selected @else  @endif>
                                                                        <?= $mat_cat->name ?>
                                                                    </option> 
                                                                @endforeach 
                                                            </select>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <input type="text" class="form-control lettres" pattern="[A-Za-z]{1,16}" name="unit[]" id="unit" value="<?= $mater->stock_count ?>" min="1" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control chiffres" name="qte[]" id="qte" value="<?= $mater->asked_quantity ?>" min="1" maxlength="6" required />
                                                    </td>
                                                    @if ($req->dPal_approval == 1 && $user->grade_id == 8)
                                                        <td>
                                                            <input type="number" class="form-control chiffres" name="deliv_qte[]" placeholder="07" id="deliv_qte" value="<?= $mater->delivery_quantity ?>" min="0" maxlength="6"/>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="observations[]" placeholder="Observations" id="observations" value="<?= $mater->observations ?>" min="3" maxlength="300"/>
                                                        </td>
                                                    @endif
                                                    @if ($user->id == $req->user_id)
                                                    <td>
                                                        <button type="button" onclick="removeField()" class="btn btn-danger btn-sm removee" style="background-color:darkred">
                                                            <span class="fa fa-minus"></span>
                                                        </button>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            @endif
                                            </table>
                                        </div> 
                                    </div>

                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>

                                    <button type="submit" class="btn btn-info btn-style text-white"  style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                </div>
            @else
                <p>Désolé, modification impossible</p>
            @endif
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
                if(i < 15){
                    var html = '';
                    // if (i = 1) {
                    //     html +='<tr><th>Code article</th><th>Désignation</th><th>Unité</th><th>Qté demandée</th></tr>';
                    // }
                
                    html += '<tr><input type="hidden" name="other[]" value="1">';
                    html += '@if ($user->grade_id == 4)<td><input type="text" class="form-control" name="article_codeo[]" id="article_code'+i+'" placeholder="D672" minlength="2" maxlength="14" required /></td>@endif';
                    html += '@if ($user->grade_id != 7)<td><select class="form-control" name="titleo[]" id="title" required><option value="">-- Sélectionner --</option> @foreach($materials_categories as $material) <option value="<?= $material->name ?>"><?= $material->name ?></option> @endforeach </select></td>';
                    html += '<td><input type="text" class="form-control lettres" pattern="[a-z]{1,16}" name="unito[]" id="unit'+i+'" placeholder="07" min="1" maxlength="6" required /></td>';
                    html += '<td><input type="number" class="form-control chiffres" name="qteo[]" id="qte'+i+'" placeholder="13" min="1" maxlength="6" required /></td>@endif';
                    html += '@if ($req->dPal_approval == 1 && $user->grade_id == 8)<td><input type="number" class="form-control chiffres" name="deliv_qte[]" id="deliv_qte'+i+'" placeholder="07" min="0" maxlength="6"/></td>';
                    html += '<td><input type="text" class="form-control" name="observationso[]" id="observations'+i+'" placeholder="Observations" min="3" maxlength="300"/></td>@endif';
                    html += '@if ($user->grade_id != 7 && $user->grade_id != 8)<td><button type="button" onclick="removeField()" class="btn btn-danger btn-sm removee" style="background-color:darkred"><span class="fa fa-minus"></span></button></td></tr>@endif';
                    
                        
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

        $(document).ready(function() {
            $(".lettres").keyup(function (event) {
                var value = jQuery(this).val();
                value = value.replace(/[^a-z]+/g, '');
                jQuery(this).val(value);
            });
        });
      </script>
</body>
</html>