import axios from "axios";

const login = function (username, password) {
    const payload = {
        username,
        password
    };

    return axios.post("/api/authenticate", payload).then(response => {
        if (response.status !== 200) {
            const data = response.data;
            const error = (data && data.message) || data.errors || response.statusText;
            return Promise.reject(error);
        }
    })
}


export const userservice = {
    login,
};