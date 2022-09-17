<template>
  <div v-if="ready">
    <slot name="content"></slot>
  </div>
  <div v-else :class="loadingClass">
    <LoadingMessage :color="loadingSpinnerColor"><slot name="message"></slot></LoadingMessage>
  </div>
</template>

<script>
import LoadingMessage from "./LoadingMessage.vue";
export default {
  name: "LoadingScreen",
  components: {LoadingMessage},
  props: {
    ready: {
      type: Boolean,
      required: true
    },
    loadingSpinnerColor: {
      type: String,
      default() {
        return "black";
      }
    },
    loadingClass: {
      type: String,
      default() {
        return "loading-message"
      }
    }
  }
}
</script>

<style scoped>
.loading-message {
  display: flex;
  height: 100vh;
  align-items: center;
  justify-content: center;
}

</style>