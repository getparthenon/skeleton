<template>
  <div>
    <form @submit.prevent="send" :disabled="sending">

      <label class="label">{{ $t('app.billing.card_form.name') }}</label>
      <input type="text" class="form-field" :class="{'form-error': errors.name !== undefined}" v-model="card.name" />
      <span class="error-message" v-if="errors.name" v-for="error in errors.name">{{ error }}</span>

      <label class="label">{{ $t('app.billing.card_form.number') }}</label>
      <input type="number" class="form-field" :class="{'form-error': errors.number !== undefined}" v-model="card.number" />
      <span class="error-message" v-if="errors.number" v-for="error in errors.number">{{ error }}</span>


      <label class="label">{{ $t('app.billing.card_form.exp_month') }}</label>
      <input type="number" class="form-field" :class="{'form-error': errors.exp_month !== undefined}" v-model="card.exp_month" />
      <span class="error-message" v-if="errors.exp_month" v-for="error in errors.exp_month">{{ error }}</span>

      <label class="label">{{ $t('app.billing.card_form.exp_year') }}</label>
      <input type="number" class="form-field" :class="{'form-error': errors.exp_year !== undefined}" v-model="card.exp_year" />
      <span class="error-message" v-if="errors.exp_year" v-for="error in errors.exp_year">{{ error }}</span>

      <label class="label">{{ $t('app.billing.card_form.cvc') }}</label>
      <input type="number" class="form-field" :class="{'form-error': errors.cvc !== undefined}" v-model="card.cvc" />
      <span class="error-message" v-if="errors.cvc" v-for="error in errors.cvc">{{ error }}</span>

      <div class="mt-3">
        <SubmitButton :in-progress="sending">{{ $t('app.billing.card_form.add_card') }}</SubmitButton>
      </div>
    </form>
  </div>
</template>

<script>
import {stripeservice} from "../../../../services/stripeservice";

export default {
  name: "StripeTokenForm",
  data() {
    return {
      sending: false,
      errors: {

      },
      card: {
        name: '',
        number: '',
        cvc: '',
        exp_month: '',
        exp_year: ''
      }
    }
  },
  methods: {
    send: function () {
      this.sending = true;

      stripeservice.getCardToken('', '', this.card).then(response => {
        console.log(response)
      })
    }
  }
}
</script>

<style scoped>

</style>
