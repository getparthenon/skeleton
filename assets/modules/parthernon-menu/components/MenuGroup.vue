<template>
  <li>
    <div :class="titleClass">{{ name }}</div>
    <ul :class="listClass">
      <slot></slot>
    </ul>
  </li>
</template>

<script>
export default {
  name: "MenuGroup",
  props: {
    name: {
      type: String,
      required: true,
    },
    titleClass: {
      type: [String, Object],
      default() {
        return "menu-group-title";
      }
    },
    listClass: {
      type: [String, Object],
      default() {
        return "menu-group-list";
      }
    }
  }
}
</script>

<style scoped>

</style>