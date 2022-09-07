import axios from "axios";
import {handleResponse} from "./utils";

function invite(email) {
    axios.post("/api/user/team/invite", {email})
        .then(handleResponse)
        .then((result) => {
            if (result.data !== undefined && !result.data.success) {
                if (result.data.already_invited) {
                    return Promise.reject("User already invited");
                } else if (result.data.hit_limit) {
                    return Promise.reject("No more invites available");
                } else {
                    return Promise.reject("There was an unexpected error. Please try later.");
                }
            }

            return result;
    });
}

export const teamservice = {
    invite,
};