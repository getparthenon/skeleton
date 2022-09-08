import {teamservice} from "../services/teamservice";

const state = {
    show_invite_form: false,
    invite_sending_in_progress: false,
    invite_successfully_processed: false,
    invite_error: undefined,
}

const actions = {
    showInviteForm({commit}) {
        commit('showInviteFormEnable');
    },
    hideInviteForm({commit}) {
        commit('showInviteFormDisable');
    },
    sendInvite({commit}, {email}) {

        commit('startInviteProcess');

        if (email === "" || email === undefined || email === null) {
            commit('inviteError', 'An email must be provided')
            return;
        }

        teamservice.invite(email).then(
            result => {
                commit('inviteSent');
            },
            error => {
                console.log(error)
                commit('inviteError', error)
            }
        )
    }
}

const mutations = {
    showInviteFormEnable(state) {
        state.show_invite_form = true;
    },
    showInviteFormDisable(state) {
        state.show_invite_form = false;
    },
    startInviteProcess(state) {
        state.invite_sending_in_progress = true;
        state.invite_error = undefined;
    },
    inviteError(state, error) {
        state.invite_sending_in_progress = false;
        state.invite_error = error;
    },
    inviteSent(state) {
        state.invite_error = undefined;
        state.invite_sending_in_progress = false;
        state.invite_successfully_processed = true;
    }
}

export const teamStore = {
    namespaced: true,
    state,
    actions,
    mutations,
}