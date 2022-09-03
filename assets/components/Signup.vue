<template>
  <div class="flex items-center justify-center h-screen login">
    <transition
        appear-active-class="duration-1000 ease-out"
        apear-to-class="opacity-300"

        enter-active-class="duration-500 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="transform opacity-300"

        leave-active-class="duration-500 ease-in"
        leave-from-class="opacity-300"
        leave-to-class="transform opacity-0"

        mode="out-in"

        appear>
      <form @submit.prevent="handleSubmit" v-if="signing_up">
        <div class="p-5 form-body">
          <div class="w-full">
            <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
          </div>
          <h1 class="h1 text-center">{{ $t('public.signup.title') }}</h1>
          <div class="px-5 mb-3">
            <label class="block mb-1">{{ $t('public.signup.email') }}</label>
            <input type="text" class="input-field" v-model="email" />
          </div>
          <div class="px-5 mb-3">
            <label class="block mb-1">{{ $t('public.signup.password') }}</label>
            <input type="password" class="input-field" v-model="password" />
          </div>
          <div class="px-5 mb-3">
            <label class="block mb-1">{{ $t('public.signup.password_confirm') }}</label>
            <input type="password" class="input-field" v-model="password_confirm" />
          </div>
          <div class="px-5">
            <button type="submit" class="btn--main w-full">{{ $t('public.signup.signup_button') }}</button>
          </div>
          <div class="mt-5 px-5 mb-3  text-center">
            <router-link :to="{name: 'public.login'}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">{{ $t('public.signup.login_link') }}</router-link>
          </div>
        </div>
      </form>
      <div v-else>
        <div class="p-5 form-body">
          <div class="px-5">
            {{ $t('public.signup.success_message') }}
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import {userservice} from "../services/userservice";

export default {
  name: "Signup",
  data() {
    return {
      email: '',
      password: '',
      password_confirm: '',
      error: '',
      signing_up: true
    }
  },
  methods: {

    handleSubmit (e) {
      this.submitted = true;
      const { email, password } = this;
      var user = {email, password}
      this.signing_up = false
      /*
      if (email && password) {
        userservice.signup(user, this.$route.params.code)
            .then(
                user => {
                  console.log("Signed up")
                  this.signing_up = false
                },
                error => {
                  console.log("error")
                  this.error = error
                }
            );
      }*/
    }
  }
}
</script>

<style scoped>

.animate-fade-in-second {
  animation: fadeIn 1s;
}

.animate-fade-out {
  animation: fadeOut 1s;
}
</style>