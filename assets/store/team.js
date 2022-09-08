
const state = {
    show_invite_form: false,
}

const actions = {
    showInviteForm({commit}) {
        commit('showInviteFormEnable')
    },
}

const mutations = {
    showInviteFormEnable(state) {
        state.show_invite_form = true;
    }
}

export const teamStore = {
    namespaced: true,
    state,
    actions,
    mutations,
}