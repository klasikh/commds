<template>

  <div>
    <admin-layout>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Modification d'un compte utilisateur</strong></h3>
                </div>
                <div class="modal-body overflow-hidden">
                    <div class="h4">
                        <!-- <span>Aperçu: <span class="text-capitalize">{{ form.name }}</span>
                        </span> -->
                    </div>
                    <div class="card card-primary">
                        <form @submit.prevent="editUser">
                            <!-- <form :action="route('admin.users.store')" method="post"> -->
                            <!-- {{ csrf_field }} -->
                            <div class="card-body">
                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="name" class="h5">Nom</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nom de l'utilisateur" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off" >

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name }">
                                            {{ form.errors.name }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="surname" class="h5">Prénoms</label>
                                        <input type="text" class="form-control" id="surname" placeholder="Prénoms de l'utilisateur" v-model="form.surname" :class="{ 'is-invalid' : form.errors.surname }" autofocus="autofocus" autocomplete="off">

                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.surname }">
                                            {{ form.errors.surname }}
                                        </div>
                                    </div>


                                </div>

                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="sex" class="h5">Sexe</label>
                                        <select class="form-control" id="sex" v-model="form.sex" :class="{ 'is-invalid' : form.errors.sex }">
                                            <!-- <option value=""> -- Sélectionner -- </option> -->
                                            <option value="M">Masculin</option>
                                            <option value="F">Féminin</option>
                                        </select>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.sex }">
                                            {{ form.errors.sex }}
                                        </div>
                                    </div>

                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="phone_number" class="h5">Numéro de téléphone</label>
                                        <input type="number" class="form-control" id="phone_number" placeholder="Contact de l'utilisateur" v-model="form.phone_number" :class="{ 'is-invalid' : form.errors.phone_number }" autofocus="autofocus" autocomplete="off">
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.phone_number }">
                                            {{ form.errors.phone_number }}
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group" style="width:100%">
                                    <label for="email" class="h5">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Adresse email de l'utilisateur" v-model="form.email" :class="{ 'is-invalid' : form.errors.email }" autocomplete="off">

                                    <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.email }">
                                        {{ form.errors.email }}
                                    </div>
                                </div>


                                <div class="d-flex col-lg-12">
                                    <div class="form-group" style="width:100%">
                                        <label for="services" class="h5">Service</label>
                                        <multiselect
                                            v-model="form.service_id"
                                            :options="serviceOptions"
                                            :multiple="false"
                                            :taggable="true"
                                            placeholder="Sélectionner le service"
                                            @addServ="addServ"
                                            label="name"
                                            track-by="id"
                                        ></multiselect>

                                         <div class="invalid-feedback" :class="{ 'd-block' : form.errors.service_id}">
                                            {{ form.errors.service_id }}
                                        </div>
                                    </div>


                                    <div class="form-group ml-4" style="width:100%">
                                        <label for="grades" class="h5">Fonction</label>
                                        <multiselect
                                            v-model="form.grade_id"
                                            :options="gradeOptions"
                                            :multiple="false"
                                            :taggable="true"
                                            placeholder="Sélectionner le grade"
                                            @addGrade="addGrade"
                                            label="name"
                                            track-by="id"
                                        ></multiselect>

                                         <div class="invalid-feedback" :class="{ 'd-block' : form.errors.grade_id}">
                                            {{ form.errors.grade_id }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn text-white" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>
                                <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.name || !form.surname || !form.sex || !form.phone_number || !form.email || !form.service_id || !form.grade_id || form.processing">Ajouter</button>
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
        props: ['grades', 'user', 'services',],
        components: {
            AdminLayout,
        },
        data() {
            return {

                form: this.$inertia.form({
                    id: this.user.id,
                    name: this.user.name,
                    surname: this.user.surname,
                    sex: this.user.sex,
                    phone_number: this.user.phone_number,
                    email: this.user.email,
                    service_id: this.user.service_id,
                    grade_id: this.user.grade_id,
                }),
                serviceOptions: this.services,
                gradeOptions: this.grades,

            }
        },
        computed: {
        },
        methods: {
            addGrade(newGrade) {
                let grade = {
                    name: newGrade,
                }
                this.gradeOptions.push(grade)
                this.form.grade.push(grade)
            },
            addServ(newService) {
                let serv = {
                    name: newService,
                }
                this.serviceOptions.push(service)
                this.form.service.push(service)
            },
            editUser() {
                this.form.patch(this.route('admin.users.update', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Le compte utilisateur a été modifié avec succès !'
                        })
                    }
                })
            },

        }
    }
</script>

<style>

</style>
