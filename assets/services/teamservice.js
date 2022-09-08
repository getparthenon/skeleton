import axios from "axios";
import {handleResponse} from "./utils";

function invite(email) {
    return axios.post("/api/user/team/invite", {email})
        .then((response) => {
            const origResponse = response;
            if (response.name === 'AxiosError') {
                response = response.response;
            }
            if (response.data !== undefined && !response.data.success) {
                if (response.data.already_invited) {
                    return Promise.reject("User already invited");
                } else if (response.data.hit_limit) {
                    return Promise.reject("No more invites available");
                } else {
                    return Promise.reject("There was an unexpected error. Please try later.");
                }
            }

            return response;
    });
}

export const teamservice = {
    invite,
};