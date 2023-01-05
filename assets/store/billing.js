import {teamservice} from "../services/teamservice";
import {billingservice} from "../services/billingservice";

const state = {
    show_add_card_form: false,
    paymentDetails: [],
};

const actions = {
    addCard({commit}) {
        commit('enableForm')
    },
    resetForm({commit}) {
        commit('hideForm')
    },
    fetchPaymentMethods({commit}) {
        billingservice.getPaymentDetails().then(response => {
            commit('setPaymentDetails', response.data.payment_details);
        })
    },
    cardAdded({commit}, {paymentDetails}) {
        commit('hideForm');
        commit('addNewCard', paymentDetails);
    }
};

const mutations = {
    enableForm(state) {
      state.show_add_card_form = true;
    },
    hideForm(state) {
        state.show_add_card_form = false;
    },
    setPaymentDetails(state, paymentDetails) {
        state.paymentDetails = paymentDetails;
    },
    addNewCard(state, paymentDetail) {
        state.paymentDetails.push(paymentDetail)
    }
};
export const billingStore = {
    namespaced: true,
    state,
    actions,
    mutations,
}
