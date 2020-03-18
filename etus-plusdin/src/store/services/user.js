import config from "@/config";

import axios from "axios";

const serviceUser = {};

serviceUser.auth = async (payload) => {
    const res = await axios.post(`${config.apiUrl}/auth/login`,payload);
    if ( res.status === 200 ){
        axios.defaults.headers.common = {'Authorization': `Bearer ${res.data.access_token}`};
    }
    return res;
}

serviceUser.validate = async () => {
    const res = await axios.post(`${config.apiUrl}/auth/validate`);
    return res;
}

serviceUser.logout = async (payload) => {
    const res = await axios.post(`${config.apiUrl}/auth/logout`,payload);
    return res;
}

export default serviceUser;