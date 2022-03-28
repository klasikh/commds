<template>
    <div>
        <admin-layout>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                          <div class="card px-2 py-2">
                            <div class="row bg-color-blue mx-3 mb-4 py-1">
                                <div class="card-header">
                                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Liste des services</strong></h3>

                                    <div>
                                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:''; float:left">
                                            <div class="info-box">
                                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                                            <div class="info-box-content">
                                                <h5>
                                                    {{ services_count }}
                                                    {{ serviceText }}
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
                                <div class="card-body table-responsive p-0">
                                    <table  id="myTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-capitalize">Nom</th>
                                                <th class="text-capitalize">Description</th>
                                                <th class="text">Département</th>
                                                <th class="text">Créé le</th>
                                                <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="service in services" :key="service.id">
                                                <td>{{ service.name }}</td>
                                                <td>{{ service.description.substring(0, 25) + '...' }}</td>
                                                <td>{{ service.department }}</td>
                                                <td>{{ service.created_at }}</td>
                                                <td class="text-center" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                                    <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editModal(service)">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    &nbsp; &nbsp;
                                                    <button class="btn btn-xs btn-danger" @click="deleteService(service)">
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
                                            <label for="name" class="h5">Nom du service</label>
                                            <input type="text" class="form-control" id="service" placeholder="Nom du service" v-model="form.name" :class="{ 'is-invalid' : form.errors.name }" autofocus="autofocus" autocomplete="on" minlength="3" maxlength="35">
                                        </div>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.name}">
                                            {{ form.errors.name }}
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="h5">Description du service</label>
                                            <textarea rows="4"  class="form-control" id="custom_text" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off" placeholder="Description du service" minlength="10" maxlength="255"></textarea>
                                        </div>
                                        <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                            {{ form.errors.description }}
                                        </div>

                                         <div class="form-group">
                                            <label for="department" class="h5">Département lié au service</label>
                                            <multiselect
                                                v-model="form.department"
                                                :options="departmentOptions"
                                                :multiple="false"
                                                :taggable="false"
                                                placeholder="Sélectionner"
                                                @addDepartment="addDepartment"
                                                label="name"
                                                track-by="id"
                                            ></multiselect>
                                        </div>
                                        <div class="invalid-feedback" :class="{ 'd-block' : form.errors.department}">
                                            {{ form.errors.department }}
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                        <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.name || !form.description || !form.department || form.processing">{{ buttonTxt }}</button>
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
        props: ['services', 'services_count', 'departments', 'the_dep'],
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
                    department: '',
                }),
                departmentOptions: this.departments,
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Ajouter nouveau service' : 'Modifier le service';
            },
            serviceText() {
                return this.services_count <= 1 ? 'Service' : 'Services';
            },
            buttonTxt() {
                return this.editedIndex === -1 ? 'Ajouter' : 'Modifier';
            },
            checkMode() {
                return this.editMode === false ? this.createService: this.editService;
            }
        },
        methods: {
            addDepartment(newDepartment) {
                let department = {
                    name: newDepartment,
                }
                this.departmentOptions.push(department)
                this.form.department.push(department)
            },
            editModal(service) {
                this.editMode = true
                $('#modal-lg').modal('show')
                this.editedIndex = this.services.indexOf(service)
                this.form.name = service.name
                this.form.id = service.id
                this.form.description = service.description
                this.form.department = service.department
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
            createService() {
                this.form.post(this.route('admin.services.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'Nouveau service créé avec succès !'
                        })
                    }
                })
            },
            editService() {
                this.form.patch(this.route('admin.services.update', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess:() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Le service a été modifié avec succès !'
                        })
                        this.closeModal()
                    }
                })
            },
            deleteService(service) {
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
                        this.form.delete(this.route('admin.services.destroy', service), {
                            preserveScroll: true,
                            onSuccess: ()=> {
                                Swal.fire(
                                    'Supprimée!',
                                    'Le service a bien été supprimé',
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
