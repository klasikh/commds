<template>

       <aside class="main-sidebar sidebar-blue elevation-4">
        <!-- Brand Logo -->
        <inertia-link class="brand-link">
        <img src="/images/digicom_logo.png" alt="Logo DigiCom" style="background-color: #fff; width:100%; border-radius:5px; color:#3490dc">
        <!-- <span class="brand-text font-weight-light">DigiCom</span> -->
        </inertia-link>

        <div style="height:50px"></div>
        <!-- Sidebar -->
        <div class="sidebar text-white">

            <!-- ADMIN NAV-LINKS -->

            <!-- Admin Sidebar Menu -->
            <nav class="mt-2" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->


                <li class="nav-item menu-open">
                    <form @submit.prevent="adminDashboard">
                        <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.dashboard.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                            <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                            Tableau de bord
                        </button>
                    </form>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            GESTION PANEL
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item" v-if="$page.props.auth.hasRole.superAdmin">
                            <form @submit.prevent="admins">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.admins.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin" style="color:#fff; text-align:justify">
                                    <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                                    Administrateurs
                                </button>
                            </form>
                        </li>

                        <!--
                        <li class="nav-item">
                            <a :href="route('admin.admins.index')" class="nav-link" :class="route().current('admin.admins.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" >
                                <i class="fa fa-user nav-icon"></i>
                                <p>Administrateurs</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <form @submit.prevent="users">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.users.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fa fa-users nav-icon"></i>
                                    Utilisateurs
                                </button>
                            </form>
                        </li>

                        <!-- <li class="nav-item">
                            <a :href="route('admin.users.index')" class="nav-link" :class="route().current('admin.users.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a :href="route('admin.departments.index')" class="nav-link" :class="route().current('admin.departments.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                <i class="fa fa-table nav-icon"></i>
                                <p>Départements</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <form @submit.prevent="departments">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.departments.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fas fa-cube nav-icon"></i>
                                    Départements
                                </button>
                            </form>
                        </li>
                        <!-- <li class="nav-item">
                            <a :href="route('admin.services.index')" class="nav-link" :class="route().current('admin.services.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin">
                                <i class="fa fa-cogs nav-icon"></i>
                                <p>Services</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <form @submit.prevent="services">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.services.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fas fa-cogs nav-icon"></i>
                                    Services
                                </button>
                            </form>
                        </li>
                        <!-- <li class="nav-item">
                            <a :href="route('admin.grades.index')" class="nav-link" :class="route().current('admin.grades.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator">
                                <i class="fa-solid fa-school nav-icon"></i>
                                <p>Grades</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <form @submit.prevent="grades">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.grades.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                   <i class="fa-solid fa-school nav-icon"></i>
                                    Fonctions
                                </button>
                            </form>
                        </li>
                         <!-- <li class="nav-item">
                            <a :href="route('admin.roles.index')" class="nav-link" :class="route().current('admin.roles.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin || $page.props.auth.hasRole.moderator">
                                <i class="fa-solid fa-critical-role nav-icon"></i>
                                <p>Rôles</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <form @submit.prevent="roles">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.roles.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fa-solid fa-critical-role nav-icon"></i>
                                    Rôles
                                </button>
                            </form>
                        </li>

                        <!-- <li class="nav-item">
                            <form @submit.prevent="permissions">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.permissions.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fas fa-user-secret nav-icon"></i>
                                    Permissions
                                </button>
                            </form>
                        </li> -->
                    </ul>
                </li>
                <!-- <li class="nav-header">DIVERS</li> -->
                <!-- <li class="nav-item">
                    <a :href="route('dashboard')" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Site</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            DIVERS
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <form @submit.prevent="request_types">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.request_types.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                                   Types de demande
                                </button>
                            </form>
                        </li>

                        
                        <!-- <li class="nav-item">
                            <form @submit.prevent="memos">
                                <button as="button" type="submit" class="nav-link" role="button" :class="route().current('admin.memos.*') ? 'actived' : ''" v-if="$page.props.auth.hasRole.superAdmin || $page.props.auth.hasRole.admin" style="color:#fff; text-align:justify">
                                    <i class="fa-solid fa-critical-role nav-icon"></i>
                                    Mémos
                                </button>
                            </form>
                        </li> -->
                    </ul>
                </li>
                <!-- END ADMIN NAV-LINKS -->

                <!-- USER NAV-LINKS -->

                </ul>

            </nav>
            <!-- /.sidebar-menu -->

            <!-- END ADMIN NAV-LINKS -->

            <!-- User Sidebar Menu -->
            <nav class="mt-2" v-if="$page.props.auth.hasRole.user">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <div v-if="$page.props.auth.info.grade_id !== 5 && $page.props.auth.info.grade_id !== 4 && $page.props.auth.info.grade_id !== 3 && $page.props.auth.info.grade_id !== 2 && $page.props.auth.info.grade_id !== 1 && $page.props.auth.info.grade_id !== 7 && $page.props.auth.info.grade_id !== 8 && $page.props.auth.info.grade_id !== 9 && $page.props.auth.info.grade_id !== 10">

                    <li class="nav-item">
                        <form @submit.prevent="dashboard">
                            <button as="button" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Tableau de bord
                            </button>
                        </form>
                    </li>

                    <li class="nav-item">
                        <!-- <form @submit.prevent="addRequest"> -->
                            <a as="button" :href="route('user.requests.create')" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                <i class="fas fa-plus nav-icon" aria-hidden="true"></i>
                                Créer une demande
                            </a>
                        <!-- </form> -->
                    </li>
                    {{ user }}

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Mes demandes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a> 
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <!-- <form @submit.prevent="notsent"> -->
                                    <a as="button" :href="route('user.requests.notsent')" type="submit" class="nav-link" role="button"  v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                        Demandes non soumises
                                    </a>
                                <!-- </form> -->
                            </li>

                            <li class="nav-item">
                                <!-- <form @submit.prevent="sent"> -->
                                    <a as="button" :href="route('user.requests.sent')" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                        Demandes soumises
                                    </a>
                                <!-- </form> -->
                            </li>

                            <li class="nav-item">
                                <!-- <form @submit.prevent="finalized"> -->
                                    <a as="button" :href="route('user.requests.finalized')" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                        Demandes finalisées
                                    </a>
                                <!-- </form> -->
                            </li>

                            <li class="nav-item">
                                <!-- <form @submit.prevent="onProcessRequests"> -->
                                    <a as="button" :href="route('user.requests.onProcess')" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                        Traitement en cours
                                    </a>
                                <!-- </form> -->
                            </li>
                        </ul>
                    </li>
                </div>

                <div v-if="$page.props.auth.info.grade_id === 5 || $page.props.auth.info.grade_id === 4 || $page.props.auth.info.grade_id === 3 || $page.props.auth.info.grade_id === 2 || $page.props.auth.info.grade_id === 7 || $page.props.auth.info.grade_id === 8 || $page.props.auth.info.grade_id === 9 || $page.props.auth.info.grade_id === 10">
                    <li class="nav-item" v-if="$page.props.auth.info.grade_id === 5 || $page.props.auth.info.grade_id === 4 || $page.props.auth.info.grade_id === 3 || $page.props.auth.info.grade_id === 2">
                        <form @submit.prevent="dashboard">
                            <button as="button" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Tableau de bord
                            </button>
                        </form>
                    </li>

                    <li class="nav-item">
                        <form @submit.prevent="receivedRequests">
                            <button as="button" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                Demandes reçues
                            </button>
                        </form>
                    </li>

                    <li class="nav-item">
                        <form @submit.prevent="traitedRequests">
                            <button as="button" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                Demandes traitées
                            </button>
                        </form>
                    </li>

                    <li class="nav-item" v-if="$page.props.auth.info.grade_id === 5 || $page.props.auth.info.grade_id === 4 || $page.props.auth.info.grade_id === 3 || $page.props.auth.info.grade_id === 2" >
                        <form @submit.prevent="onProcessRequests">
                            <button as="button" type="submit" class="nav-link" role="button" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                <i class="fas fa-file nav-icon" aria-hidden="true"></i>
                                Traitement en cours
                            </button>
                        </form>
                    </li>

                    <li class="nav-item" v-if="$page.props.auth.info.grade_id === 4 || $page.props.auth.info.grade_id === 7 || $page.props.auth.info.grade_id === 8 ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                GESTION MATERIELS
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <form @submit.prevent="materials_cat">
                                    <button as="button" type="submit" class="nav-link" role="button" :class="route().current('user.materials.categories') ? 'actived' : ''" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <!-- <i class="fa fa-category nav-icon" aria-hidden="true"></i> -->
                                        Catégories de matériels
                                    </button>
                                </form>
                            </li>

                            <li class="nav-item">
                                <form @submit.prevent="materials">
                                    <button as="button" type="submit" class="nav-link" role="button" :class="route().current('user.materials.index') ? 'actived' : ''" v-if="$page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <!-- <i class="fa fa-user nav-icon" aria-hidden="true"></i> -->
                                        Liste des matériels
                                    </button>
                                </form>
                            </li>

                            <li class="nav-item">
                                <form @submit.prevent="materials_manage">
                                    <button as="button" type="submit" class="nav-link" role="button" :class="route().current('user.materials.manage') ? 'actived' : ''" v-if=" $page.props.auth.hasRole.user" style="color:#fff; text-align:justify">
                                        <!-- <i class="fa-solid fa-critical-role nav-icon"></i> -->
                                        Gestion matériels
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </div>

                </ul>

            </nav>

            <!-- sH User Sidebar Menu -->
             <nav class="mt-2" >
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                </ul>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</template>

<script>
export default {

    components: {},

    methods: {
        adminDashboard() {
            this.$inertia.get(route('admin.dashboard.index'));
        },
        admins() {
            this.$inertia.get(route('admin.admins.index'));
        },
        users() {
            this.$inertia.get(route('admin.users.index'));
        },
        departments() {
            this.$inertia.get(route('admin.departments.index'));
        },
        services() {
            this.$inertia.get(route('admin.services.index'));
        },
        grades() {
            this.$inertia.get(route('admin.grades.index'));
        },
        roles() {
            this.$inertia.get(route('admin.roles.index'));
        },
        permissions() {
            this.$inertia.get(route('admin.permissions.index'));
        },
        request_types() {
            this.$inertia.get(route('admin.request_types.index'));
        },
        memos() {
            this.$inertia.get(route('admin.memos.index'));
        },


        // SIMPLE USER BUTTONS
        dashboard() {
            this.$inertia.get(route('user.dashboard.index'));
        },
        addRequest() {
            this.$inertia.get(route('user.requests.create'));
        },
        notsent() {
            this.$inertia.get(route('user.requests.notsent'));
        },
        sent() {
            this.$inertia.get(route('user.requests.sent'));
        },
        finalized() {
            this.$inertia.get(route('user.requests.finalized'));
        },

        // ACTORS USER BUTTONS
        receivedRequests() {
            this.$inertia.get(route('user.requests.received'));
        },
        traitedRequests() {
            this.$inertia.get(route('user.requests.traited'));
        },
        onProcessRequests() {
            this.$inertia.get(route('user.requests.onProcess'));
        },


        // MATERIALS BUTTONS
        materials_cat() {
            this.$inertia.get(route('user.materials.categories'));
        },
        materials() {
            this.$inertia.get(route('user.materials.index'));
        },
        materials_manage() {
            this.$inertia.get(route('user.materials.manage'));
        },

    }

}
</script>

<style>

</style>
