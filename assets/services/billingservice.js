import axios from "axios";
import {handleResponse} from "./utils";

function sendAddress(address) {
    return axios.post("/api/billing/details", address).then(handleResponse);
}
function saveToken(token) {
    return axios.post("/api/billing/payment-method/token/add", {token}).then(handleResponse);
}

function getAddress() {
    return axios.get("/api/billing/details").then(handleResponse);
}

function getAddCardToken() {
    return axios.get("/api/billing/payment-method/token/start").then(handleResponse);
}

function getPaymentDetails() {
    return axios.get("/api/billing/payment-method").then(handleResponse);
}

function deletePaymentDetails(id) {
    return axios.delete("/api/billing/payment-method/"+id).then(handleResponse);
}

export const billingservice = {
    sendAddress,
    getAddress,
    getAddCardToken,
    saveToken,
    getPaymentDetails,
    deletePaymentDetails,
}
