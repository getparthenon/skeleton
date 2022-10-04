<template>
  <span>
    <svg class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg> <slot></slot>
  </span>
</template>

<script>
export default {
  name: "LoadingMessage",
  props: {
    height: {
      type: String,
      default() {
        return "20px";
      }
    },
    color: {
      type: String,
      default() {
        return "rgb(255 255 255 / var(--tw-text-opacity))"
      }
    }
  }
}
</script>

<style scoped>
.spinner {
  -webkit-animation: spin-30994d36 1s linear infinite;
  animation: spin-30994d36 1s linear infinite;
  --tw-text-opacity: 1;
  color: v-bind('color');
  height: v-bind('height');
  display: inline;
}


</style>