<template>

    <div>
      <admin-layout>
        <section class="content">
            @if($request.user_id === user.id || (request.user_service_id === user.service_id && user.grade_id === 5) || (request.user_service_id === user.service_id && user.grade_id === 4) || (request.user_service_id === user.service_id && user.grade_id === 3) || (request.user_service_id === user.service_id && user.grade_id === 2) || (request.user_service_id === user.service_id && user.grade_id === 7) || (request.user_service_id === user.service_id && user.grade_id === 8) || (request.user_service_id === user.service_id && user.grade_id === 9) || (request.user_service_id === user.service_id && user.grade_id === 10))
          <div class="container-fluid">
            <div class="row" id="">
              <div class="d-flex">
                  <div style="float:left" class="col-6">
                      <button @click="makePDF"  class="btn btn-secondary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none">Extrait PDF</button>
                  </div>
                  <div>
                      <div style="float:right; right:0px" class="col-6">
                          <form @submit.prevent="showDelivery(request)">
                              <button as="button" type="submit" class="btn btn-warning text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                                      Bordereau
                              </button>
                          </form>
                          <br>
                      </div>
                  </div>
              </div>
              <div class="col-12" style="font-size:17px;" id="therequest" ref="content">
                  <div class="card px-2 py-4">
                      <div style="padding:50px">
                          <div class="d-flex">
                              <div class="h5 col-4">
                                  SOCIETE BENINOISE <br>D'ENERGIE ELECTRIQUE <br><br>
                                  DIRECTION GENERALE <br><br>
                                  DIRECTION PATRIMOINE ACHATS ET LOGISTIQUE
                              </div>
                              <div class="col-4">
                                  <img src="/images/logo-sbee.png" alt="">
                              </div>
                              <div class="h5 col-4 mt-4 text-right">
                                  No: {{ request.request_number }}
                              </div>
  
                          </div>
  
                          <br>
                          <div class="d-flex">
                              <div class="col-3 bg-black"></div>
                              <div class="h5 col-6 text-center" v-if="request.request_type_id  === 1">
                                  DEMANDE DE TRAVAUX
                              </div>
                              <div class="h5 col-6 text-center" v-if="request.request_type_id  === 2 || request.request_type_id  === 3">
                                  DEMANDE D'ACHAT
                              </div>
                              <div class="col-3 bg-black"></div>
                          </div>
  
                          <div  v-if="request.request_type_id === 2 || request.request_type_id === 3">
                              
                              <br>
                              <div class="" style="position:absolute;">
                                  <div class="col-8" style="float:left">
                                      <div class="d-flex">
                                          <div class="h5">Réquérant Service : </div> &nbsp;&nbsp;
                                          <div>{{ the_service.name }}</div>
                                      </div>
  
                                      <br>
                                      <div class="d-flex">
                                          <div class="h5">Désignation : </div> &nbsp;&nbsp;
                                          <div class="">{{ request.title }}</div>
                                      </div>
  
                                      <br>
                                      <div class="d-flex">
                                          <div class="h5">Référence/NR : </div> &nbsp;&nbsp;
                                          <div class="">{{ request.reference }}</div>
                                      </div>
                                  </div>
                                  <div class="col-4 h5" style="float:right; display:block; position:relative" v-for="(req_category, index) in req_categories" :key="index">
                                      <div class=""> {{ req_category }} </div>
                                      
                                  </div>
  
                              </div>
                              <br>
                              <div class="" style="margin-top:155px">
                                  <h5>Description du défaut constaté ou produit(s) à acheter : </h5>
                                  {{ request.description }}
                              </div>
  
                              <br>
                              <div class="d-flex">
                                  <div class="col-4 h5">
                                      Etabli par : <p v-if="the_sH">{{ the_sH.name + ' ' + the_sH.surname }}</p> <br>
                                      <div class="h6">(Chef de Service)</div>
                                      <span v-if="request.sent_or == 1 && request.sH_approval === null && request.rA_approval === null && request.dPal_approval === null" class="badge badge-warning" style="border-radius:25px">En attente</span>
                                      <p>
                                          <span v-if="request.sH_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                              Rejetée
                                          </span>
                                          <button v-if="request.sH_approval == 0 && request.user_id === user.id" style="background-color:blue; padding:2px; border-radius:50%; top:-10px; position: relative; color:#fff" class="bg-circle small" href="#" @click="openRejsH">?</button>
                                      </p>
                                      <span v-if="request.sH_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                                      <br>
                                      Date : {{ request.sH_approvalDate }}
                                  </div>
                                  <div class="col-4 h5">
                                      Visa Chef Département <br>
                                      {{ request.department_sign }}<br>
                                      {{ request.department_signDate }}
                                  </div>
                                  <div class="col-4 h5">
                                      Approbation du réquérant (Directeur) <br>
                                      {{ request.chief_sign }} <br>
                                      {{ request.chief_signDate }}
                                      <span v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval === null" class="badge badge-warning" style="border-radius:25px">En attente</span>
                                      <p style="position:absolute">
                                          <span v-if="request.dPal_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                              Rejetée
                                          </span>
                                          <button v-if="request.dPal_approval == 0 && request.user_id === user.id" style="background-color:blue; padding:2px; border-radius:50%; top:-10px; position: relative; color:#fff" class="bg-circle small" href="#" @click="openRejDpal">?</button>
                                      </p>
                                      <span v-if="request.dPal_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                                      <br>
                                  </div>
                              </div>
                          </div>
  
                          <div  v-if="request.request_type_id === 1">
                               <br>
                              <div class="" style="position:absolute;">
                                  <div class="col-8" style="float:left">
                                      <div class="d-flex">
                                          <div class="h5">Réquérant Service : </div> &nbsp;&nbsp;
                                          <div>{{ the_service.name }}</div>
                                      </div>
  
                                      <br>
                                      <div class="d-flex">
                                          <div class="h5">Désignation : </div> &nbsp;&nbsp;
                                          <div class="">{{ request.title }}</div>
                                      </div>
  
                                      <br>
                                      <div class="d-flex">
                                          <div class="h5">Référence/NR : </div> &nbsp;&nbsp;
                                          <div class="">{{ request.reference }}</div>
                                      </div>
                                  </div>
                                  <div class="col-4 h5" style="float:right; right:0; display:block; position:relative" v-for="(trans_mention, index) in trans_mentions" :key="index">
                                      <div class=""> {{ trans_mention }} </div>
                                      
                                  </div>
  
                              </div>
                              <br>
                              <div class="d-flex" style="margin-top:155px">
                                  <div class="col-3 bg-black"></div>
                                  <div class="h5 col-6 text-center">
                                      TRAVAUX DEMANDES
                                  </div>
                                  <div class="col-3 bg-black"></div>
                              </div>
                              <br>
                              <div>
                                  {{ request.asked_works }}
                              </div>
  
                              <br>
                              <div class="d-flex">
                                  <div class="col-4 h5">
                                      Visa Chef Service <br>
                                      <span v-if="request.sent_or == 1 && request.sH_approval === null && request.rA_approval === null && request.dPal_approval === null" class="badge badge-warning" style="border-radius:25px">En attente</span>
                                      <p>
                                          <span v-if="request.sH_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                              Rejetée
                                          </span>
                                          <button v-if="request.user_id === user.id && request.sH_approval == 0" style="background-color:blue; padding:2px; border-radius:50%; top:-10px; position: relative; color:#fff" class="bg-circle small" href="#" @click="openRejsH">?</button>
                                      </p>
                                      <span v-if="request.sH_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                                      <br>
                                      Date : {{ request.sH_approvalDate }}
                                  </div>
                                  <div class="col-4 h5">
                                      Visa Chef Département <br>
                                      {{ request.department_sign }}<br>
                                      {{ request.department_signDate }}
                                  </div>
                                  <div class="col-4 h5">
                                      Approuvé par (DPAL) Directeur <br>
                                      <span v-if="request.sent_or == 1 && request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval === null" class="badge badge-warning" style="border-radius:25px">En attente</span>
                                      <p style="position:absolute">
                                          <span v-if="request.dPal_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                              Rejetée
                                          </span>
                                          <button v-if="request.dPal_approval == 0 && request.user_id === user.id" style="background-color:blue; padding:2px; border-radius:50%; top:-10px; position: relative; color:#fff" class="bg-circle small" href="#" @click="openRejDpal">?</button>
                                      </p>
                                      <span v-if="request.dPal_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                                      <br>
                                      {{ request.dPal_approvalDate }}
                                  </div>
                              </div>
                          </div>
  
                              <br>
                              <div class="d-flex">
                                  <div class="col-3 bg-black"></div>
                                  <div class="h5 col-6 text-center">
                                      INFORMATIONS DU TRANSFERT
                                  </div>
                                  <div class="col-3 bg-black">
                                  </div>
                              </div>
                          
                          <br>
                          <div class="d-flex">
                              <div class="col-6">
                                  <div class="h5">BON DE COMMANDE No : {{ request.command_number }}</div>
                                  <div class="h5">DATE D'EMISSION : {{ request.sent_at }}</div>
                                  <div class="h5">DATE DE RETRAIT PREVUE : {{ pw_date }}</div>
                              </div>
                              <div class="col-6 text-right">
                                  <div class="h5" style="height:40px"></div>
                                  <div class="h5" style="bottom:O">MONTANT ESTIME : {{ request.estimated_amount }} fr CFA</div>
                              </div>
                          </div>
                          <br>
  
                          <div class="d-flex">
                              <div class="col-4 h6">SBEE-DPAL-DP</div>
                              <div class="col-4 h6"></div>
                              <div class="col-4 h6 text-right">REF : PRC DPAL 105</div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
              <!-- <div id="elementH">jh</div> -->
              <br>
              <div class="d-flex">
                  <div style="float:left" class="col-4">
                      <button type="button" class="btn text-white" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" onclick="window.history.back()">Retour</button>
                  </div>
  
                  <div class="text-center col-4" v-if="request.user_id === user.id && request.sent_or == 0 && request.token === null">
                      <form @submit.prevent="edit(request)">
                          <button as="button" type="submit" class="btn btn-badge text-white" style="letter-spacing: 0.1em; background-color: var(--bs-green); border-radius:20px; border:none" role="button">
                              Editer
                          </button>
                      </form>
                  </div>
                  <div class="text-center col-4" v-if="request.user_id === user.id && request.sent_or == 0 && request.status == 0 && request.deliv_or === null">
                      <!-- <form @submit.prevent="makeDelivery(request)"> -->
                          <a as="button" :href="route('user.mat_transferts.create', request)" type="submit" class="btn btn-warning text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Générer le bordereau
                          </a>
                      <!-- </form> -->
                  </div>
                  <div class="text-right col-4" v-if="request.user_id === user.id && request.sent_or == 0 && request.status == 0 && request.deliv_or !== null">
                      <form @submit.prevent="signModal">
                          <button as="button" type="submit" class="btn btn-primary text-white btn-style text-right" role="button">
                              Envoyer
                              <i class="fas fa-paper-plane"></i>
                          </button>
                      </form>
                  </div>
                   <div class="text-right col-4" v-if="request.user_id === user.id && request.sent_or == 0 && request.status != 0">
                      <form @submit.prevent="sendAgain(request)">
                          <button as="button" type="submit" class="btn btn-primary text-white btn-style text-right" role="button">
                              Renvoyer à nouveau
                              <i class="fas fa-paper-plane"></i>
                          </button>
                      </form>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 5) && request.sH_approval === null && request.token !== null">
                      <form @submit.prevent="signModal">
                          <button as="button" type="submit" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                                  Approuver
                          </button>
                      </form>
                  </div>
                  <div class="text-right col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 5) && request.sH_approval === null && request.token !== null">
                      <button as="button" type="submit"  @click="openModal" class="btn btn-danger text-white text-right" role="button" style="letter-spacing: 0.1em; border-radius:20px; border:none">
                          Rejeter
                      </button>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 4) && request.rA_approval === null && request.sH_approval !== null && request.token !== null && request.rA_treatment !== null">
                      <form @submit.prevent="signModal">
                          <button as="button" type="submit" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                               Tranférer
                          </button>
                      </form>
                  </div>
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 4) && request.rA_approval === null && request.deliv_or === null && request.sH_approval !== null && request.token !== null && request.rA_treatment === null">
                      <form  @submit.prevent="showDelivery(request)" >
                          <button as="button" type="submit" class="btn btn-warning text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Traiter le bordereau
                          </button>
                      </form>
                  </div>
                  <div class="text-right col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 4) && request.rA_approval === null && request.sH_approval !== null && request.token !== null">
                      <button as="button" type="submit"  @click="openModal" class="btn btn-danger text-white text-right" role="button" style="letter-spacing: 0.1em; border-radius:20px; border:none">
                          Rejeter
                      </button>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 3) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval === null && request.token !== null">
                      <form @submit.prevent="signModal">
                          <button as="button" type="submit" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                                  Approuver
                          </button>
                      </form>
                  </div>
                  <div class="text-right col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 3) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval === null && request.token !== null">
                      <button as="button" type="submit"  @click="openModal" class="btn btn-danger text-white text-right" role="button" style="letter-spacing: 0.1em; border-radius:20px; border:none">
                          Rejeter
                      </button>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 2) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval === null && request.estimated_amount < 70000000 && request.token !== null">
                      <form @submit.prevent="signModal">
                          <button as="button" type="submit" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                                  Approuver
                          </button>
                      </form>
                  </div>
                  <div class="text-right col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 2) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval === null && request.estimated_amount < 70000000 && request.token !== null">
                      <button as="button" type="submit"  @click="openModal" class="btn btn-danger text-white text-right" role="button" style="letter-spacing: 0.1em; border-radius:20px; border:none">
                          Rejeter
                      </button>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 7) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null && request.wh_chief_approval === null && request.wh_treatment !== null">
                      <!-- <form @submit.prevent="signModal"> -->
                          <button as="button" type="submit" @click="wHBackPoint" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Tranférer au CM
                          </button>
                      <!-- </form> -->
                  </div>
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 7) && request.rA_approval !== null && request.deliv_or == 0 && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null  && request.wh_chief_approval === null && request.wh_treatment === null">
                      <form  @submit.prevent="showDelivery(request)" >
                          <button as="button" type="submit" class="btn btn-warning text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Organiser le transfert
                          </button>
                      </form>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 8) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null && request.wh_chief_approval !== null && request.cm_approval === null && request.cm_treatment !== null">
                      <!-- <form @submit.prevent="signModal"> -->
                          <button as="button" type="submit" @click="wHBackPoint" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Tranférer
                          </button>
                      <!-- </form> -->
                  </div>
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 8) && request.rA_approval !== null && request.deliv_or == 0 && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null && request.wh_chief_approval !== null && request.cm_approval === null && request.cm_treatment === null">
                      <form  @submit.prevent="showDelivery(request)" >
                          <button as="button" type="submit" class="btn btn-warning text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Servir les matériels
                          </button>
                      </form>
                  </div>
  
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 9) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null && request.wh_chief_approval !== null && request.cm_approval !== null">
                      <!-- <form @submit.prevent="signModal"> -->
                          <button as="button" type="submit" @click="signModal" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Signer
                          </button>
                      <!-- </form> -->
                  </div>
              
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 10) && request.rA_approval !== null && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null && request.wh_chief_approval !== null && request.cm_approval !== null && request.taker_sign !== null && request.prmp_approval === null && request.prmp_treatment !== null">
                      <!-- <form @submit.prevent="signModal"> -->
                          <button as="button" type="submit" @click="informDG" class="btn btn-primary text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Tranférer
                          </button>
                      <!-- </form> -->
                  </div>
                  <div class="text-center col-4" v-if="(request.user_service_id === user.service_id && user.grade_id === 10) && request.rA_approval !== null && request.deliv_or == 0 && request.sH_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.token !== null && request.wh_chief_approval !== null && request.cm_approval !== null && request.taker_sign !== null && request.prmp_approval === null && request.prmp_treatment === null">
                      <form  @submit.prevent="commandNAdd" >
                          <button as="button" type="submit" class="btn btn-warning text-white" style="letter-spacing: 0.1em; border-radius:20px; border:none" role="button">
                              Remplir le bon de commande
                          </button>
                      </form>
                  </div>
  
              </div>
  
              <br>
  
          </div>
  
          <div v-if="request.user_id === user.id">
              <h4 class="text-center">SUIVI</h4>
              
              <div class="card-body table-responsive p-0">
                  <table id="example1" class="table table-hover text-nowrap table-bordered table-striped">
                  <thead>
                      <tr>
                      <th class="text-capitalize">Supérieur Hiérarchique</th>
                      <th class="text-capitalize">Référant approvisionnement</th>
                      <th class="text">DPAL</th>
                      <th class="text">CDL</th>
                      <th class="text">Chef entrepôt</th>
                      <th class="text">Chef magasinier</th>
                      <th class="text">Approvisionneur</th>
                      <th class="text">PRMP</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>
                              <span v-if="request.sH_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                  Rejetée
                              </span>
                              <button v-if="request.sH_approval == 0 && request.user_id === user.id" style="background-color:blue; padding:2px; border-radius:50%; top:-10px; position: relative; color:#fff" class="bg-circle small" href="#" @click="openRejsH">?</button>
                              <span v-if="request.sH_approval === null && request.on_treat == 1" class="badge bg-danger" style="border-radius:25px">Rejetée</span>
                              <span>
                                   <a v-if="request.sH_approval === null && request.on_treat == 1 && request.user_id === user.id" class="badge bg-circle small bg-secondary" href="#" @click="openRejsH">Motif du rejet</a>
                              </span>
                              <span v-if="request.sH_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                          </td>
                          <td>
                              <span v-if="request.rA_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                  <button v-if="request.rA_approval == 0 && request.user_id === user.id"  class="bg-circle small" href="#" @click="openRejrA">Rejetée</button>
                              </span>
                              <span v-if="request.rA_approval === null && request.on_treat == 1 && request.status == 2" class="badge bg-danger" style="border-radius:25px">Rejetée</span>
                              &nbsp;
                              <span>
                                  <a v-if="request.rA_approval === null && request.on_treat == 1 && request.status == 2 && request.user_id === user.id" class="badge bg-circle small bg-secondary" href="#" @click="openRejrA">Motif du rejet</a>
                              </span>
                              <span v-if="request.rA_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                          </td> 
                          <td>
                              <span v-if="request.dPal_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                  <button v-if="request.dPal_approval == 0 && request.user_id === user.id"  class="bg-circle small" href="#" @click="openRejDpal">Rejetée</button>
                              </span>
                              <span v-if="request.dPal_approval === null && request.on_treat == 1 && request.status == 3" class="badge bg-danger" style="border-radius:25px">Rejetée</span>
                              &nbsp;
                              <span>
                                  <a v-if="request.dPal_approval === null && request.on_treat == 1 && request.status == 3 && request.user_id === user.id" class="badge bg-circle small bg-secondary" href="#" @click="openRejDpal">Motif du rejet</a>
                              </span>
                              <span v-if="request.dPal_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                          </td>
                          <td>
                              <span v-if="request.cDL_approval == 0" class="badge badge-danger" style="border-radius:25px">
                                  <button v-if="request.cDL_approval == 0 && request.user_id === user.id"  class="bg-circle small" href="#" @click="openRejCdl">Rejetée</button>
                              </span>
                              <span v-if="request.cDL_approval === null && request.on_treat == 1 && request.status == 4" class="badge bg-danger" style="border-radius:25px">Rejetée</span>
                              &nbsp;
                              <span>
                                  <button v-if="request.cDL_approval === null && request.on_treat == 1 && request.status == 4 && request.user_id === user.id" class="badge bg-circle small bg-secondary" href="#" @click="openRejCdl">Motif du rejet</button>
                              </span>
                              <span v-if="request.cDL_approval == 1" class="badge badge-info" style="border-radius:25px">Approuvée</span>
                          </td>
                          <td>
                              <span v-if="request.wh_chief_approval === null && request.status == 5" class="badge bg-secondary" style="border-radius:25px">Traitement...</span>
                              
                              <span v-if="request.wh_chief_approval == 1" class="badge badge-info" style="border-radius:25px">Transférée</span>
                          </td>
                           <td>
                              <span v-if="request.cm_approval === null && request.status == 6" class="badge bg-secondary" style="border-radius:25px">Traitement...</span>
                              
                              <span v-if="request.cm_approval == 1" class="badge badge-info" style="border-radius:25px">Transférée</span>
                          </td>
                          <td>
                              <span v-if="request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.cm_approval !== null && request.taker_sign === null && request.status == 7" class="badge bg-secondary" style="border-radius:25px">Traitement...</span>
                              
                              <span v-if="request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.cm_approval !== null && request.taker_sign == 1" class="badge badge-info" style="border-radius:25px">Signée</span>
                          </td>
                          <td>
                              <span v-if="request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.cm_approval !== null && request.prmp_approval === null && request.status == 8" class="badge bg-secondary" style="border-radius:25px">Traitement...</span>
                              
                              <span v-if="request.sH_approval !== null && request.rA_approval !== null && request.dPal_approval !== null && request.cDL_approval !== null && request.cm_approval !== null && request.taker_sign !== null && request.prmp_approval == 1" class="badge badge-info" style="border-radius:25px">Transfert éffectué</span>
                          </td>
                      </tr>
                  </tbody>
                  </table>
              </div>
              <br>
          </div>
  
          <!-- REJECT MODAL -->
          <div class="modal fade" id="modal-lg">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>Rejet d'une demande {{ formTitle }}</strong></h3>
                          <button type="button" class="close" @click="closeModal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body overflow-hidden">
                          <div class="card card-primary">
                              <form @submit.prevent="reject">
                                  <div class="card-body">
                                      <input type="hidden" v-model="form.request_id">
                                      <input type="hidden" v-model="form.author_id">
                                      <input type="hidden" v-model="form.user_grade">
  
                                      <div class="form-group">
                                          <label for="description" class="h5">Motif du rejet</label>
                                          <textarea rows="4"  class="form-control" id="custom_text" v-model="form.description" :class="{ 'is-invalid' : form.errors.description }" autocomplete="off" placeholder="Veuillez donner le motif du rejet" minlength="10" maxlength="500"></textarea>
                                      </div>
                                      <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.description}">
                                          {{ form.errors.description }}
                                      </div>
  
                                      <!-- <div class="form-group" v-if="user.grade_id != 4">
                                          <input type="checkbox" id="option" v-model="form.cReject" :class="{ 'is-invalid' : form.errors.cReject }">
                                          &nbsp;
                                          <label for="option" class="h5">Rejet catégorique</label>
                                      </div>
                                      <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.cReject}">
                                          {{ form.errors.cReject }}
                                      </div> -->
  
                                  </div>
  
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                      <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled=" !form.description || form.processing">Envoyer</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  
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
   
          <!-- BACK POINT -->
          <div class="modal fade" id="modal-wHBackPoint">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>{{ backPointTitle }}</strong></h3>
                          <button type="button" class="close" @click="closeModal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body overflow-hidden">
                          <div class="card card-primary">
                              <form @submit.prevent="wHChiefApprove">
                                  <div class="card-body">
                                      <input type="hidden" v-model="form.request_id">
                                      <input type="hidden" v-model="form.author_id">
                                      <!-- <input type="hidden" v-model="form.user_grade"> -->
  
                                      <div class="form-group">
                                          <label for="wHBackPoint" class="h5">Note</label>
                                          <textarea rows="4"  class="form-control" id="custom_text" v-model="form.wHBackPoint" :class="{ 'is-invalid' : form.errors.wHBackPoint }" autocomplete="on" placeholder="Veuillez renseigner les informations sur l'état du stock" minlength="10" maxlength="600"></textarea>
                                      </div>
                                      <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.wHBackPoint}">
                                          {{ form.errors.wHBackPoint }}
                                      </div>
  
                                  </div>
  
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                      <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled=" !form.wHBackPoint || form.processing">Envoyer</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  
          <!-- SIGN MODAL -->
          <div class="modal fade" id="modal-signModal">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>Signature</strong></h3>
                          <button type="button" class="close" @click="closeModal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body overflow-hidden">
                          <div class="card card-primary">
                              
                             <form @submit="approve" enctype="multipart/form-data">
                              <div class="uploader"
                                  @dragenter="OnDragEnter"
                                  @dragleave="OnDragLeave"
                                  @dragover.prevent
                                  @drop="onDrop"
                                  :class="{ dragging: isDragging }">
                                  
                                  <!-- <div class="upload-control" v-show="images.length">
                                      <label for="file">Sélectionnez un fichier</label>
                                      <button @click="upload">Charger</button>
                                  </div> -->
  
                                  <div v-show="!images.length">
                                      <i class="fa fa-cloud-upload"></i>
                                      <p>Glisser déposer votre signature</p>
                                      <div>OU</div>
                                      <div class="file-input">
                                          <label for="file">Sélectionnez le fichier</label>
                                          <!-- <input type="hidden" v-model="form.user_grade">
                                          <input type="hidden" v-model="form.request_id"> -->
                                          <input type="file" id="file" @change="onChange">
                                      </div>
                                  </div>
  
                                  <div class="images-preview" v-show="images.length">
                                      <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                                          <img :src="image" :alt="`Image Uplaoder ${index}`">
                                          <div class="details">
                                              <span class="name" v-text="files[index].name"></span>
                                              <span class="size" v-text="getFileSize(files[index].size)"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                  <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" >Envoyer</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  
          <!-- COMMAND MODAL -->
          <div class="modal fade" id="modal-commandNAdd">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h3 class="card text-center col-lg-11 text-white" style="background-color:#4851ec"><strong>BON DE COMMANDE</strong></h3>
                          <button type="button" class="close" @click="closeModal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body overflow-hidden">
                          <div class="card card-primary">
                              <form @submit.prevent="commandNumberAdd">
                                  <div class="card-body">
                                      <input type="hidden" v-model="form.request_id">
                                      <input type="hidden" v-model="form.author_id">
                                      
                                      <div class="col-12 d-flex">
                                          <div class="form-group" style="width:100%">
                                              <label for="command_number" class="h5">Numéro du bon de commande<span class="text-red">*</span></label>
                                              <input type="text" class="form-control" id="command_number" placeholder="DT/UI80/78-2022" min="1000" v-model="form.command_number" :class="{ 'is-invalid' : form.errors.command_number }" autocomplete="off" minlength="5" maxlength="30">
  
                                              <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.command_number}">
                                                  {{ form.errors.command_number }}
                                              </div>
                                          </div>
                                          <div class="form-group ml-4" style="width:100%">
                                              <label for="pw_date" class="h5">Date de retrait prévue<span class="text-red">*</span></label>
                                              <input type="date" class="form-control" id="pw_date" v-model="form.pw_date" :class="{ 'is-invalid' : form.errors.pw_date }" @click="getDate()">
  
                                              <div class="invalid-feedback mb-3" :class="{ 'd-block' : form.errors.pw_date }">
                                                  {{ form.errors.pw_date }}
                                              </div>
                                          </div>
                                      </div>
  
                                  </div>
  
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-danger" style="letter-spacing: 0.1em; background-color: var(--bs-gray); border-radius:20px; border:none" @click="closeModal">Annuler</button>
                                      <button type="submit" class="btn btn-info btn-style text-white" style="letter-spacing:0.1em; background-color:#4851ec; border-radius:20px;" :disabled="!form.command_number || !form.pw_date || form.processing">Envoyer</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  
        </section>
  
      </admin-layout>
    </div>
  </template>
  
  <script>
      import AdminLayout from '@/Layouts/AdminLayout';
      import RequestTemplate from '@/Components/RequestTemplate';
      import axios from 'axios';
      import html2canvas from 'html2canvas';
      import { jsPDF } from "jspdf";
      // import vueSignature from "vue-signature"
      // import SignTemplate from "@/Components/SignTemplate";
      // import RejectModals from "@/Components/RejectModals";
  
      export default {
          emits : ['update:modelValue'],
          props: ['user', 'the_service', 'the_sH', 'request', 'request_type', 'req_categories', 'trans_mentions', 'pw_date', 'dPal_reject_motion','rA_reject_motion','sH_reject_motion','cDL_reject_motion',],
          components: {
              AdminLayout,
              RequestTemplate,
              // vueSignature,
              // RejectModals,
          },
          data() {
              return {
                      form: this.$inertia.form({
                          id: this.request.id,
                          user_id: this.request.user_id,
                          title: this.request.title,
                          token: '76890',
                          status: 1,
                          sent_or: 1,
                          user_service_id: this.request.user_service_id,
                          user_grade: 'hyfkyufvj',
                          sign: this.sign,
                          description: '',
                          pw_date: '',
                          command_number: '',
                          name: '',
                          file: '',
                          success: '',
  
                          request_id: this.request.id,
                          author_id: this.user.id,
                          wHBackPoint: this.wHBackPoint,
                      }),
                      // request: this.$inertia.form(),
                      sign : this.$refs.signature,
                          // images: document.getElementById("file").value,
                      // images: this.$refs.sign_image,
                      request: this.request,
                      the_service: this.the_service,
                      user: this.user,
                      the_sH: this.the_sH,
                      dPal_reject_motion: this.dPal_reject_motion,
                      rA_reject_motion: this.rA_reject_motion,
                      sH_reject_motion: this.sH_reject_motion,
                      user_service_id: this.user_service_id,
                      cDL_reject_motion: this.cDL_reject_motion,
                      wHBackPoint: this.wHBackPoint,
                      command_number: this.command_number,
                      selectedFile: null,
  
                      isDragging: false,
                      dragCount: 0,
                      files: [],
                      images: [],
                      
                      }
                  },
                  mounted(){
                      // var images = document.getElementById("file").value;
                      // console.log('app');
                      // console.log(images);
  
  
  
                  },
          computed: {
              filters: {
                  date: function(str) {
                      if (!str) { return '(n/a)'; }
                      str = new Date(str);
                      return str.getFullYear() + '-' + ((str.getMonth() < 9) ? '0' : '') + (str.getMonth() + 1) + '-' +
                      ((str.getDate() < 10) ? '0' : '') + str.getDate();
                  }
              },
              formTitle() {
                  return this.user.grade_id === 5 ? '(Supérieur hiérachique)' : this.user.grade_id === 4 ? '(Référant approvisionnement)': this.user.grade_id === 3 && this.request.request_type_id == 1 ? '(Chef département Logistique DPAL)' : this.user.grade_id === 3 && (this.request.request_type_id == 2 || this.request.request_type_id == 3) ? '(Chef département Patrimoine DPAL)' : this.user.grade_id === 2 ? '(CDL)' : '';
              },
              backPointTitle() {
                  return this.user.grade_id === 7 ? 'Informations sur l\'état du stock' : this.user.grade_id === 8 ? 'Compte rendu du niveau du stock': '';
              },
              checkButton() {
                  return (this.request.user_id === this.user.id && this.request.sent_or == 0 && this.request.status == 0 && this.request.deliv_or !== null) ? this.send() : this.approve(); 
              }
              
          },
          methods: {
              onChange(e) {
                  this.file = e.target.files[0];
              },
              formSubmit(e) {
                  e.preventDefault();
                  let existingObj = this;
                  const config = {
                      headers: {
                          'content-type': 'multipart/form-data'
                      }
                  }
                  let data = new FormData();
                  data.append('file', this.file);
                  axios.post('/signs', data, config)
                      .then(function (res) {
                          existingObj.success = res.data.success;
                      })
                      .catch(function (err) {
                          existingObj.output = err;
                      });
              },
              onFileSelected(event){
                  this.selectedFile = event.target.files[0]
              },
              makePDF(){
                  window.html2canvas = html2canvas;
                  var doc = new jsPDF({
                      orientation: 'p', 
                      unit: 'px', 
                      format: [1048, 1665]
                  });
                  doc.html(document.querySelector("#therequest"), {
                      callback: function(pdf) {
                          pdf.save("extrait_de_demande.pdf");
                      }
                  });
              },
              getDate(){
                  var dtToday = new Date();
  
                  var month = dtToday.getMonth() + 1;
                  var day = dtToday.getDate() + 1;
                  var year = dtToday.getFullYear();
  
                  var maxday = dtToday.getDate() + 30;
  
                  if(month < 10)
                      month = '0' + month.toString();
                  if(day < 10)
                      day = '0' + day.toString();
  
  
                  var minDate = (year) + '-' + month + '-' + day;
                  var maxDate = "2022-12-31";
                  document.getElementById('pw_date').setAttribute('min', minDate);
                  document.getElementById('pw_date').setAttribute('max', maxDate);
              },
              showDelivery(request){
                  this.form.get(this.route('user.mat_transferts.show', request));
              },
              addSign(){
                  this.form.post(this.route('user.sign.store'));
              },
              reject() {
                  this.form.post(this.route('user.requests.reject', this.form.id, this.form), {
                      preserveScroll: true,
                       onSuccess: ()=> {
                          Toast.fire({
                              icon: 'success',
                              title: 'La demande a été rejetée avec succès !'
                          })
                          this.closeModal()
                      }
                  })
              },
              openModal() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-lg').modal('show')
              },
              commandNAdd() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-commandNAdd').modal('show')
              },
              signModal() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-signModal').modal('show')
              },
              wHBackPoint() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-wHBackPoint').modal('show')
              },
              openRejCdl() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-rejCdl').modal('show')
              },
              openRejDpal() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-rejDpal').modal('show')
              },
              openRejrA() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-rejrA').modal('show')
              },
              openRejsH() {
                  this.editMode = false
                  this.form.reset()
                  this.editedIndex = 5
                  $('#modal-rejsH').modal('show')
              },
              closeModal() {
                  this.form.clearErrors()
                  this.editMode = false
                  this.form.reset()
                  $('#modal-lg').modal('hide')
                  $('#modal-rejsH').modal('hide')
                  $('#modal-rejrA').modal('hide')
                  $('#modal-rejDpal').modal('hide')
                  $('#modal-rejCdl').modal('hide')
                  $('#modal-wHBackPoint').modal('hide')
                  $('#modal-commandNAdd').modal('hide')
                  $('#modal-signModal').modal('hide')
              },
              edit(request){
                  this.$inertia.get(route('user.requests.edit', [request]));
              },
              treatDeliv(request){
                  this.$inertia.get(route('user.mat_transferts.edit', [request]));
              },
              commandNumberAdd(){
                  this.form.post(route('user.requests.addCommandN'), {
                      preserveScroll: true,
                      onSuccess:() => {
                          this.form.reset()
                          this.closeModal()
                          Toast.fire({
                              icon: 'success',
                              title: 'Bon de commande ajouté !'
                          })
                      }
                  })
              },
              approve(e) {
                  //     Swal.fire({
                  //     title: 'Veuillez confirmez svp',
                  //     // text: "Veuillez confirmer svp",
                  //     icon: 'warning',
                  //     showCancelButton: true,
                  //     confirmButtonColor: '#3085d6',
                  //     cancelButtonColor: '#d33',
                  //     cancelButtonText: 'Annuler',
                  //     confirmButtonText: 'Oui, approuver!'
                  // }).then((result) => {
                  //     if (result.isConfirmed) {
  
                      e.preventDefault();
                      let existingObj = this;
                      const config = {
                          headers: {
                              'content-type': 'multipart/form-data'
                          }
                      }
                      let data = new FormData();
                      data.append('file', this.file);
                      axios.post('/signs', data, this.form.user_grade)
                          .then(function (res) {
                              existingObj.success = res.data.success;
                          })
                          .catch(function (err) {
                              existingObj.output = err;
                          });
                          this.form.post(route('user.requests.approve', this.form.id, this.form), {
                              preserveScroll: true,
                              onSuccess: ()=> {
                                  Swal.fire(
                                      'Approuvée !',
                                      'La demande a été bien approuvée',
                                      'success'
                                  )
                              }
                          }
                          ) 
                  //         }
                  // })
  
              },
              wHChiefApprove() {
                  Swal.fire({
                      title: 'Etes-vous sûr d\'avoir renseigner toutes les informations ?',
                      text: "Si oui veuillez confirmer svp",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      cancelButtonText: 'Annuler',
                      confirmButtonText: 'Oui, transférer!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          this.form.post(route('user.requests.approve', this.form.id, this.form), {
                              preserveScroll: true,
                              onSuccess: ()=> {
                                  Swal.fire(
                                      'Transférée !',
                                      'La demande a été bien transférée',
                                      'success'
                                  )
                              }
                          })
                      }
                  })
              },
              send() {
                  Swal.fire({
                      title: 'Voulez vous vraiment soumettre cette demande ?',
                      text: "Si oui veuillez confirmer svp",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      cancelButtonText: 'Annuler',
                      confirmButtonText: 'Oui, soumettre!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          this.form.post(route('user.requests.sendRequest', this.form.id, this.form), {
                              preserveScroll: true,
                              onSuccess: ()=> {
                                  Swal.fire(
                                      'Envoyée !',
                                      'La demande a été envoyée avec succès.',
                                      'success'
                                  )
                              }
                          })
                      }
                  })
              },
              sendAgain() {
                  Swal.fire({
                      title: 'Etes-vous sûr d\'avoir apporté les modifications ?',
                      text: "Si oui veuillez confirmer svp",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      cancelButtonText: 'Annuler',
                      confirmButtonText: 'Oui, renvoyer!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          this.form.post(route('user.requests.sendAgain', this.form.id, this.form), {
                              preserveScroll: true,
                              onSuccess: ()=> {
                                  Swal.fire(
                                      'Renvoyée !',
                                      'La demande a été renvoyée avec succès.',
                                      'success'
                                  )
                              }
                          })
                      }
                  })
              },
          OnDragEnter(e) {
              e.preventDefault();
              
              this.dragCount++;
              this.isDragging = true;
  
              return false;
          },
          OnDragLeave(e) {
              e.preventDefault();
              this.dragCount--;
  
              if (this.dragCount <= 0)
                  this.isDragging = false;
          },
          onInputChange(e) {
              const files = e.target.files;
  
              Array.from(files).forEach(file => this.addImage(file));
          },
        
          onDrop(e) {
              e.preventDefault();
              e.stopPropagation();
  
              this.isDragging = false;
  
              const files = e.dataTransfer.files;
  
              Array.from(files).forEach(file => this.addImage(file));
          },
          addImage(file) {
              if (!file.type.match('image.*')) {
                  // this.$toastr.e(`${file.name} n'est pas un format image`);
                  return;
              }
  
              this.files.push(file);
  
              const img = new Image(),
                  reader = new FileReader();
  
              reader.onload = (e) => this.images.push(e.target.result);
  
              reader.readAsDataURL(file);
          },
          getFileSize(size) {
              const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
              let i = 0;
              
              while(size > 900) {
                  size /= 1024;
                  i++;
              }
  
              return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
          },
          }
      }
  </script>
  
  <style lang="scss" scoped>
  .uploader {
      width: 100%;
      background: #2196F3;
      color: #fff;
      padding: 40px 15px;
      text-align: center;
      border-radius: 10px;
      border: 3px dashed #fff;
      font-size: 20px;
      position: relative;
  
      &.dragging {
          background: #fff;
          color: #2196F3;
          border: 3px dashed #2196F3;
  
          .file-input label {
              background: #2196F3;
              color: #fff;
          }
      }
  
      i {
          font-size: 85px;
      }
  
      .file-input {
          width: 200px;
          margin: auto;
          height: 68px;
          position: relative;
  
          label,
          input {
              background: #fff;
              color: #2196F3;
              width: 100%;
              position: absolute;
              left: 0;
              top: 0;
              padding: 10px;
              border-radius: 4px;
              margin-top: 7px;
              cursor: pointer;
          }
  
          input {
              opacity: 0;
              z-index: -2;
          }
      }
  
      .images-preview {
          display: flex;
          flex-wrap: wrap;
          margin-top: 20px;
  
          .img-wrapper {
              width: 160px;
              display: flex;
              flex-direction: column;
              margin: 10px;
              height: 150px;
              justify-content: space-between;
              background: #fff;
              box-shadow: 5px 5px 20px #3e3737;
  
              img {
                  max-height: 105px;
              }
          }
  
          .details {
              font-size: 12px;
              background: #fff;
              color: #000;
              display: flex;
              flex-direction: column;
              align-items: self-start;
              padding: 3px 6px;
  
              .name {
                  overflow: hidden;
                  height: 18px;
              }
          }
      }
  
      .upload-control {
          position: absolute;
          width: 100%;
          background: #fff;
          top: 0;
          left: 0;
          border-top-left-radius: 7px;
          border-top-right-radius: 7px;
          padding: 10px;
          padding-bottom: 4px;
          text-align: right;
  
          button, label {
              background: #2196F3;
              border: 2px solid #03A9F4;
              border-radius: 3px;
              color: #fff;
              font-size: 15px;
              cursor: pointer;
          }
  
          label {
              padding: 2px 5px;
              margin-right: 10px;
          }
      }
  }
  </style>