<template>
  <li :class="itemClass">
    <router-link :to="{name: routeName, ...routeOptions}" :class="linkClass"><slot></slot></router-link>
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
    routeOptions: {
      type: Object,
      default() {
        return {};
      }
    },
    linkClass: {
      type: [String, Object],
      default() {
        return "menu-link";
      }
    },
    itemClass: {
      type: [String, Object],
      default() {
        return "menu-item";
      }
    },
  }
}
</script>

<style scoped>

</style>