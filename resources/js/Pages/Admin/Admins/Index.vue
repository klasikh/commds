<template>

  <div>
    <admin-layout>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="row bg-color-blue mx-3 mb-4 py-1">
                  <div class="card-header">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des administrateurs </strong></h3>

                    <div>
                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                            <div class="info-box">
                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                            <div class="info-box-content">
                                <h5>
                                    {{ admins_count }}
                                    {{ adminText }}
                                </h5>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                                <!-- /.info-box -->
                            </div>

                            <button type="button" class="btn btn-info text-white btn-style mt-3" style="float:right" @click="openModal" v-if="$page.props.auth.hasRole.superAdmin">
                                Ajouter
                            </button>
                        </div>
                  </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                    <thead>
                      <tr>
                        <th class="text-capitalize">Nom</th>
                        <th class="text-capitalize">Prénom</th>
                        <th class="text-capitalize">Rôle</th>
                        <th class="text-capitalize">Email</th>
                        <th class="text">Ajouté le</th>
                        <th class="text-capitalize text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(admin, index) in admins" :key="index">
                        <td>{{ admin.name }}</td>
                        <td>{{ admin.surname }}</td>
                        <td>
                            <template v-for="role in admin.roles" :key="role.id">
                                {{ role.name }}
                            </template>
                        </td>
                        <td>{{ admin.email }}</td>
                        <td>{{ admin.created_at }}</td>
                        <td class="text-center">
                          <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editModal(admin)">
                            <i class="fa fa-pencil"></i>
                          </button>
                          &nbsp; &nbsp;
                          <button class="btn btn-xs btn-danger" @click="deleteAdmin(admin)">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- <div class="card-footer clearfix">
                  panigation links
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="modal fade" id="modal-lg">
          <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>{{ formTitle }}</strong></h3>
                      <button type="button" class="close" @click="closeModal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body overflow-hidden">
                      <div class="h4">
                          <!-- <span>Aperçu: <span class="text-capitalize">{{ form.name }}</span>
                          </span> -->
                      </div>
                      <div class="card card-primary">
                          <form @submit.prevent="editMode ? editAdmin() : createAdmin()">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="name" class="h4">Nom</label>
                                      <input type="text" class="form-control" id="name" placeholder="Nom de l'administrateur" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off" minlength="3" maxlength="30">
                                  </div>
                                <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.surname }">
                                      {{ form.errors.name }}
                                  </div>
                                   <div class="form-group">
                                      <label for="name" class="h4">Prénoms</label>
                                      <input type="text" class="form-control" id="name" placeholder="Prénoms de l'administrateur" v-model="form.surname" :class="{ 'is-invalid' : form.errors.surname }" autocomplete="off" minlength="3" maxlength="50">
                                  </div>
                                  <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.surname }">
                                      {{ form.errors.surname }}
                                  </div>

                                  <div class="form-group">
                                      <label for="email" class="h4">Email</label>
                                      <input type="email" class="form-control" id="email" placeholder="Adresse email de l'administrateur" v-model="form.email" :class="{ 'is-invalid' : form.errors.email }" autocomplete="off" minlength="8" maxlength="55">
                                  </div>
                                  <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.email }">
                                      {{ form.errors.email }}
                                  </div>

                                  <div class="form-group" v-if="editMode">
                                      <label for="roles" class="h4">Rôles</label>
                                      <multiselect
                                          v-model="form.roles[0]"
                                          :options="roleOptions"
                                          :multiple="false"
                                          :taggable="true"
                                          placeholder="Sélectionner le rôle"
                                          @addTag="addTag"
                                          label="name"
                                          track-by="id"
                                      ></multiselect>
                                  </div>
                                  <div class="invalid-feedback" :class="{ 'd-block' : form.errors.roles}">
                                      {{ form.errors.roles }}
                                  </div>
                              </div>

                              <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                  <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.name || !form.surname || !form.email || form.processing">{{ buttonTxt }}</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </admin-layout>
  </div>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        el: "#app",
        props: ['admins', 'roles', 'admins_count'],
        components: {
            AdminLayout,
        },
        data() {
            return {
                editedIndex: -1,
                editMode: false,
                form: this.$inertia.form({
                    id: '',
                    name: '',
                    surname: '',
                    email: '',
                    roles: []
                }),
                roleOptions: this.roles,
            }
        },
        computed: {
            adminText() {
                return this.admins_count  <= 1 ? 'Administrateur' : 'Administrateurs';
            },
            formTitle() {
                return this.editedIndex === -1 ? 'Ajouter nouveau administrateur' : 'Modifier ce compte  administrateur';
            },
            buttonTxt() {
                return this.editedIndex === -1 ? 'Ajouter' : 'Modifier';
            },
            // checkMode() {
            //    return this.editMode === false ? this.createAdmin() : this.editAdmin();
            //}
        },
        methods: {
            addTag(newRole) {
                let tag = {
                    name: newRole,
                }
                this.roleOptions.push(tag)
                this.form.roles.push(tag)
            },
            editModal(admin) {
                this.editMode = true
                $('#modal-lg').modal('show')
                this.editedIndex = this.admins.indexOf(admin)
                this.form.name = admin.name
                this.form.surname = admin.surname
                this.form.email = admin.email
                this.form.id = admin.id
                this.form.roles = admin.roles
            },
            openModal() {
                this.form.clearErrors()
                this.editMode = false
                this.form.reset()
                this.editedIndex = -1
                $('#modal-lg').modal('show')
            },
            closeModal() {
                this.form.clearErrors()
                this.editMode = false
                this.form.reset()
                $('#modal-lg').modal('hide')
            },
            createAdmin() {
                this.form.post(this.route('admin.admins.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.form.reset()
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouveau compte administrateur créé !'
                        })
                    }
                })
            },
            editAdmin() {
                this.form.patch(this.route('admin.admins.update', this.form.id, this.form), {
                    preserveScroll: false,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Le compte administrateur a été modifié avec succès !'
                        })
                        this.closeModal()
                    }
                })
            },
            deleteAdmin(admin) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Annuler',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete(this.route('admin.admins.destroy', admin), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimé !',
                                    'L\'utlisateur a été supprimé avec succès.',
                                    'success'
                                )
                            }
                        })
                    }
                })
            }
        }
    }
</script>

<style>

</style>
