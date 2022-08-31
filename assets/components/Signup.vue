<template>

  <div class="flex items-center justify-center h-screen login">
    <form @submit.prevent="handleSubmit">
      <div class="p-5 form-body">
        <div class="w-full">
          <img src="/images/logo.svg" alt="" class="m-auto" width="450" />
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Signup"
}
</script>

<style scoped>

</style>