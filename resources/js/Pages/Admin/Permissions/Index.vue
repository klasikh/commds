<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                          <div class="card px-2 py-2">
                            <div class="row bg-color-blue mx-3 mb-4 py-1">
                                <div class="card-header">
                                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des permissions</strong></h3>

                                    <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center; justify-items:center;content:''">
                                        <div class="info-box">
                                        <span class="info-box-icon"><i class="fas fa-users"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Permissions</span>
                                            <span class="info-box-number">
                                            {{ permissions_count }}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>

                                    <div class="card-tools">
                                    <button type="button" class="btn btn-info text-white btn-style" @click="openModal" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Ajouter</button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-capitalize">Nom</th>
                                                <th class="text-capitalize">Description</th>
                                                <th class="text">Créer le</th>
                                                <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(permission, index) in permissions" :key="index">
                                                <td>{{ permission.name }}</td>
                                                <td>{{ permission.description }}</td>
                                                <td>{{ permission.created_at }}</td>
                                                <td class="text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                                    <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editModal(permission)">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    &nbsp; &nbsp;
                                                    <button class="btn btn-xs btn-danger" @click="deletePermission(permission)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                            <p class="h6 text-warning">** Toutes les permissions doivent commencer par "create: ", "read: ", "update: ", or "delete: "</p>

                            <!-- <div class="d-flex flex-column h4">
                                <span>Aperçu du nom: <span>{{ form.name }}</span>
                                </span>
                                <span class="mt-3">Aperçu de la description: <span>{{ form.description }}</span>
                                </span>
                            </div> -->
                            <div class="card card-primary">
                                <form @submit.prevent="checkMode">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name" class="h4">Nom de la permission</label>
                                            <input type="text" class="form-control" id="permission" placeholder="Nom de la permission" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="on">
                                        </div>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name}">
                                            {{ form.errors.name }}
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="h4">Description de la permission</label>
                                            <input type="text" class="form-control" id="description" placeholder="Description de la permission" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off">
                                        </div>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                            {{ form.errors.description }}
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                        <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.name || !form.description || form.processing">{{ buttonTxt }}</button>
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
        props: ['permissions', 'permissions_count'],
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
                    description: ''
                }),
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Ajouter nouvelle permission' : 'Modifier la permission';
            },
            buttonTxt() {
                return this.editedIndex === -1 ? 'Ajouter' : 'Modifier';
            },
            checkMode() {
                return this.editMode === false ? this.createPermission : this.editPermission;
            }
        },
        methods: {
            editModal(permission) {
                this.editMode = true
                $('#modal-lg').modal('show')
                this.editedIndex = this.permissions.indexOf(permission)
                this.form.name = permission.name
                this.form.id = permission.id
                this.form.description = permission.description
            },
            openModal() {
                this.editedIndex = -1
                $('#modal-lg').modal('show')
            },
            closeModal() {
                this.form.clearErrors()
                this.editMode = false
                this.form.reset()
                $('#modal-lg').modal('hide')
            },
            createPermission() {
                this.form.post(this.route('admin.permissions.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouvelle permission créée !'
                        })
                    }
                })
            },
            editPermission() {
                this.form.patch(this.route('admin.permissions.update', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'La permission a été modifiée avec succès !'
                        })
                        this.closeModal()
                    }
                })
            },
            deletePermission(permission) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete(this.route('admin.permissions.destroy', permission), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimée!',
                                    'La permission a bien été supprimée',
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
