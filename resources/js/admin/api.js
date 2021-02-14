//
// function API () {
//     const url = `http://127.0.0.1:8000/api/`;
//     alert('url')
// }

import axios from "axios";


class API {
    constructor() {
        this.time = new Date().getTime() + '___' + Math.random();
        this.api_url = `http://127.0.0.1:8000/api`;
        this.access_token = false;
    }

    isAuth() {
        const JWT = JSON.parse(window.localStorage.getItem('JWT'));

        if (JWT === null || JWT.toTime < new Date().getTime()) {
            return false;
        } else {
            return true;
        }
    }

    async tryAuth(email, password) {
        try {
            const res = await axios.post(`${this.api_url}/auth/login`, {
                email, password
            });
            const data = res.data;

            let storageData = {
                user: data.user,
                toTime: new Date().getTime() + data.expires_in * 1000,
                access_token: data.access_token
            };

            this.access_token = data.access_token;
            window.localStorage.setItem('JWT', JSON.stringify(storageData));
            return data.user;

        } catch (err) {
            console.log(err);
            return false;
        }

    }

    getToken(){
        const jwt = window.localStorage.getItem('JWT');
        return  JSON.parse(jwt).access_token;
    }

    async get(url) {
        const token = this.getToken();

        try {
            const req = await axios.get(`${this.api_url}${url}`, {
                headers: {
                    Authorization: "Bearer " + token
                }
            });
            return {
                ...req,
                error: false
            };
        } catch (err) {
            return {
                ...err,
                error: true
            };
        }
    }

    async put(url, data) {
        const token = this.getToken();

        try {
            const req = await axios.put(`${this.api_url}${url}`, data, {
                headers: {
                    Authorization: "Bearer " + token
                }
            });
            return {
                ...req,
                error: false
            };
        } catch (err) {
            return {
                ...err,
                error: true
            };
        }

    }

    async post(url, data) {
        const token = this.getToken();

        try {
            const req = await axios.post(`${this.api_url}${url}`, data, {
                headers: {
                    Authorization: "Bearer " + token
                }
            });
            return {
                ...req,
                error: false
            };
        } catch (err) {
            return {
                ...err,
                error: true
            };
        }
    }

    async delete(url) {
        const token = this.getToken();

        try {
            const req = await axios.delete(`${this.api_url}${url}`, {
                headers: {
                    Authorization: "Bearer " + token
                }
            });
            return {
                ...req,
                error: false
            };
        } catch (err) {
            return {
                ...err,
                error: true
            };
        }
    }

}

export default API;
