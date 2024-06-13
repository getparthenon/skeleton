<template>
  <div class="h-full flex flex-col ">
    <h1 class="page-title">{{ $t('app.plan.main.title') }}</h1>

    <div class="alert-error mt-5" v-if="error_message">
      {{ error_message }}
    </div>

    <div class="my-5 text-end">
      {{ $t('app.plan.main.payment_schedule_label') }}
      <select v-model="paymentSchedule">
        <option value="year">{{ $t('app.plan.main.payment_schedule_year') }}</option>
        <option value="month">{{ $t('app.plan.main.payment_schedule_month') }}</option>
      </select>
    </div>

    <div class="my-5 text-end">
      {{ $t('app.plan.main.currency_label') }}
      <select v-model="currentCurrency">
        <option v-for="currency in currencies">{{currency}}</option>
      </select>
    </div>

    <div class="columns md:flex md:flex-row gap-4 ">
      <div class="column" v-for="(plan, planName) in plans" :class="{'border-2 border-red-500': isCurrentPlan(planName, this.currentCurrency)}">
        <h2 class="h2">{{ plan.name }}</h2>
        <h3 class="text-xl text-red-500" v-if="isCurrentPlan(planName, this.currentCurrency)">{{ $t('app.plan.main.your_current_plan') }}</h3>
        <div class="plan_head_rgt my-3" v-if="plan.prices[paymentSchedule] !== undefined">
          <h4 class="h1">{{ plan.prices[paymentSchedule][currentCurrency].amount }} {{currentCurrency}}<span>/{{ $t('app.plan.main.payment_schedule_'+paymentSchedule) }}</span></h4>
      </div>
      <div class="plans_bdy">
        <h6 class="mb-5">{{ $t('app.plan.main.features') }}:</h6>

        <div class="media" v-for="feature in plan.features">
          <i class="fa fa-check"></i> {{ feature.description }}
        </div>
        <div class="media" v-for="limit in plan.limits">
          <i class="fa fa-check"></i>  {{ limit.limit }} {{ limit.description }}
        </div>
      </div>
      <div class="button-container" v-if="in_progress === false">
        <button class="btn--main block w-full" @click="select(planName, paymentSchedule, plan)" v-if="this.current_plans.length == 0">{{ $t('app.plan.main.select_plan') }}</button>
        <button class="btn--main block w-full" @click="change(planName, paymentSchedule, plan)" v-else-if="!isCurrentPlan(planName, this.currentCurrency) || planSchedule(planName) !== paymentSchedule">{{ $t('app.plan.main.change') }}</button>
        <div v-else>

          <button class="btn--danger w-full mb-2" @click="cancel(planName)"  v-if="in_progress === false">{{ $t('app.plan.main.cancel_button') }}</button>
          <a @click="cancel" class="btn--danger--disabled block text-center "  v-else>
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ $t('app.plan.main.in_progress') }}
          </a>
          <button class="btn--main--disabled w-full" disabled >{{ $t('app.plan.main.selected_plan') }}</button>
        </div>
      </div>
      <div class="button-container" v-else>
        <button class="btn--main--disabled w-full" disabled >
          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          {{ $t('app.plan.main.in_progress') }}</button>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
import { planservice } from "../../services/planservice";
import { stripeservice } from "../../services/stripeservice";
import { transactoncloudservice } from "../../services/transactioncloudservice";
import {toRaw} from "vue";
import currency from "currency.js";

