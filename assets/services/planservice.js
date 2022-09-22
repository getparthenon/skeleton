import axios from "axios";
import {handleResponse} from "./utils";

export const planservice = {
    fetchPlanInfo,
    createCheckout,
    createPerSeatCheckout,
    changePlan,
    cancel
};


function fetchPlanInfo() {
    return axios.get(`/api/payments/plans`, {
        headers: {'Content-Type': 'application/json'},
        data: {}
    }).then(handleResponse);
}

function createCheckout(planName, paymentSchedule) {
    return axios.post(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule, {}, {
        headers: {'Content-Type': 'application/json'},
    }).then(handleResponse);
}

function createPerSeatCheckout(planName, paymentSchedule, seats) {
    return axios.post(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule, {seats})
        .then(handleResponse);
}

function changePlan(planName, paymentSchedule) {
    return axios.post(`/api/payments/plans/change/` + planName + '/' + paymentSchedule, {
        headers: {'Content-Type': 'application/json'},
        data: {}
    }).then(handleResponse);
}


function cancel() {
    return axios.post(`/api/payments/cancel`, {}).then(handleResponse);
}