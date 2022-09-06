<template>
  <li>
    <router-link :to="{name: routeName, params: routeParams}">{{ linkTitle }}</router-link>
  </li>
</template>

<script>
export default {
  name: "MenuItem",
  props: {
    routeName: {
      type: String,
      validator(value) {
        return (typeof value === 'string' || value instanceof String) && value.length > 0;
      }
    },
    linkTitle: {
      type: String,
      validator(value) {
        return (typeof value === 'string' || value instanceof String) && value.length > 0;
      }
    },
    routeParams: {
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