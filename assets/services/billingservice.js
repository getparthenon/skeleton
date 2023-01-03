import axios from "axios";
import {handleResponse} from "./utils";

function sendAddress(address) {
    return axios.post("/api/billing/address", address).then(handleResponse);
}

function getAddress() {
    return axios.get("/api/billing/address").then(handleResponse)
}

export const billingservice = {
    sendAddress,
    getAddress,
}
