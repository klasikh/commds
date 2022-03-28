<template>
	<div id="app">
        <form action="" class="card-img-top" @submit.prevent="sign" method="POST" autocomplete="off" enctype="multipart/form-data" >
			<vueSignature ref="signature" id="sign" v-model="form.png" name="sign" :sigOption="option" :w="'800px'" :h="'400px'" :disabled="disabled" :defaultUrl="dataUrl"></vueSignature> 
			<!-- <vueSignature ref="signature1" :sigOption="option"></vueSignature>  -->
			<button @click="save" class="btn btn-primary">Enregistrer</button>&nbsp;
			<button @click="clear" class="btn btn-danger">Effacer</button>&nbsp;
			<button @click="undo" class="btn btn-warning">Annuler</button>&nbsp;
			<!-- <button @click="addWaterMark">addWaterMark</button> -->
			<!-- <button @click="handleDisabled" class="btn btn-secondary" id="desac">Désactiver</button> -->
        </form>
	</div>
</template>

<script>
import vueSignature from "vue-signature"
export default {
	name: "app",
	components:{
		vueSignature
	},
	data() {
		return {
			form: this.$inertia.form({
				id: '',
				sign: this.png,
            }),
			option:{
				penColor:"rgb(0, 0, 0)",
				backgroundColor:"rgb(255,255,255)"
			},
			disabled:false,
			dataUrl:"images/",
			// sign: this.sign
		};
	},
	methods:{ 
		save(){
			var _this = this;
			var png = _this.$refs.signature.save('image/png')
			var jpeg = _this.$refs.signature.save('image/jpeg')
			var svg = _this.$refs.signature.save('image/svg+xml');
			console.log(png);
			console.log(jpeg)
			console.log(svg)
            this.form.post(this.route('user.signs.store'))
		},
		clear(){
			var _this = this;
			_this.$refs.signature.clear();
		},
		undo(){
			var _this = this;
			_this.$refs.signature.undo();
			var texte = document.getElementById("desac");
			if (texte.innerHTML == "Désactiver") {
				texte.innerHTML = "Activer";
			}
			else {
				texte.innerHTML = "Désactiver";
			}
		},
		addWaterMark(){
			var _this = this;
			_this.$refs.signature.addWaterMark({
				text: user.name + ' ' + user.surname,          // watermark text, > default ''
				font:"20px Arial",         // mark font, > default '20px sans-serif'
				style:'all',               // fillText and strokeText,  'all'/'stroke'/'fill', > default 'fill		
				fillStyle:"red",           // fillcolor, > default '#333' 
				strokeStyle:"blue",	   // strokecolor, > default '#333'	
				x:100,                     // fill positionX, > default 20
				y:200,                     // fill positionY, > default 20				
				sx:100,                    // stroke positionX, > default 40
				sy:200                     // stroke positionY, > default 40
			});
		},
		fromDataURL(url){
			var _this = this;
			_this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
		},
		handleDisabled(){
			var _this = this;
			_this.disabled  = !_this.disabled
		}
	}
};
</script>