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

      <div class="mt-3">
        <button class="btn--main" v-if="!sending_settings">{{ $t('app.user.settings.save') }}</button>
        <button type="submit" class="btn--main--disabled cursor-not-allowed" v-else>
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        {{ $t('app.user.settings.in_progress') }}
      </button>
      </div>
    </form>

    <h2 class="h2 text-slate-500 mt-3 cursor-pointer" @click="show_danger_zone = !show_danger_zone">{{ $t('app.user.settings.danger_zone') }} <i class="fa-solid fa-caret-down" v-if="!show_danger_zone"></i><i class="fa-solid fa-caret-up" v-else></i></h2>

    <form @submit.prevent="changePassword" v-if="show_danger_zone">
      <div class="card-body" >

        <label class="label">{{ $t('app.user.settings.current_password') }}</label>
        <input type="password" class="form-field" v-model="current_password" />
        <span class="error-message" v-if="need_current_password">{{ $t('app.user.settings.need_current_password') }}</span>

        <label class="label">{{ $t('app.user.settings.new_password') }}</label>
        <input type="password" name="password" class="form-field" v-model="new_password" />
        <span class="error-message" v-if="need_new_password">{{ $t('app.user.settings.need_new_password') }}</span>
        <span class="error-message" v-if="need_valid_password">{{ $t('app.user.settings.need_valid_password') }}</span>

        <label class="label">{{ $t('app.user.settings.new_password_again') }}</label>
        <input type="password" class="form-field" v-model="new_password_again" />
        <span class="error-message" v-if="need_passwords_to_match">{{ $t('app.user.settings.need_password_to_match') }}</span>
      </div>
      <div class="mt-3">
        <button class="btn--main" v-if="!sending_password">{{ $t('app.user.settings.change_password') }}</button>
        <button type="submit" class="btn--main--disabled cursor-not-allowed" v-else>
          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          {{ $t('app.user.settings.in_progress') }}
        </button>
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
      loading: false,
      sending_settings: false,
      sending_password: false,
      need_current_password: false,
      need_new_password: false,
      need_passwords_to_match: false,
      need_valid_password: false,
      user: {},
      error_message: undefined,
      alert: undefined,
      errors: {},
      current_password: "",
      new_password: "",
      new_password_again: "",
      show_danger_zone: false,
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
    changePassword: function () {
        var hasErrors = false;
        this.need_current_password = false;
        this.need_new_password = false;
        this.need_valid_password = false;
        this.need_passwords_to_match = false;

        if (this.current_password === "") {
          this.need_current_password = true;
          hasErrors = true;
        }

        if (this.new_password === "") {
          this.need_new_password = true;
          hasErrors = true;
        } else if (this.new_password.length < 8) {
          this.need_valid_password = true;
          hasErrors = true;
        } else if (this.new_password !== this.new_password_again) {
          this.need_passwords_to_match = true;
          hasErrors = true;
        }

        if (hasErrors) {
          return;
        }
        this.sending_password = true;
        userservice.changePassword(this.current_password, this.new_password).then(
            result => {
              this.alert = {
                type: "success",
                message: this.$t("app.user.settings.success_message")
              }
              this.sending_password = false;
            },
            error => {
              this.alert = {
                type: "error",
                message: error,
              }
              this.sending_password = false;
            }
        )
    },
    save: function () {
      this.sending_settings = true;
      userservice.updateSettings(this.user).then(
          user => {
            this.alert = {
              type: "success",
              message: this.$t("app.user.settings.success_message")
            };
            this.sending_settings = false;
          },
          errors => {
            this.errors = errors
            this.alert = {
              type: "error",
              message: this.$t("app.user.settings.error_message")
            };
            this.sending_settings = false;
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