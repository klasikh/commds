<template>

  <div>
    <admin-layout>
      <section class="content" id="app">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Ajouter une demande</strong></h3>
                </div>
                <div class="modal-body overflow-hidden">
                    <!-- <div>
                        <span class="text-red">Tous les champs sont obligatoires (*)</span>
                    </div> -->
                    <div class="card card-primary">
                        <form @submit.prevent="newRequest">
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                            <div class="card-body">

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

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.request_number }">
                                            {{ form.errors.request_number }}
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">

                                    <div class="form-group" style="width:100%">
                                        <label for="reference" class="h5">Référence<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="reference" placeholder="DT54657" v-model="form.reference" :class="{ 'is-invalid' : form.errors.reference }" autocomplete="off" minlength="6" maxlength="22" disabled>

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.reference }">
                                            {{ form.errors.reference }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="estimated_amount" class="h5">Coût estimé (fr CFA)<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="estimated_amount" placeholder="100000" min="1000" v-model="form.estimated_amount" :class="{ 'is-invalid' : form.errors.estimated_amount }" autocomplete="off" minlength="5" maxlength="10">

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.estimated_amount }">
                                            {{ form.errors.estimated_amount }}
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group" style="width:100%">
                                    <label for="title" class="h5">Titre de la demande (Désignation)<span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="title" placeholder="Titre de la demande" v-model="form.title" :class="{ 'is-invalid' : form.errors.title }" autocomplete="off" minlength="8" maxlength="100">

                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.title }">
                                        {{ form.errors.title }}
                                    </div>
                                </div>
                                
                                <div class="d-flex">
                                    <div class="form-group" style="width:100%;" id="#catD">
                                        <label for="request_category_id" class="h5" >Catégories<span class="text-red">*</span></label>
                                        <multiselect
                                            v-model="form.request_category_id"
                                            :options="request_categoryOptions"
                                            :multiple="false"
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
                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="pw_date" class="h5">Date de retrait prévue<span class="text-red">*</span></label>
                                        <input type="date" class="form-control" id="pw_date" v-model="form.pw_date" :class="{ 'is-invalid' : form.errors.pw_date }" @click="getDate()">

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.pw_date }">
                                            {{ form.errors.pw_date }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="width:100%">
                                    <label for="trans_mention_id" class="h5">Transmis pour<span class="text-red">*</span></label>
                                    <multiselect
                                        v-model="form.trans_mention_id"
                                        :options="trans_mentionOptions"
                                        :multiple="false"
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

                                <div v-if="form.request_type_id.id === 1">

                                    <div class="form-group" style="width:100%">
                                    <label for="asked_works" class="h5">Description des travaux demandés<span class="text-red">*</span></label>
                                            <textarea rows="4"  class="form-control" id="custom_text" v-model="form.asked_works" :class="{ 'is-invalid' : form.errors.asked_works }" autocomplete="off" placeholder="Veuillez donner une description des travaux demandés" minlength="12"></textarea>

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.asked_works}">
                                            {{ form.errors.asked_works }}
                                        </div>
                                    </div>
                                </div>

                                <div v-if="form.request_type_id.id === 2 || form.request_type_id.id === 3">

                                    <div class="form-group" style="width:100%">
                                        <label for="description" class="h5">Description <span class="text-red">*</span></label> <span>(Description du défaut constaté ou produits à acheter)</span>
                                        <textarea rows="4"  class="form-control summernote" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off" placeholder="Veuillez donner une description détaillée de votre demande" minlength="12"></textarea>

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                            {{ form.errors.description }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>
                                <button type="submit" class="btn btn-info btn-style text-white" v-if="form.request_type_id.id === 1" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.request_type_id || !form.title || !form.reference || !form.request_category_id || !form.trans_mention_id || !form.pw_date || !form.asked_works || !form.estimated_amount || form.processing">Ajouter</button>

                                <button type="submit" class="btn btn-info btn-style text-white" v-if="form.request_type_id.id === 2 || form.request_type_id.id === 3" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.request_type_id || !form.title || !form.reference || !form.request_category_id || !form.trans_mention_id || !form.pw_date || !form.description || !form.estimated_amount || form.processing">Ajouter</button>
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
// import axios from 'axios'
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
// import CKEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        props: ['request_types', 'request_categories', 'trans_mentions', 'request_number', 'reference', 'today_date'],
        components: {
            AdminLayout,
            // ckeditor: CKEditor.component
        },
        // el:'#dynamicApp',
        data() {
            return {
                form: this.$inertia.form({
                    id: '',
                    request_number: this.request_number,
                    request_type_id: '',
                    request_category_id: '',
                    reference: this.reference,
                    title: '',
                    trans_mention_id: '',
                    description: '',
                    asked_works: '',
                    estimated_amount: '',
                    pw_date: '',
                    today_date: ''
                }),
                request_typeOptions: this.request_types,
                request_categoryOptions: this.request_categories,
                trans_mentionOptions: this.trans_mentions,
                content: null,
            }
        },
        computed: {

//   'summernote' : require('./Summernote')
        },
        methods: {
            summer() {
            $('#summernote').summernote();
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            },
            getDate(){
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();

                var maxday = dtToday.getDate() + 30;

                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();


                var minDate = (year) + '-' + month + '-' + day;
                var maxDate = (year) + '-12-31';
                document.getElementById('pw_date').setAttribute('min', minDate);
                document.getElementById('pw_date').setAttribute('max', maxDate);
            },
            normalDate(){
                let input = document.querySelector("#pw_date");

                let nextYear = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
                // let today = new Date(new Date().setFullYear(new Date().getDay() + 1));
                let today = new Date();

                input.max = this.formatDate(nextYear)

                input.min = this.formatDate(today)
            },
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

        }
    }
</script>

<style>

</style>
