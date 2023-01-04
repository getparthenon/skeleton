import axios from "axios";
import {handleResponse} from "./utils";

function sendAddress(address) {
    return axios.post("/api/billing/address", address).then(handleResponse);
}
function saveToken(token) {
    return axios.post("/api/billing/card/token/add", {token}).then(handleResponse);
}

function getAddress() {
    return axios.get("/api/billing/address").then(handleResponse)
}

function getAddCardToken() {
    return axios.get("/api/billing/card/token/start").then(handleResponse)
}

export const billingservice = {
    sendAddress,
    getAddress,
    getAddCardToken,
    saveToken,
}
