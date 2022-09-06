<template>
  <div>
    <ul :class="listClass">
      <slot></slot>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Menu",
  props: {
    listClass: {
      type: [String, Object],
      default() {
        return "menu-list";
      }
    }
  }
}
</script>

<style scoped>

</style>