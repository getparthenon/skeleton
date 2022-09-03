<template>

  <div class="flex items-center justify-center h-screen login">
    <form @submit.prevent="handleSubmit">
      <div class="p-5 form-body">
        <div class="w-full">
          <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
        </div>
        <h1 class="h1 text-center">{{ $t('public.forgot_password.title') }}</h1>
        <div class="px-5 mt-2 mb-3" v-if="error_info.has_error">
          <div class="alert-error text-center">{{ error_info.message }}</div>
        </div>
        <div class="px-5 mb-3">
          <label class="block mb-1">{{ $t('public.forgot_password.email') }}</label>
          <input type="text" class="input-field" v-model="email" />
        </div>
        <div class="px-5">
          <button type="submit" class="btn--main w-full" v-if="!in_progress">{{ $t('public.login.login_button') }}</button>
          <button type="submit" class="btn--main--disabled w-full cursor-not-allowed" v-else>
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ $t('public.forgot_password.signing_up') }}
          </button>
        </div>
        <div class="mt-5 px-5 mb-3  text-center">
          <router-link :to="{name: 'public.login'}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">{{ $t('public.forgot_password.login_link') }}</router-link>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "ForgotPassword",
  data() {
    return {
      error_info: {
        has_error: false
      }
    }
  }
}
</script>

<style scoped>

</style>