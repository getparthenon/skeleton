<template>
  <div>
    <h3 class="h3 my-5">{{ $t('app.team.pending_invites.title') }}</h3>
    <div class="card-body">
      <table class="w-full">
        <thead>
          <tr>
            <th>{{ $t('app.team.pending_invites.email') }}</th>
            <th>{{ $t('app.team.pending_invites.invited_at') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="sent_invites.length === 0">
            <td colspan="3" class="text-center">{{ $t('app.team.pending_invites.none') }}</td>
          </tr>
          <tr v-for="invite in sent_invites">
            <td>{{ invite.email }}</td>
            <td>{{ invite.created_at }}</td>
            <td class="text-end"><button class="btn--danger">{{ $t('app.team.pending_invites.disable') }}</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: "TeamPendingInvites",
  computed: {
    ...mapState('teamStore', ['sent_invites'])
  }
}
</script>

<style scoped>

</style>