export default {
  name: "Plan.vue",
  data() {
    return {
      loading: false,
      sessionId: undefined,
      plans: [],
      current_plans: [],
      paymentSchedule: "year",
      showYearly: true,
      stripe: {},
      error_message: undefined,
      in_progress: false,
      currentCurrency: 'USD',
      sending: false,
      currencies: [],
    }
  },
  mounted() {
    planservice.fetchPlanInfo().then(response =>{
      this.plans = response.data.plans;
      for (const key in this.plans) {
        var plan = this.plans[key];
        console.log(plan);
        for (const key in plan.prices['year']) {
          if (!this.currencies.includes(key)) {
            this.currencies.push(key)
          }
        }
      }

      if (response.data.current_plans !== null && response.data.current_plans !== undefined) {
        this.current_plans = response.data.current_plans;
      }
      this.provider = response.data.provider;
    })
  },
  methods: {
    displayCurrency: function (value) {
      return currency(value, { fromCents: true }).format({symbol: ''});
    },
    select: function (planName, paymentSchedule, plan) {
       this.in_progress = true;
      planservice.startSubscriptionFromPaymentDetails(planName, paymentSchedule, this.currentCurrency).then(response => {

        const newPlan = plan;
        newPlan.schedule = paymentSchedule;

        this.current_plans.push(newPlan)

        this.in_progress = false;
      }).catch(error => {
        this.in_progress = false;
        if (!error.response) {
          this.error_message = this.$t('app.plan.main.errors.general_error')
          return;
        }

        switch (error.response.data.code) {
          case "320001":
            this.error_message = this.$t('app.plan.main.errors.no_payment_details');
            return;
          case "320006":
            this.error_message = this.$t('app.plan.main.errors.payment_failure', {reason: error.response.data.reason});
            return;
          default:
            this.error_message = this.$t('app.plan.main.errors.general_error')
            return;
        }

      })
    },
    planSchedule: function (planName) {
      for (var i = 0; i < this.current_plans.length; i++) {
        if (this.current_plans[i].name === planName) {
          return this.current_plans[i].schedule;
        }
      }

      return false;
    },
    getSubscriptionId: function (planName) {
      for (var i = 0; i < this.current_plans.length; i++) {
        if (this.current_plans[i].name === planName) {
          return this.current_plans[i].id;
        }
      }

      return false;
    },
    isCurrentPlan: function (planName, currency) {
      for (var i = 0; i < this.current_plans.length; i++) {
        if (this.current_plans[i].name === planName && this.current_plans[i].currency === currency) {
          return true;
        }
      }

      return false;
    },
    change: function (planName, paymentSchedule) {
      this.in_progress = true;

      if (this.current_plans.length === 1) {
        var subscription = this.current_plans[0];
      } else {
        for (var i =0; i < this.current_plans.length; i++) {
          var currentSubscription = this.current_plans[i];

          if (currentSubscription.plan_name === planName) {
            var subscription = currentSubscription;
            break;
          }
        }
      }
      if (subscription === undefined) {
        this.error_message = this.$t('app.plan.main.errors.general_error')
        return;
      }

      planservice.changePlan(subscription.id, planName, paymentSchedule, this.currentCurrency).then(
          response => {
            this.current_plans[i] = response.data.plan;
              this.in_progress = false;
          },
          error => {
              this.error_message = error;
              this.in_progress = false;
          }
      )
    },
    cancel: function (planName) {
      this.in_progress = true;
      const subscriptionId = this.getSubscriptionId(planName);
      planservice.cancel(subscriptionId).then(
          response => {
            this.in_progress = false;

            planservice.fetchPlanInfo().then(response =>{
              this.plans = response.data.plans;
              if (response.data.current_plans !== null && response.data.current_plans !== undefined) {
                this.current_plans = response.data.current_plans;
              }
              this.provider = response.data.provider;
            })
          },
          error => {
            this.error_message = error;
            this.in_progress = false;
          }
      )
    }
  }
}
</script>

<style scoped>
.column {
  @apply w-full md:w-2/6 bg-white rounded-xl grow shadow p-5 relative;
  min-height: 600px;
}
.button-container {
  @apply absolute bottom-0 left-0 mb-3 w-full px-5;
}

.bottom-body {
  @apply mt-5 bg-white rounded-xl shadow p-5;
}
</style>
