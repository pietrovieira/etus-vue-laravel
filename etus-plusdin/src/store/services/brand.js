import config from "@/config";

import axios from "axios";

const serviceBrand = {};

serviceBrand.findAll = async () => {
    const res = await axios.get(`${config.apiUrl}/brand/findall`);
    return res;
}

export default serviceBrand;