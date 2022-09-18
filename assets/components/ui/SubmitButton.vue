<template>
  <button type="submit" :class="buttonClass" v-if="!inProgress">
    <slot name="default">Submit</slot>
  </button>
  <button type="submit" class="btn--disabled" :class="buttonClass" v-else>
    <slot name="loading">
      <LoadingMessage>{{ loadingText }}</LoadingMessage>
    </slot>
  </button>
</template>

<script>
import LoadingMessage from "./LoadingMessage.vue";
export default {
  name: "SubmitButton",
  components: {LoadingMessage},
  props: {
    buttonClass: {
      type: String,
      default() {
        return "btn--main"
      }
    },
    inProgress: {
      type: Boolean,
      required: true,
      default() {
        return false;
      }
    },
    loadingText: {
      type: String,
      default() {
        return "In Progress";
      }
    }
  }
}
</script>

<style scoped>
.btn--disabled {
  opacity: 50%;
  cursor: not-allowed;
}
</style>