require('./bootstrap');

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$(document).ready( function () {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["excel", "pdf", "print", "colvis"]
    } ).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
} );

$(document).on('click', '.removee', function(){
    $(this).closest('tr').remove();
    i--;
    console.log(i);
    if (i ==0) {
        $('#other_piece').html('');
    }
})

// Import modules...
import { createApp, h, Vue } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import CKEditor from '@ckeditor/ckeditor5-build-classic';
// Import componenets...
import Multiselect from '@suadelabs/vue3-multiselect'
import { message } from 'laravel-mix/src/Log';

import VueSignaturePad from 'vue-signature-pad';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'DigiCom';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin}) {
        return createApp({ render: () => h(app, props, plugin)})
            .use(plugin)
            .mixin({ methods: { route } })
            .component('multiselect', Multiselect)
            // .use( CKEditor )
            .use(VueSignaturePad)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
