<template>

  <div>
    <admin-layout>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Ajouter une demande</strong></h3>
                </div>
                <div class="modal-body overflow-hidden">
                    <div>
                        <span class="text-red">Tous les champs sont obligatoires (*)</span>
                    </div>
                    <div class="card card-primary">
                        <form @submit.prevent="newRequest">
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                            <div class="card-body">

                            <div class="d-flex col-lg-12">
                                 <div class="form-group" style="width:100%">
                                        <label for="request_number" class="h5">Numéro de la demande<span class="text-red">*</span></label>
                                        <input type="text" class="form-control"  id="request_number" placeholder="DA/7896/2022" v-model="form.request_number" :class="{ 'is-invalid' : form.errors.request_number }" autocomplete="off" minlength="8" maxlength="14">
                                        
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.request_number }">
                                            {{ form.errors.request_number }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ml-4" style="width:100%">
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

                                         <div class="invalid-feedback" :class="{ 'd-block' : form.errors.request_type_id}">
                                            {{ form.errors.request_type_id }}
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group" style="width:100%">
                                    <label for="request_category_id" class="h5">Catégories<span class="text-red">*</span></label> <span>(Vous pouvez faire une sélection mutiple)</span>
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

                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="title" class="h5">Titre de la demande (Désignation)<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="title" placeholder="Titre de la demande" v-model="form.title" :class="{ 'is-invalid' : form.errors.title }" autocomplete="off" minlength="8" maxlength="100">
                                        
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.title }">
                                            {{ form.errors.title }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="reference" class="h5">Référence<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="reference" placeholder="DT54657" v-model="form.reference" :class="{ 'is-invalid' : form.errors.reference }" autocomplete="off" minlength="3" maxlength="12">
                                        
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.reference }">
                                            {{ form.errors.reference }}
                                        </div>
                                    </div>

                                </div>

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
                                   <label for="description" class="h5">Description <span class="text-red">*</span></label> <span>(Description du défaut constaté ou produits à acheter)</span>
                                        <textarea rows="4"  class="form-control" id="description" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off" placeholder="Veuillez donner une description détaillée de votre demande" minlength="12"></textarea>
                                    
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                        {{ form.errors.description }}
                                    </div>
                                </div>

                                <div class="form-group" style="width:100%">
                                   <label for="asked_works" class="h5">Description des travaux demandés<span class="text-red">*</span></label>
                                        <textarea rows="4"  class="form-control" id="asked_works" v-model="form.asked_works" :class="{ 'is-invalid' : form.errors.asked_works }" autocomplete="off" placeholder="Veuillez donner une description des travaux demandés" minlength="12"></textarea>
                                    
                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.asked_works}">
                                        {{ form.errors.asked_works }}
                                    </div>
                                </div>

                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="estimated_amount" class="h5">Coût estimé (fr CFA)<span class="text-red">*</span></label>
                                        <input type="tel" class="form-control" id="estimated_amount" placeholder="100000" v-model="form.estimated_amount" :class="{ 'is-invalid' : form.errors.estimated_amount }" autocomplete="off" minlength="5" maxlength="10">
                                        
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.estimated_amount }">
                                            {{ form.errors.estimated_amount }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="pw_date" class="h5">Date de retrait prévu<span class="text-red">*</span></label>
                                        <input type="date" class="form-control" id="pw_date" min="" max="" v-model="form.pw_date" :class="{ 'is-invalid' : form.errors.pw_date }" autocomplete="off">
                                        
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.pw_date }">
                                            {{ form.errors.pw_date }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>
                                <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.request_type_id || !form.reference || !form.title || !form.description || form.processing">Ajouter</button>
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
        props: ['request_types', 'request_categories', 'trans_mentions'],
        components: {
            AdminLayout,
        },
        data() {
            return {
                form: this.$inertia.form({
                    id: '',
                    request_number: '',
                    request_type_id: '',
                    request_category_id: '',
                    reference: '',
                    title: '',
                    trans_mention_id: '',
                    description: '',
                    asked_works: '',
                    estimated_amount: '',
                    pw_date: '',
                }),
                request_typeOptions: this.request_types,
                request_categoryOptions: this.request_categories,
                trans_mentionOptions: this.trans_mentions,
            }
        },
        computed: {
        },
        methods: {
            addRequest(newRequest) {
                let request_type = {
                    name: newRequest,
                }
                this.request_typeOptions.push(request_type)
                this.form.request_type.push(request_type)
            },
            addRequestCat(newRequestCat) {
                let request_category = {
                    name: newRequestCat,
                }
                this.request_categoryOptions.push(request_category)
                this.form.request_category.push(request_category)
            },
            transMention(newTransMen) {
                let trans_mention = {
                    name: newTransMen,
                }
                this.trans_mentionOptions.push(trans_mention)
                this.form.trans_mention.push(trans_mention)
            },
            newRequest() {
                this.form.post(this.route('user.requests.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouvelle demande ajoutée avec succès !'
                        })
                    }
                })
            },

        // ANOTHER SCRIPT
          signPad() {
                var sig = $('#sig').signature();
                $('#disable').click(function() {
                    var disable = $(this).text() === 'Disable';
                    $(this).text(disable ? 'Enable' : 'Disable');
                    sig.signature(disable ? 'disable' : 'enable');
                });
                $('#clear').click(function() {
                    sig.signature('clear');
                });
                $('#json').click(function() {
                    alert(sig.signature('toJSON'));
                });
                $('#svg').click(function() {
                    alert(sig.signature('toSVG'));
                });
            },
            signRequest(){
                var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
                $('#clear').click(function(e) {
                    e.preventDefault();
                    sig.signature('clear');
                    $("#signature64").val('');
                });

            },
            takePDF(){
                var doc = new jsPDF();
                var elementHTML = $('#therequest').html();
                var specialElementHandlers = {
                    '#elementH': function (element, renderer) {
                        return true;
                    }
                };
                doc.fromHTML(elementHTML, 15, 15, {
                    'width': 170,
                    'elementHandlers': specialElementHandlers
                });

                // Save the PDF
                doc.save('sample-document.pdf');
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
 
           },
     
        },


    onMouseDown($event){
        this.signP = true
        this.prevX = $event.offsetX
        this.prevY = $event.offsetY
    }, 
    mousemove($event) {
        if(this.signP) {
            const  currX  = $event.offsetX
            const  currY  = $event.offsetY
            this.draw(this.prevX, this.prevY, currX, currY)
            this.prevX  =  currX
            this.prevY  =  currY
        }
    }, 
    draw(depX, depY, destX, destY){
        this.ctx.beginPath()
        this.ctx.moveTo(depX, depY)
        this.ctx.lineTo(destX, destY)
        this.ctx.closePath()
        this.ctx.stroke()
        
        const img = this.$el.toDataURL('image/png').replace('image/png',        'image/octet-stream')
        this.$emit('update:modelValue', img)

    },
