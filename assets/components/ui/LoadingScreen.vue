<template>
  <div v-if="ready">
    <slot name="default"></slot>
  </div>
  <div v-else :class="loadingClass">
    <slot name="loading">
      <LoadingMessage :color="loadingSpinnerColor">{{ loadingMessage }}</LoadingMessage>
    </slot>
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
    loadingMessage: {
      type: String,
      default() {
        return "Loading";
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