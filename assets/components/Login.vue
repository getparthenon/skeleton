<template>
  <div class="flex items-center justify-center h-screen login">
    <form @submit.prevent="handleSubmit">
      <div class="p-5 form-body">
        <div class="w-full">
          <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
        </div>
        <h1 class="h1 text-center">{{ $t('login.title') }}</h1>
        <div class="px-5 mb-3">
          <label class="block mb-1">{{ $t('login.email') }}</label>
          <input type="text" class="field" v-model="email" />
        </div>
        <div class="px-5 mb-3">
          <label class="block mb-1">{{ $t('login.password') }}</label>
          <input type="password" class="field" v-model="password" />
        </div>
        <div class="px-5 mb-3 flex items-center justify-between">
          <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
        </div>
        <div class="px-5">
          <button type="submit" class="btn--main w-full">{{ $t('login.login_button') }}</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: "Login",
  data () {
    return {
      email: '',
      password: '',
      submitted: false
    }
  },
  computed: {

    ...mapState('user', ['status', 'error_info'])
  },
  methods: {
    ...mapActions('user', ['login', 'logout']),
    handleSubmit (e) {
      this.submitted = true;
      const { email, password } = this;
      if (email && password) {
        this.login({ email, password })
      }
    }
  }
}
</script>

<style scoped>

</style>