mounted(){
    this.ctx  = this.$el.getContext('2d')
    this.ctx.strokeStyle  =  'black'
    this.ctx.lineWidth  =  2
},
        watch : {
    modelValue(model) {
        if(!model) {
            this.ctx.clearRect(0, 0, this.$el.width, this.$el.height)
        }
    }
},
            // SIGN SCRIPT
            save(){
                var _this = this;
                var png = _this.$refs.signature.save('images/png')
                var jpeg = _this.$refs.signature.save('image/jpeg')
                var svg = _this.$refs.signature.save('image/svg+xml');
                console.log(png);
                console.log(jpeg)
                console.log(svg)
            },
            openSignModal(){
                /* Au clic sur un élément de menu... */
                $('#openSignModal').click(function(event){
                    
                    /* On récupère l'url du lien sur lequel on vient de cliquer. */
                    var url = $(this).attr('href');
                    
                    /*
                    * Dans notre bloc #content, on inject le contenu
                    * de la page ciblée (par le href) en se limitant
                    * à ce qui est dans le bloc #content.
                    */
                    $('#content').load(url + " #content");
                    
                    /*
                    * On évite le comportement par défaut qui est de 
                    * nous envoyer sur la page donnée dans le href).
                    */
                    event.preventDefault();
                });
            },
            clear(){
                var _this = this;
                _this.$refs.signature.clear();
            },
            undo(){
                var _this = this;
                _this.$refs.signature.undo();
                var _this = "Activer";
            },
            addWaterMark(){
                var _this = this;
                _this.$refs.signature.addWaterMark({
                    text: user.name + ' ' + user.surname,          // watermark text, > default ''
                    font:"20px Arial",         // mark font, > default '20px sans-serif'
                    style:'all',               // fillText and strokeText,  'all'/'stroke'/'fill', > default 'fill		
                    fillStyle:"red",           // fillcolor, > default '#333' 
                    strokeStyle:"blue",	   // strokecolor, > default '#333'	
                    x:100,                     // fill positionX, > default 20
                    y:200,                     // fill positionY, > default 20				
                    sx:100,                    // stroke positionX, > default 40
                    sy:200                     // stroke positionY, > default 40
                });
            },
            fromDataURL(url){
                var _this = this;
                _this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
            },
            handleDisabled(){
                var _this = this;
                _this.disabled  = !_this.disabled
            },
            // END SIGN SCRIPT
 
    }
</script>

<style>

</style>