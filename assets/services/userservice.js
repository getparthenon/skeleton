import axios from "axios";

const login = function (username, password) {
    const payload = {
        username,
        password
    };

    return axios.post("/api/authenticate", payload).then(response => {
        if (response.status !== 200) {
            const data = response.response.data;
            const error = (data && data.message) || data.error || data.errors || response.statusText;
            return Promise.reject(error);
        }
    })
}
function signup(user, code) {

    var url
    if (code === undefined) {
        url = `/api/user/signup`
    } else {
        url = '/api/user/signup/'+code
    }


    return axios.post(url, user).then(response => {
        if (response.status < 200 || response.status > 299) {
            const data = response.response.data;
            const error = (data && data.message) || data.error || data.errors || response.statusText;
            return Promise.reject(error);
        }
        return response;
    });
}


export const userservice = {
    login,
    signup,
};