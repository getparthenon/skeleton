<template>
  <div v-if="!loading">

    <form @submit.prevent="send" :disabled="sending">

      <div id="cardInput"></div>

      <div class="mt-3">
        <SubmitButton :in-progress="sending">{{ $t('app.billing.card_form.add_card') }}</SubmitButton>
      </div>
    </form>
  </div>
  <div v-else>
    <LoadingMessage>{{ $t('global.loading_message')}} </LoadingMessage>
  </div>
</template>

<script>
import {stripeservice} from "../../../../services/stripeservice";
import {billingservice} from "../../../../services/billingservice";
import {mapActions} from "vuex";

export default {
  name: "StripeTokenForm",
  data() {
    return {
      loading: true,
      sending: false,
      success: true,
      errors: {

      },
      card: {
      },
      token: '',
      stripe: {}
    }
  },
  mounted() {

    var imported = document.createElement('script');
    imported.src = 'https://js.stripe.com/v3/';
    document.head.appendChild(imported);

    var that = this
    billingservice.getAddCardToken().then(
      tokenResponse => {
        this.stripe = Stripe(tokenResponse.data.api_info);
        this.loading = false
        setTimeout(function () {

          that.card = stripeservice.getCardToken(that.stripe, tokenResponse.data.token)

        }, 100);
        this.token = tokenResponse.data.token
      },
      error => {
        this.sending = false
      }
  )

  },
  methods: {
    ...mapActions('billingStore', ['cardAdded']),
    send: function () {
      this.sending = true;
      var that = this
      stripeservice.sendCard(this.stripe, this.card).then(
        response => {
          var token = response.token.id;
          billingservice.saveToken(token).then(response => {
            var paymentDetails = response.data.payment_details;
            this.cardAdded({paymentDetails});
            that.sending = false
          })
        }
      )

    }
  }
}
</script>

<style scoped>

</style>
