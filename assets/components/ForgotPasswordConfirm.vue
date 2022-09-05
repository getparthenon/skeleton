<template>
  <div class="flex items-center justify-center h-screen login">
    <div v-if="loaded">
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
        <form @submit.prevent="handleSubmit" v-if="!password_requested">
          <div class="p-5 form-body">
            <div class="w-full">
              <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
            </div>
            <h1 class="h1 text-center">{{ $t('public.forgot_password_confirm.title') }}</h1>
            <div class="px-5 mt-2 mb-3" v-if="error_info.has_error">
              <div class="alert-error text-center">{{ error_info.message }}</div>
            </div>
            <div class="px-5 mb-3">
              <label class="block mb-1">{{ $t('public.forgot_password_confirm.password') }}</label>
              <input type="text" class="input-field" v-model="password" />
              <span class="block text-red-500" v-if="password_error !== undefined">{{ password_error }}</span>
            </div>
            <div class="px-5">
              <button type="submit" class="btn--main w-full" v-if="!in_progress">{{ $t('public.forgot_password_confirm.reset_button') }}</button>
              <button type="submit" class="btn--main--disabled w-full cursor-not-allowed" v-else>
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ $t('public.forgot_password_confirm.in_progress') }}
              </button>
            </div>
          </div>
        </form>
        <div v-else>
          <div class="p-5 form-body">
            <div class="px-5">
              {{ $t('public.forgot_password_confirm.success_message') }}
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import {userservice} from "../services/userservice";

export default {
  name: "ForgotPasswordConfirm",
  data() {
    return {
      code: "",
      in_progress: false,
      password: "",
      password_error: undefined,
      loaded: false,
      successfully_progress: false,
      error_info: {
        has_error: false,
        message: undefined
      }
    }
  },
  mounted() {
    this.code = this.$route.params.code
    userservice.forgotPasswordCheck(this.code).then(
        form => {
          this.loaded = true
        },
        error => {
          this.$router.push("/login")
        }
    )
  },
  methods: {
    send: function () {
      this.submitted = true;

      if (this.password === "") {
        return
      }

    }
  }
}
</script>

<style scoped>

</style>