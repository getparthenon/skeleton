<template>
  <div>
    <h1 class="page-title">{{ $t('app.plan.main.title') }}</h1>

  </div>
</template>

<script>
import { StripeCheckout } from '@vue-stripe/vue-stripe';

export default {
  name: "Plan.vue",
  data() {
    return {
      loading: false,
      sessionId: undefined,
    }
  }
}
</script>

<style scoped>

</style>