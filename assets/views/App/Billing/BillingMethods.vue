<template>
  <div>
    <StripeTokenForm />
  </div>
</template>

<script>
import StripeTokenForm from "./Stripe/StripeTokenForm";
export default {
  name: "BillingMethods",
  components: {StripeTokenForm},
  mounted() {
  }
}
</script>

<style scoped>

</style>
