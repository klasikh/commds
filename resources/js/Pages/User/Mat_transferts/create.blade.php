<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DigiCom</title>
</head>
<body>
    <section class="content" id="app">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Ajouter un bordereau</strong></h3>
                </div>
                <div class="modal-body overflow-hidden">
                    <div>
                        <span class="text-red">Tous les champs sont obligatoires (*)</span>
                    </div>
                    <div class="card card-primary">
                        <form @submit.prevent="saveDelivData()">
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            @csrf_field
                            <div class="card-body">

                            <div class="d-flex col-lg-12">
                                <div class="form-group" style="width:100%">

                                  <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="phone_number" class="h5">Numéro du bordereau<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="deliv_number" placeholder="Numéro du bordereau" v-model="form.deliv_number" :class="{ 'is-invalid' : form.errors.deliv_number }" autocomplete="off" disabled>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.deliv_number }">
                                            {{ form.errors.deliv_number }}
                                        </div>
                                    </div>
                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="sex" class="h5">Sens<span class="text-red">*</span></label>
                                        <select class="form-control" id="sex" v-model="form.sens" :class="{ 'is-invalid' : form.errors.sens }">
                                            <!-- <option value=""> -- Sélectionner -- </option> -->
                                            <option value="1">ENTREE</option>
                                            <option value="1">SORTIE</option>
                                            <option value="2">REINTEGRATION</option>
                                        </select>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.sens }">
                                            {{ form.errors.sens }}
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="table-responsive">
                                    <span id="error"></span>
                                    <table class="table table-bordered" id="other_piece">
                                      <tr>
                                        <th>Code article</th>
                                        <th>Désignation</th>
                                        <th>Unité</th>
                                        <th>Qté demandée</th>
                                        <th><button type="button" @click="addField()" id="addd" class="btn btn-success bg-green btn-sm"><i class="fa fa-plus"></i></button></th>
                                      </tr>
                                        
                                    </table>
                                </div> 
                                

<!-- <div class="row">
    <div class='col-md-6 col-md-offset-3 col-xs-6 col-offset-3 col-lg-6 col-lg-offset-3'>
        <button type="button" class="btn btn-default btn-primary" @click="ajouterLigne()"><span class="glyphicon glyphicon-plus"></span> Ajouter un joueur </button>
    </div>
</div> -->
                                  </div>

                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>

                                <button type="submit" class="btn btn-info btn-style text-white"  style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.deliv_number || !form.sens || form.processing">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

</body>
</html>