import axios from "axios";
import {handleResponse} from "./utils";

export const planservice = {
    fetchPlanInfo,
    createCheckout,
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
    return axios.get(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule, {
        headers: {'Content-Type': 'application/json'},
        data: {}
    }).then(handleResponse);
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