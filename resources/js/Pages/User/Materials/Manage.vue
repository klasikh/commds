<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                          <div class="card px-2 py-2">
                            <div class="row bg-color-blue mx-3 mb-4 py-1">
                                <div class="card-header">
                                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Gestion des matériels</strong></h3>

                                    <div>
                                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                                            <div class="info-box">
                                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                                            <div class="info-box-content">
                                                <h5>
                                                    {{ materials_count }}
                                                    {{ materialText }}
                                                </h5>
                                            </div>
                                            <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>

                                        <button type="button" @click="openModal" class="btn btn-info text-white btn-style mt-3" style="float:right" v-if="$page.props.auth.hasRole.user">
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-capitalize">Nom</th>
                                                <th class="text-capitalize">Quantité disponible</th>
                                                <th class="text">Ajouté le</th>
                                                <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.user && $page.props.auth.info.grade_id != 4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(material, index) in materials" :key="index">
                                                <td>{{ material.name }}</td>
                                                <td>{{ material.quantity }}</td>
                                                <td>{{ material.created_at }}</td>
                                                <td class="text-center" v-if="$page.props.auth.hasRole.user && $page.props.auth.info.grade_id != 4">
                                                    <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editModal(material)">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    &nbsp; &nbsp;
                                                    <button class="btn btn-xs btn-danger" @click="deleteMaterial(material)">
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
                                    <div v-if="editMode == false">
                                        <div class="form-group">
                                            <label for="material" class="h5">Matériel</label>
                                             <select class="form-control" id="material" v-model="form.material" :class="{ 'is-invalid' : form.errors.material }">
                                                    <option value="">-- Sélectionner --</option>
                                                    <option v-for="(material, index ) in materials_lists" :key="index" :value="material.name">{{ material.name }}</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.material}">
                                            {{ form.errors.material }}
                                        </div>

                          
                                            <div class="form-group">
                                                <label for="quantity" class="h5">Quantité</label>
                                                <input type="number" class="form-control" id="quantity" placeholder="Quantité" v-model="form.quantity" :class="{ 'is-invalid' : form.errors.quantity }" autofocus="autofocus" autocomplete="off" minlength="1" maxlength="35">
                                            </div>
                                            <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.quantity}">
                                            {{ form.errors.quantity }}
                                            </div>
                                        </div>

                                        <div v-if="editMode == true">
                                            <div class="form-group">
                                                <label for="quantity" class="h5">Matériel</label>
                                                <input type="text" class="form-control" id="quantity" placeholder="Matériel" v-model="form.material" :class="{ 'is-invalid' : form.errors.material }" disabled>
                                            </div>
                                            <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.material}">
                                            {{ form.errors.material }}
                                            </div>

                                            <div class="form-group">
                                                <label for="quantity" class="h5">Quantité à ajouter ou diminuer</label>
                                                <input type="number" class="form-control" id="quantity" placeholder="Quantité à ajouter" v-model="form.addQuantity" :class="{ 'is-invalid' : form.errors.addQuantity }" autofocus="autofocus" autocomplete="off" minlength="1" maxlength="35">
                                            </div>
                                            <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.addQuantity}">
                                            {{ form.errors.addQuantity }}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                        <button type="submit" class="btn btn-info btn-style text-white" v-if="editMode === false"  style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.material || !form.quantity || form.processing">Ajouter</button>
                                        <button type="submit" class="btn btn-info btn-style text-white" v-if="editMode === true"  style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.material || !form.addQuantity || form.processing">Mettre à jour</button>
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
        props: ['materials', 'materials_count', 'materials_lists'],
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
                    description: '',
                    category: '',
                    material: '',
                    quantity: '',
                    addQuantity: '',
                }),
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Ajout matériel(s)' : 'Modification matériel(s)';
            },
            materialText() {
                return this.materials_count <= 1 ? 'Matériel' : 'Matériels';
            },
            buttonTxt() {
                return this.editedIndex === -1 ? 'Ajouter' : 'Modifier';
            },
            checkMode() {
                return this.editMode === false ? this.createMaterial: this.editMaterial;
            }
        },
        methods: {
            editModal(material) {
                this.editMode = true
                $('#modal-lg').modal('show')
                this.editedIndex = this.materials.indexOf(material)
                this.form.material = material.name
                this.form.id = material.id
                this.form.addQuantity = material.addQuantity
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
            createMaterial() {
                this.form.post(this.route('user.materials.addMat'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouveau matériel ajouté !'
                        })
                    }
                })
            },
            editMaterial() {
                this.form.patch(this.route('user.materials.updateMat', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Le matériel a été modifié avec succès !'
                        })
                        this.closeModal()
                    }
                })
            },
            deleteMaterial(material) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post(this.route('user.materials.dropMat', material), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimée!',
                                    'Le matériel a bien été supprimé',
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
