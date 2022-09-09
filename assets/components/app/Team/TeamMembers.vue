<template>
  <div class="card-body">

    <table class="w-full">
      <thead>
        <tr>
          <th>{{ $t('app.team.members.email') }}</th>
          <th>{{ $t('app.team.members.created_at') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="members.length == 0">
          <td colspan="3" class="text-center">{{ $t('app.team.members.no_members') }}</td>
        </tr>
        <tr v-for="member in members">
          <td>{{ member.email }}</td>
          <td>{{ member.created_at }}</td>
          <td>
            <span class="badge--green" v-if="!member.is_deleted">{{ $t('app.team.members.active') }}</span>
            <span class="badge--red" v-else>{{ $t('app.team.members.disabled') }}</span>
          </td>
          <td v-if="member.id !== user.id && !member.is_deleted" class="text-end">
            <button v-if="(current_member !== undefined && current_member.id !== member.id) || !disable_member_in_progress" class="btn--danger" :class="{'btn--danger--disabled': disable_member_in_progress}" :disabled="disable_member_in_progress" @click="disableMember({member})">
              {{ $t('app.team.members.disable') }}
            </button>
            <button class="btn--danger--disabled" disabled v-else>
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ $t('app.team.members.disabling') }}
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: "TeamMembers",
  computed: {
    ...mapState('userStore', ['user']),
    ...mapState('teamStore', ['members', 'current_member', 'disable_member_in_progress'])
  },
  methods: {
    ...mapActions('teamStore', ['disableMember'])
  }
}
</script>

<style scoped>

</style>