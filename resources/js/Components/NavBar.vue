<template>

  <nav class="main-header navbar navbar-expand navbar__blue">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <div class="text-center col-lg-8 col-md-6">
        <h3 class="text-white text-uppercase">Gestion des commandes</h3>
        </div>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
             <li class="nav-item dropdown" v-if="$page.props.auth.info.password == native_passoword ">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                changer votre PW
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user"></i>
                         {{ $page.props.auth.info.name + ' ' + $page.props.auth.info.surname }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form @submit.prevent="logout">
                        <button as="button" type="submit" class="dropdown-item" role="button">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            Changer mon mot de passe
                        </button>
                    </form>
                    <div class="dropdown-divider"></div>

                </div>
            </li>

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 nouveaux messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Voir toutes les notifications</a>
                </div>
            </li>

             <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user"></i>
                         {{ $page.props.auth.info.name + ' ' + $page.props.auth.info.surname }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form @submit.prevent="logout">
                        <button as="button" type="submit" class="dropdown-item" role="button">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            Déconnexion
                        </button>
                    </form>
                    <div class="dropdown-divider"></div>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
                </a>
            </li> -->
        </ul>
    </nav>

</template>

<script>
export default {

    props: ['user', 'native_password'],

    components: {},

    methods: {
        messages() {
            this.$inertia.get(route('messages'));
        },
        logout() {
            this.$inertia.post(route('logout'));
        },
    }

}
</script>

<style>

</style>
