<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                          <div class="card px-2 py-2">
                            <div class="row bg-color-blue mx-3 mb-4 py-1">
                                <div class="card-header">
                                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des catégories de matériel</strong></h3>

                                    <div>
                                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                                            <div class="info-box">
                                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                                            <div class="info-box-content">
                                                <h5>
                                                    {{ categories_count }}
                                                    {{ categoryText }}
                                                </h5>
                                            </div>
                                            <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>

                                        <button type="button" class="btn btn-info text-white btn-style mt-3" style="float:right" @click="openModal" v-if="$page.props.auth.hasRole.user">
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-capitalize">Nom</th>
                                                <th class="text-capitalize">Description</th>
                                                <th class="text">Créée le</th>
                                                <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.user">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(category, index) in categories" :key="index">
                                                <td>{{ category.name }}</td>
                                                <td>{{ category.description }}</td>
                                                <td>{{ category.created_at }}</td>
                                                <td class="text-center" v-if="$page.props.auth.hasRole.user">
                                                    <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editModal(category)">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    &nbsp; &nbsp;
                                                    <button class="btn btn-xs btn-danger" @click="deleteCategory(category)" v-if="$page.props.auth.hasRole.user">
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
                            <div class="card card-primary">
                                <form @submit.prevent="checkMode">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name" class="h5">Nom de la catégorie de matériel</label>
                                            <input type="text" class="form-control" id="category" placeholder="Nom de la catégorie de matériel" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="off" minlength="3" maxlength="35">
                                        </div>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name}">
                                            {{ form.errors.name }}
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="h5">Description de la catégorie de matériel</label>
                                            <textarea rows="4"  class="form-control" id="description" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off" placeholder="Description de la catégorie de matériel" minlength="10" maxlength="255"></textarea>
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
        props: ['categories', 'categories_count'],
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
                return this.editedIndex === -1 ? 'Ajouter nouvelle catégorie de matériel' : 'Modifier la catégorie de matériel';
            },
            categoryText() {
                return this.categories_count <= 1 ? 'Catégorie' : 'Catégories';
            },
            buttonTxt() {
                return this.editedIndex === -1 ? 'Ajouter' : 'Modifier';
            },
            checkMode() {
                return this.editMode === false ? this.createCategory: this.editCategory;
            }
        },
        methods: {
            editModal(category) {
                this.editMode = true
                $('#modal-lg').modal('show')
                this.editedIndex = this.categories.indexOf(category)
                this.form.name = category.name
                this.form.id = category.id
                this.form.description = category.description
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
            createCategory() {
                this.form.post(this.route('user.matscat.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouvelle catégorie de matériel ajoutée !'
                        })
                    }
                })
            },
            editCategory() {
                this.form.patch(this.route('user.matscat.update', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Catégorie de matériel modifiée !'
                        })
                        this.closeModal()
                    }
                })
            },
            deleteCategory(material) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible ! La suppression d'une catégorie supprime également tous les matériaux intégrés dans cette catégorie, de même que la gestion de chacun de ces matériels.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post(this.route('user.matscat.deleteMatCat', material), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimée!',
                                    'La catégorie de matériel a bien été supprimée',
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
