<template>
  <div>
    <h1 class="page-title">{{ $t('app.user.settings.title') }}</h1>

    <div v-if="alert !== undefined" class="mt-5" :class="{'alert-error': alert.type==='error','alert-success': alert.type==='success'}">
      {{ alert.message }}
    </div>

    <form @submit.prevent="save">

      <div class="mt-5 card-body">
        <label class="label">{{ $t('app.user.settings.name') }}</label>
        <input type="text" class="form-field" :class="{'form-error': errors.name !== undefined}" v-model="user.name" />
        <span class="error-message" v-if="errors.name" v-for="error in errors.name">{{ error }}</span>

        <label class="label">{{ $t('app.user.settings.email') }}</label>
        <input type="text" class="form-field"  :class="{'form-error': errors.email !== undefined}"  v-model="user.email" />
        <span class="error-message" v-if="errors.email" v-for="error in errors.email">{{ error }}</span>

      </div>

      <div class="mt-5">
        <button class="btn--main">{{ $t('app.user.settings.save') }}</button>
      </div>
    </form>
  </div>
</template>

<script>
import {userservice} from "../../../services/userservice";

export default {
  name: "UserSettings",
  data() {
    return {
      user: {},
      error_message: undefined,
      alert: undefined,
      errors: {}
    }
  },
  mounted() {
    userservice.fetchSettings().then(
        user => {
          this.user = user;
        }
    )
  },
  methods: {
    save: function () {
      userservice.updateSettings(this.user).then(
          user => {
            this.alert = {
              type: "success",
              message: this.$t("app.user.settings.success_message")
            }
          },
          errors => {
            this.errors = errors
            this.alert = {
              type: "error",
              message: this.$t("app.user.settings.error_message")
            }
          }
      )
    }
  }
}
</script>

<style scoped>
.label {
  @apply block text-gray-700 font-medium mt-2;
}

.form-error {
  @apply border-red-500 border-2 bg-red-100 !important;
}

.form-field {
  @apply border border-slate-400 p-2 rounded-lg;
}
.error-message {
  @apply block text-red-500;
}
</style>