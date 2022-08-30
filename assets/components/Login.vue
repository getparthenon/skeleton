<template>
  <div class="flex items-center justify-center h-screen login">
    <div class="p-5 form-body">
      <div class="w-full">
        <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
      </div>
      <h1 class="h1 text-center">{{ $t('login.title') }}</h1>
      <div class="px-5 mb-3">
        <label class="block mb-1">{{ $t('login.email') }}</label>
        <input type="text" class="field" />
      </div>
      <div class="px-5 mb-3">
        <label class="block mb-1">{{ $t('login.password') }}</label>
        <input type="password" class="field" />
      </div>
      <div class="px-5 mb-3 flex items-center justify-between">
        <div class="flex items-start">
          <div class="flex items-center h-5">
            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
          </div>
          <div class="ml-3 text-sm">
            <label for="remember" class="text-black dark:text-white">Remember me</label>
          </div>
        </div>
        <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
      </div>
      <div class="px-5">
        <button class="btn--main w-full">{{ $t('login.login_button') }}</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login"
}
</script>

<style scoped>
.field {
  @apply bg-transparent rounded-lg text-slate-600 font-medium w-full backdrop-blur-lg;
  border-color: silver!important;
}

.login {
  background-color: #368aca;
  background-image: linear-gradient(160deg, #368aca 0%, #c2dcef 100%);
}

.form-body {
  @apply rounded-xl w-full md:max-w-screen-sm;
  background: rgba(255, 255, 255, 0.2);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  border: 1px solid rgba(255, 255, 255, 0.3);

  animation: fadeIn 1s;
}
</style>