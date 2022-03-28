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
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des utilisateurs </strong></h3>

                    <div>
                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                            <div class="info-box">
                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                            <div class="info-box-content">
                                <h5>
                                    {{ users_count }} 
                                    {{ userText }}
                                </h5>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                          <!-- <a :href="route('admin.users.create')" class="btn btn-info text-white btn-style mt-3" style="float:right" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                              Ajouter
                          </a> -->
                        <form @submit.prevent="addUser">
                          <button as="button" type="submit" class="btn btn-info text-white btn-style mt-3" role="button" style="float:right">
                              <i class="fas fa-plus"></i>
                              Ajouter
                        </button>
                        </form>
                    </div>
                  </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                    <thead>
                      <tr>
                        <th class="text-capitalize">Nom</th>
                        <th class="text-capitalize">Email</th>
                        <th class="text">Ajouté le</th>
                        <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(user, index) in users" :key="index">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.created_at }}</td>
                        <td class="text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                          <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editUser(user)">
                            <i class="fa fa-pencil"></i>
                          </button>
                          &nbsp; &nbsp;
                          <button class="btn btn-xs btn-danger" @click="deleteUser(user)">
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
    
    </admin-layout>
  </div>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: ['roles', 'users', 'services', 'users_count'],
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
                    email: '',
                    services: [],
                    roles: []
                }),
                serviceOptions: this.services,
                roleOptions: this.roles,
            }
        },
        computed: {
          userText() {
              return this.grades_count <= 1 ? 'Utilisateur' : 'Utilisateurs';
          },
        },
        methods: {
            editUser(user){
                this.$inertia.get(route('admin.users.edit', [user]));
            },
            addUser() {
                this.$inertia.get(route('admin.users.create'));
            },
            addTag(newRole) {
                let tag = {
                    name: newRole,
                }
                this.roleOptions.push(tag)
                this.form.roles.push(tag)
            },
            addServ(newService) {
                let serv = {
                    name: newService,
                }
                this.serviceOptions.push(serv)
                this.form.services.push(serv)
            },
            createUser() {
                this.form.post(this.route('admin.users.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.form.reset()
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouveau compte utilisateur créé !'
                        })
                    }
                })
            },
            deleteUser(user) {
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
                        this.form.delete(this.route('admin.users.destroy', user), {
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
