<template>
  <div class="mb-5 card-body">
    <div class="grid grid-cols-2 mb-2">
      <div class="grid-col">
        <h3 class="h3">{{ $t('app.team.invite.title') }}</h3>
      </div>
      <div class="grid-col text-end"><i class="fa-solid fa-circle-xmark cursor-pointer" @click="hideInviteForm"></i></div>
    </div>
    <div class="">
      <transition
          appear-active-class="duration-1000 ease-out"
          apear-to-class="opacity-300"

          enter-active-class="duration-500 ease-out"
          enter-from-class="opacity-0"
          enter-to-class="transform opacity-300"

          leave-active-class="duration-500 ease-in"
          leave-from-class="opacity-300"
          leave-to-class="transform opacity-0"

          mode="out-in"

          appear>
        <div class="" v-if="!invite_successfully_processed">
          <div class="items-center justify-content-center">
            <div class="alert-error text-center" v-if="invite_error !== undefined">
              {{ invite_error }}
            </div>
            <form @submit.prevent="handleSubmit" :class="{'animate-shake': invite_error !== undefined}">

              <div class="form-field text-center my-4">
                <label for="user_email" class="mr-3 font-medium">{{ $t('app.team.invite.email') }}</label>
                <input type="email" id="user_email" v-model="email" class="form-input-field" />
              </div>
              <div class="form-field text-center">
                <button class="btn--main" type="submit" v-if="!invite_sending_in_progress">{{ $t('app.team.invite.send') }}</button>
                <button type="submit" class="btn--main--disabled" v-else>
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  {{ $t('app.team.invite.sending') }}
                </button>
              </div>
            </form>
          </div>
        </div>
        <div v-else class="text-center">
          <p class="text-center mb-2">{{ $t('app.team.invite.invite_successfully_sent') }}</p>
          <button class="btn--main" @click="reset">{{ $t('app.team.invite.send_another') }}</button>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: "TeamInvite",
  data() {
      return {
        email: '',
      }
  },
  computed: {
    ...mapState('teamStore', ['invite_successfully_processed', 'invite_sending_in_progress', 'invite_successfully_processed', 'invite_error']),
  },
  methods: {
    ...mapActions('teamStore', ['hideInviteForm', 'sendInvite', 'sendAnother']),
    handleSubmit: function () {
      this.sendInvite({email: this.email})
    },
    reset: function () {
      this.email = "";
      this.sendAnother();
    }
  }
}
</script>

<style scoped>

</style>