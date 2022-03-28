<template>

  <div>
    <admin-layout>
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
                        <form @submit.prevent="saveDelivData">
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                            <div class="card-body">

                            <div class="d-flex col-lg-12">

                               <div class="d-flex col-lg-12">
                                <div class="form-group" style="width:100%">
                                    <label for="request_type_id" class="h5">Type de demande<span class="text-red">*</span></label>
                                    <multiselect
                                        v-model="form.request_type_id"
                                        :options="request_typeOptions"
                                        :multiple="false"
                                        :taggable="true"
                                        placeholder="Sélectionner le type de demande"
                                        @addRequest="addRequest"
                                        label="title"
                                        track-by="id"
                                    ></multiselect>
                                    <!-- <label for=""></label> -->
                                    <div class="invalid-feedback" :class="{ 'd-block' : form.errors.request_type_id}">
                                        {{ form.errors.request_type_id }}
                                    </div>
                                </div>

                                <div class="form-group ml-4" style="width:100%">
                                        <label for="request_number" class="h5">Numéro de la demande<span class="text-red">*</span></label>
                                        <input type="text" class="form-control"  id="request_number" placeholder="DA/7896/2022" v-model="form.request_number" :class="{ 'is-invalid' : form.errors.request_number }" autocomplete="off" minlength="8" maxlength="20" disabled>

                                        <!-- <input type="text" class="form-control"  id="request_number" placeholder="DA/7896/2022" v-model="form.request_number2" v-if="form.request_type_id.id === 2 " :class="{ 'is-invalid' : form.errors.request_number }" autocomplete="off" minlength="8" maxlength="20" disabled> -->

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.request_number }">
                                            {{ form.errors.request_number }}
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="form-group" style="width:100%">
                                        <label for="title" class="h5">Titre de la demande (Désignation)<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="title" placeholder="Titre de la demande" v-model="form.title" :class="{ 'is-invalid' : form.errors.title }" autocomplete="off" minlength="8" maxlength="100">

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.title }">
                                            {{ form.errors.title }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="reference" class="h5">Référence<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="reference" placeholder="DT54657" v-model="form.reference" :class="{ 'is-invalid' : form.errors.reference }" autocomplete="off" minlength="6" maxlength="22" disabled>

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.reference }">
                                            {{ form.errors.reference }}
                                        </div>
                                    </div>

                                </div>

                                <div v-if="form.request_type_id.id === 1">
                                    <div class="form-group" style="width:100%">
                                        <label for="trans_mention_id" class="h5">Transmis pour<span class="text-red">*</span></label> <span>(Vous pouvez faire une sélection mutiple)</span>
                                        <multiselect
                                            v-model="form.trans_mention_id"
                                            :options="trans_mentionOptions"
                                            :multiple="true"
                                            :taggable="true"
                                            placeholder="Sélectionner"
                                            @transMention="transMention"
                                            label="name"
                                            track-by="id"
                                        ></multiselect>

                                        <div class="invalid-feedback" :class="{ 'd-block' : form.errors.trans_mention_id}">
                                            {{ form.errors.trans_mention_id }}
                                        </div>
                                    </div>

                                    <div class="form-group" style="width:100%">
                                    <label for="asked_works" class="h5">Description des travaux demandés<span class="text-red">*</span></label>
                                            <textarea rows="4"  class="form-control" id="custom_text" v-model="form.asked_works" :class="{ 'is-invalid' : form.errors.asked_works }" autocomplete="off" placeholder="Veuillez donner une description des travaux demandés" minlength="12"></textarea>

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.asked_works}">
                                            {{ form.errors.asked_works }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-if="form.request_type_id.id === 2 || form.request_type_id.id === 3">
                                    <div class="form-group" style="width:100%;" id="#catD">
                                        <label for="request_category_id" class="h5" >Catégories<span class="text-red">*</span></label> <span>(Vous pouvez faire une sélection mutiple)</span>
                                        <multiselect
                                            v-model="form.request_category_id"
                                            :options="request_categoryOptions"
                                            :multiple="true"
                                            :taggable="true"
                                            placeholder="Sélectionner"
                                            @addRequestCat="addRequestCat"
                                            label="name"
                                            track-by="id"
                                        ></multiselect>

                                        <div class="invalid-feedback" :class="{ 'd-block' : form.errors.request_category_id}">
                                            {{ form.errors.request_category_id }}
                                        </div>
                                    </div>

                                    <div class="form-group" style="width:100%">
                                    <label for="description" class="h5">Description <span class="text-red">*</span></label> <span>(Description du défaut constaté ou produits à acheter)</span>
                                            <textarea rows="4"  class="form-control summernote" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off" placeholder="Veuillez donner une description détaillée de votre demande" minlength="12"></textarea>

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                            {{ form.errors.description }}
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="estimated_amount" class="h5">Coût estimé (fr CFA)<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="estimated_amount" placeholder="100000" min="5000" v-model="form.estimated_amount" :class="{ 'is-invalid' : form.errors.estimated_amount }" autocomplete="off" minlength="5" maxlength="10">

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.estimated_amount }">
                                            {{ form.errors.estimated_amount }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="pw_date" class="h5">Date de retrait prévu<span class="text-red">*</span></label>
                                        <input type="date" class="form-control" id="pw_date" v-model="form.pw_date" :class="{ 'is-invalid' : form.errors.pw_date }" @click="getDate()">

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.pw_date }">
                                            {{ form.errors.pw_date }}
                                        </div>
                                    </div>

                                </div>
                                
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
                                            <option value="2">SORTIE</option>
                                            <option value="3">REINTEGRATION</option>
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

    </admin-layout>
  </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import axios from 'axios'

    export default {
        props: ['descri', 'deliv_number', 'today_date'],
        components: {
            AdminLayout,
        },
        data(){
            return {
                form: this.$inertia.form({
                    id: '',
                    deliv_number: this.deliv_number,
                    sens: this.sens,
                    article_code: '',
                    title: document.getElementById("title1") +' ' + document.getElementById("title1"), 
                    unit: '',
                    qte: '',
                }),
                deliv_number: this.deliv_number,
                // max_val = this.max_val
                
            }
        },
        computed:{
       
        },
        methods: {
          addField(){
                var i=0
                
                // if ( typeof this.i == 'undefined' ) this.i = 2;
                $(document).on('click', '#addd', function(){
                if(i < 10){
                    var html = '';
                    // if (i = 1) {
                    //     html +='<tr><th>Code article</th><th>Désignation</th><th>Unité</th><th>Qté demandée</th></tr>';
                    // }
                
                    html += '<tr>';
                    html += '<td><input type="text" class="form-control" name="article_code['+i+']" id="article_code'+i+'" placeholder="D672"  v-model="form.sens" :class="{ "is-invalid" : form.errors.article_code } required /></td>';
                    html += '<td><input type="text" class="form-control title" name="title[]" id="title'+i+'" placeholder="Désignation" v-model="form.title" :class="{ "is-invalid" : form.errors.title }" autocomplete="off" minlength="8" maxlength="100" required /></td>';
                    html += '<td><input type="number" class="form-control" name="unit[]" id="unit'+i+'" placeholder="07" required /></td>';
                    html += '<td><input type="number" class="form-control" name="qte[]" id="qte'+i+'" placeholder="13" required /></td>';
                    html += '<td><button type="button" onclick="removeField()" class="btn btn-danger btn-sm removee" style="background-color:darkred"><span class="fa fa-minus"></span></button></td></tr>';
                    
                     
                    $('#other_piece').append(html);   
                     i++;
                    console.log(i);
                    const parent = document.getElementById('newRow');
                    parent.value = i;
                }
                max_val = i
          })
                    
          },
          saveDelivData(){
            var elements = document.getElementById("title1");
            var title = $("#title1").val('');
            console.log(elements.value);
            console.log(title.value);
            // for (var i = 0, element; element = elements[i++];) {
            //       // if (element.type === "text" && element.value === "")
            //           console.log(element[i++].val())
            // }
            // axios.post('user.mat_transferts.store', {
              
            // })
            
              this.form.post(this.route('user.mat_transferts.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouvelle demande ajoutée avec succès !'
                        })
                    }
                })
          },
           ajouterLigne()
{       var i=0
     if ( typeof this.i == 'undefined' ) this.i = 2;
    
 
    var doc = document.getElementById('other_piece'); //élément parent
     
    const  row1 = document.createElement("div");   
           row1.className="row insert";
     
    const  fieldset = document.createElement('fieldset');
           fieldset.className = "form-fieldset ui-input __first";
                    
     
    const   input = document.createElement('input');
            input.type = "text";
            input.name = "player" + i.toString();
            input.id = "username"; 
            input.tabIndex ="0";
     
    const   label = document.createElement("label");
            label.htmlFor = "username";
            label.text = "username";
            label.id = "label";
     
    const   span = document.createElement('span');
            span.dataText = "Pseudonyme";
            var texte = "Pseudonyme";
            span.innerHTML = texte;
             
           
   //Ajouter les éléments
    i += 1;
     
     
   doc.appendChild(row1);
   row1.appendChild(fieldset);
   fieldset.appendChild(input);
   fieldset.appendChild(label);
   label.appendChild(span);
    
   const parent = document.getElementById('nbJoueurs');
        
    parent.value = i;
 
           }
                }
    }
</script>

<style>

</style>