<template>
  <div>
    <ul>
      <li v-for="paymentDetail in paymentDetails">
        <div>
          **** **** **** {{ paymentDetail.lastFour }}
        </div>
      </li>
    </ul>
    <StripeTokenForm />
  </div>
</template>

<script>
import StripeTokenForm from "./Stripe/StripeTokenForm";
import {billingservice} from "../../../services/billingservice";
export default {
  name: "BillingMethods",
  components: {StripeTokenForm},
  data() {
    return {
      paymentDetails: [],
    }
  },
  mounted() {
    billingservice.getPaymentDetails().then(response => {
        this.paymentDetails = response.data.payment_details;
    })
  }
}
</script>

<style scoped>

</style>
