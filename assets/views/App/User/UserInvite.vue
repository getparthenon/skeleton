<template>
  <div>
    <h1 class="page-title">{{ $t('app.user.invite.title') }}</h1>

    <div v-if="alert !== undefined" class="mt-5" :class="{'alert-error': alert.type==='error','alert-success': alert.type==='success'}">
      {{ alert.message }}
    </div>

    <form @submit.prevent="send">
      <div class="mt-3 card-body">
        <label class="label">{{ $t('app.user.invite.email') }}</label>
        <input type="email" class="form-field"  :class="{'form-error': errors.email !== undefined}"  v-model="email" />
        <span class="error-message" v-if="errors.email" v-for="error in errors.email">{{ error }}</span>
      </div>

      <div class="mt-3">
        <button class="btn--main" v-if="!sending_invite">{{ $t('app.user.invite.send') }}</button>
        <button type="submit" class="btn--main--disabled cursor-not-allowed" v-else>
          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          {{ $t('app.user.invite.in_progress') }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import {userservice} from "../../../services/userservice";

export default {
  name: "UserInvite",
  data() {
    return {
      email: "",
      sending_invite: false,
      alert: undefined,
      errors: {},
    }
  },
  methods: {
    send: function () {
      this.errors = {};
      this.alert = undefined;

      if (this.email === "") {
        this.errors = {email: [this.$t('app.user.invite.need_email')]}
        return;
      }

      this.sending_invite = true;

      userservice.invite(this.email).then(
          result => {
            this.alert = {
              type: "success",
              message: this.$t("app.user.invite.success_message")
            }
            this.sending_invite = false;
          },
          errors => {
            this.errors = errors
            this.alert = {
              type: "error",
              message: this.$t("app.user.invite.error_message")
            };
            this.sending_invite = false;
          }
      )
    }
  }
}
</script>

<style scoped>

</style>