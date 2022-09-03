import { router } from "../helpers/router";
import { userservice } from "../services/userservice";

const state = {
    logged_in: (user === null),
    status: null,
    error_info: {
        has_error: false,
        message: undefined,
    },
    redirect_page: undefined,
    in_progress: false,
}

const actions = {
    login({ dispatch, commit }, { username, password }) {
        console.log(username)

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
        state.in_progress = true;
        state.user = user;
        state.error_info = {
            has_error: false,
            message: undefined,
        }
    },
    loginSuccess(state, user) {
        state.in_progress = false;
        state.status = { loggedIn: true };
        state.user = user;
    },
    loginFailure(state, error) {
        state.in_progress = false;
        state.status = {error: true};
        state.error_info = {
            has_error: true,
            message: error
        }
        state.user = null;
    },
};

export const user = {
    namespaced: true,
    state,
    actions,
    mutations
};