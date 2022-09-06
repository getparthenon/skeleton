<template>
  <li>
    <router-link :to="{name: routeName, ...routeOptions}">{{ linkText }}</router-link>
  </li>
</template>

<script>
export default {
  name: "MenuItem",
  props: {
    routeName: {
      type: String,
      required: true,
    },
    linkText: {
      type: String,
      required: true,
    },
    routeOptions: {
      type: Object,
      default() {
        return {};
      }
    },
  }
}
</script>

<style scoped>

</style>