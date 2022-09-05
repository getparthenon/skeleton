<template>
  <div class="lg:flex  main-background">
    <div class="flex flex-col lg:w-80 sticky top-0 left-0 lg:h-screen px-4 py-8 overflow-y-auto lg:shadow-md menu-background">
    </div>
    <div class="w-full h-full lg:p-4 lg:m-8 p-2 overflow-y-auto">
      <router-view></router-view>
    </div>
  </div>

</template>

<script>
export default {
  name: "InternalApp"
}
</script>

<style scoped>

</style>