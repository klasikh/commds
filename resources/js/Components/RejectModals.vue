<template>

          <!-- SH REJECT MODAL -->
        <div class="modal fade" id="modal-rejsH">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>Motif du rejet par le Supérieur Hiérarchique</strong></h3>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body overflow-hidden" v-for="(sH_reject, index) in sH_reject_motion" :key="index">
                        <div class="card">
                            {{ sH_reject.description }}
                        </div>
                        <p v-if="sH_reject.cReject == 1"><strong>Rejet catégorique</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RA REJECT MODAL -->
        <div class="modal fade" id="modal-rejrA">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>Motif du rejet par le référant approvisionnement</strong></h3>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body overflow-hidden" v-for="(rA_reject, index) in rA_reject_motion" :key="index">
                        <div class="card">
                            {{ rA_reject.description }}
                        </div>
                        <p v-if="rA_reject.cReject == 1"><strong>Rejet catégorique</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- DPAL REJECT MODAL -->
        <div class="modal fade" id="modal-rejDpal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>Motif du rejet par le DPAL</strong></h3>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body overflow-hidden" v-for="(dPal_reject, index) in dPal_reject_motion" :key="index">
                        <div class="card">
                            {{ dPal_reject.description }}
                        </div>
                        <p v-if="dPal_reject.cReject == 1"><strong>Rejet catégorique</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CDL REJECT MODAL -->
        <div class="modal fade" id="modal-rejCdl">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>Motif du rejet par le CDL</strong></h3>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body overflow-hidden" v-for="(cDL_reject, index) in cDL_reject_motion" :key="index">
                        <div class="card">
                            {{ cDL_reject.description }}
                        </div>
                        <p v-if="cDL_reject.cReject == 1"><strong>Rejet catégorique</strong></p>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {

}
</script>

<style>

</style>