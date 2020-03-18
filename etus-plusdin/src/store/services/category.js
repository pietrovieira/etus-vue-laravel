import config from "@/config";

import axios from "axios";

const serviceCategory = {};

serviceCategory.findAll = async () => {
    const res = await axios.get(`${config.apiUrl}/category/findall`);
    return res;
}

export default serviceCategory;