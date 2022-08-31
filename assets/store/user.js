import { router } from "../helpers/router";
import { userservice } from "../services/userservice";

const state = {
    logged_in: (user === null),
    status: null,
    error_info: {
        message: null,
    },
    redirect_page: undefined,
}

const actions = {
    login({ dispatch, commit }, { username, password }) {
        commit('loginRequest', { username });

        userservice.login(username, password)
            .then(
                user => {
                    commit('loginSuccess', user);

                    const url = localStorage.getItem('app_redirect')
                    if (url === null) {
                        router.push('/app/home');
                    } else {
                        localStorage.removeItem('app_redirect')
                        router.push(url)
                    }
                },
                error => {
                    console.log(error);
                    commit('loginFailure', error);
                }
            );
    },
    logout({ commit }) {
        commit('logout');
    },
    signup({ dispatch, commit }, user) {
        commit('signupRequest', user);

    }
};

const mutations = {
    loginRequest(state, user) {
        state.status = { loggingIn: true };
        state.user = user;
    },
    loginSuccess(state, user) {
        state.status = { loggedIn: true };
        state.user = user;
    },
    loginFailure(state, error) {
        state.status = {error: true};
        state.user = null;
    },
};

export const user = {
    namespaced: true,
    state,
    actions,
    mutations
};