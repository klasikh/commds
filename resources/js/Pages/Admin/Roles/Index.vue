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
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des rôles</strong></h3>

                     <div>
                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                            <div class="info-box">
                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                            <div class="info-box-content">
                                <h5>
                                    {{ roles_count }}
                                    {{ roleText }}
                                </h5>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <button type="button" class="btn btn-info text-white btn-style mt-3" style="float:right" @click="openModal" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                        Ajouter
                        </button>
                    </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                    <thead>
                      <tr>
                        <th class="text">Nom du rôle</th>
                        <!-- <th class="text-capitalize">Permissions</th> -->
                        <th class="text">Créé le</th>
                        <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(role, index) in roles" :key="index">
                        <td>{{ role.name }}</td>
                        <!-- <td>
                            <div class="d-flex flex-column">
                                <span v-for="(permission, index) in role.permissions" :key="index">
                                    {{ permission.name }}
                                </span>
                            </div>
                        </td> -->
                        <td>{{ role.created_at }}</td>
                        <td class="text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                          <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editModal(role)">
                            <i class="fa fa-pencil"></i>
                          </button>
                          &nbsp; &nbsp;
                          <button class="btn btn-xs btn-danger" @click="deleteRole(role)">
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
                      <!-- <div class="h4">
                          <span>Aperçu: <span class="text-capitalize">{{ form.name }}</span>
                          </span>
                      </div> -->
                      <div class="card card-primary">
                          <form @submit.prevent="checkMode">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="role" class="h5">Nom du rôle</label>
                                      <input type="text" class="form-control" id="role" placeholder="Nom du rôle" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off" minlength="3" maxlength="25">
                                  </div>
                                  <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name }">
                                      {{ form.errors.name }}
                                  </div>

                                  <!-- <div class="form-group">
                                      <label for="permissions" class="h5">Permissions</label>
                                      <multiselect
                                          v-model="form.permissions"
                                          :options="permissionOptions"
                                          :multiple="true"
                                          :taggable="false"
                                          placeholder="Choisir permission(s)"
                                          @addPermissions="addPermissions"
                                          label="name"
                                          track-by="id"
                                      ></multiselect>
                                  </div>
                                  <div class="invalid-feedback" :class="{ 'd-block' : form.errors.permissions}">
                                      {{ form.errors.permissions }}
                                  </div> -->
                              </div>

                              <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                  <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.name || form.processing">{{ buttonTxt }}</button>
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
        props: ['roles', 'roles_count', 'permissions'],
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
                    // permissions: []
                }),
                permissionOptions: this.permissions,
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Ajouter nouveau rôle' : 'Modifier ce rôle';
            },
            roleText() {
                return this.roles_count <= 1 ? 'Rôle' : 'Rôles';
            },
            buttonTxt() {
                return this.editedIndex === -1 ? 'Ajouter' : 'Modifier';
            },
            checkMode() {
                return this.editMode === false ? this.createRole() : this.editRole();
            }
        },
        methods: {
            addPermissions(newPermission) {
                let permission = {
                    name: newPermission,
                }
                this.permissionOptions.push(permission)
                this.form.permissions.push(permission)
            },
            editModal(role) {
                this.editMode = true
                $('#modal-lg').modal('show')
                this.editedIndex = this.roles.indexOf(role)
                this.form.name = role.name
                this.form.id = role.id
                this.form.permissions = role.permissions
            },
            openModal() {
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
            createRole() {
                this.form.post(this.route('admin.roles.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouveau rôle créé avec succès !'
                        })
                    }
                })
            },
            editRole() {
                this.form.patch(this.route('admin.roles.update', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Le rôle a été modifié avec succès !'
                        })
                        this.closeModal()
                    }
                })
            },
            deleteRole(role) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete(this.route('admin.roles.destroy', role), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimé !',
                                    'Le rôle a été supprimé avec succès.',
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
