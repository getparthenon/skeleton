<template>
  <div class="flex items-center justify-center h-screen login">
    <form @submit.prevent="handleSubmit" v-if="signing_up">
      <div class="p-5 form-body">
        <div class="w-full">
          <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
        </div>
        <h1 class="h1 text-center">{{ $t('signup.title') }}</h1>
        <div class="px-5 mb-3">
          <label class="block mb-1">{{ $t('signup.email') }}</label>
          <input type="text" class="input-field" v-model="email" />
        </div>
        <div class="px-5 mb-3">
          <label class="block mb-1">{{ $t('signup.password') }}</label>
          <input type="password" class="input-field" v-model="password" />
        </div>
        <div class="px-5 mb-3 flex items-center justify-between">
          <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
        </div>
        <div class="px-5">
          <button type="submit" class="btn--main w-full">{{ $t('signup.signup_button') }}</button>
        </div>
      </div>
    </form>
    <div v-else>
      <div class="p-5 form-body">
        <div class="px-5">
          {{ $t('signup.success_message') }}
        </div>
      </div>
    </div>
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
      error: '',
      signing_up: true
    }
  },
  methods: {

    handleSubmit (e) {
      this.submitted = true;
      const { email, password } = this;
      var user = {email, password}
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
      }
    }
  }
}
</script>

<style scoped>

</style>