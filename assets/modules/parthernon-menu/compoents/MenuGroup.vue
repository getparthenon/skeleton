<template>
  <li>
    <div class="">{{ this.props.name }}</div>
    <ul>
      <slot></slot>
    </ul>
  </li>
</template>

<script>
export default {
  name: "MenuGroup"
}
</script>

<style scoped>

</style>