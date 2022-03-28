<template>
  <Head title="Connexion" />

      <div class="login">
        <div class="login__content">
          <div class="login__img">
              <img class="bg-img" src="/images/home_bg.jpg" alt="">
              <img class="top-img" src="images/digicom_logo.png" alt="">
              <h1 class="lg__text">Procédure de gestion des commandes</h1>
          </div>

          <div class="login__forms">

            <form @submit.prevent="submit" class="login__registre" id="login-in">
              <h1 class="login__title">Connexion</h1>

            <jet-validation-errors class="mb-3" />

            <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
              {{ status }}
            </div>

              <div class="login__box">
                  <i class='fas fa-envelope'></i>
                  <input id="email" type="email" class="login__input"
                  name="email" v-model="form.email" required autocomplete="email" placeholder="Email" autofocus />
              </div>
              <div class="login__box">
                  <i class='fas fa-lock'></i>
                  <input id="password" type="password" class="login__input"
                  name="password" v-model="form.password" required autocomplete="current-password" placeholder="Mot de passe"/>
              </div>
              <div class="form-check stay_logged">
                  <input id="remember_me" type="checkbox" class="login__input"
                  name="remember" v-model="form.remember"/>
                  <label class="form-check-label" for="remember_me">
                    Se souvenir de moi
                </label>
              </div>

                <a :href="route('password.request')" class="btn btn-link login__forgot" v-if="canResetPassword" style="color:#fff; float:right">
                  Mot de passe oublié ?
                </a>
                <span v-show="form.processing" class="text-white" role="status">Chargement...</span>

                <button type="submit" class="login__button" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                  Se connecter
                </button>

            </form>

          </div>
      </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
})
</script>
