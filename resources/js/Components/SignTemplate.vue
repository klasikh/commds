<template>
  <div onselectstart="return false" id="signBox">
    <div id="signature-pad" class="signature-pad">
      <div class="signature-pad--body">
        <canvas></canvas>
      </div>
      <div class="signature-pad--footer">
        <div class="description">Signez ici</div>
  
        <div class="signature-pad--actions">
          <div>
            <button type="button" class="btn btn-default" id="clear" data-action="clear">Effacer</button>
            <!-- <button type="button" class="btn btn-default"    data-action="change-color">Change color</button> -->
            <button type="button" class="btn btn-default" id="undo"  data-action="undo">Annuler</button>
  
          </div>
          <div>
          <button type="button" class="button save" id="save-svg" data-action="save-svg" hidden=true></button>
          <button type="button" class="button save" id="save-png" data-action="save-png" hidden=true></button>
        <button type="button" class="btn btn-primary"  style="background-color:blue" id="save-jpg" data-action="save-jpg">Enregistrer</button>
                    </div>
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