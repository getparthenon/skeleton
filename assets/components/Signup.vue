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
        <div class="p-5 form-body" :class="{'animate-shake': error_info.has_error}">
          <div class="w-full">
            <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
          </div>
          <h1 class="h1 text-center">{{ $t('public.signup.title') }}</h1>
          <div class="px-5 mb-3">
            <label class="block mb-1">{{ $t('public.signup.email') }}</label>
            <input type="text" class="input-field" v-model="email" />
            <span class="block text-red-500" v-if="email_error !== undefined">{{ email_error }}</span>
          </div>
          <div class="px-5 mb-3">
            <label class="block mb-1">{{ $t('public.signup.password') }}</label>
            <input type="password" class="input-field" v-model="password" />
            <span class="block text-red-500" v-if="password_error !== undefined">{{ password_error }}</span>
          </div>
          <div class="px-5 mb-3">
            <label class="block mb-1">{{ $t('public.signup.password_confirm') }}</label>
            <input type="password" class="input-field" v-model="password_confirm" />
            <span class="block text-red-500" v-if="password_confirm_error !== undefined">{{ password_confirm_error }}</span>
          </div>
          <div class="px-5 pt-3">
            <button type="submit" class="btn--main w-full" v-if="!in_process">{{ $t('public.signup.signup_button') }}</button>
            <button type="submit" class="btn--main--disabled w-full cursor-not-allowed" v-else>
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ $t('public.signup.signing_up') }}
            </button>
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
      email_error: undefined,
      password: '',
      password_error: undefined,
      password_confirm: '',
      password_confirm_error: undefined,
      error: '',
      signing_up: true,
      in_process: false,
      error_info: {
        has_error: false,
      }
    }
  },
  methods: {

    handleSubmit (e) {
      this.submitted = true;
      const { email, password, password_confirm } = this;
      var user = {email, password}
      var hasError = false

      this.email_error = undefined
      this.password_error = undefined
      this.password_confirm_error = undefined

      if (email === "") {
        this.email_error = this.$t('public.signup.email_error')
        hasError = true;
      }

      if (password === "") {
        this.password_error = this.$t('public.signup.password_error')
        hasError = true;
      } else if (password !== password_confirm) {
        this.password_confirm_error = this.$t('public.signup.password_confirm_error')
        hasError = true;
      }

      if (hasError) {
        this.error_info = {has_error: true};
        return;
      }

      this.in_process = true

      if (email && password) {
        userservice.signup(user, this.$route.params.code)
            .then(
                user => {
                  console.log("Signed up")
                  this.signing_up = false
                },
                error => {
                  this.error = error
                }
            );
      }
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