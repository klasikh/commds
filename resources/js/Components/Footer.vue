<template>
  
    <footer class="main-footer">
        <strong>Copyright &copy; {{ currentDate.getFullYear() }} <inertia-link href="#" style="color:#4851ec">DigiCom</inertia-link>.</strong>
        Tous droits réservés
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
        </div>
    </footer>

</template>

<script>
export default {

    data() {
        return {
            currentDate: new Date,
        }
    }

}
</script>

<style>

</style>