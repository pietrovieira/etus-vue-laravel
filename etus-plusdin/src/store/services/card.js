import config from "@/config";

import axios from "axios";

const serviceCard = {};

serviceCard.productList = async (page = 0,per_page = 10) => {
    let params = `?page=${page}&per_page=${per_page}`
    const res = await axios.get(`${config.apiUrl}/public/all${params}`);
    return res;
}

serviceCard.findAll = async (page = 0,per_page = 10,name) => {

    let params = `?page=${page}&per_page=${per_page}`
    
    if ( name ){
        params += "&name=" + name;
    }
    
    const res = await axios.get(`${config.apiUrl}/card/findall${params}`);
    return res;
}

serviceCard.findOne = async (id) => {
    const res = await axios.get(`${config.apiUrl}/card/detail/${id}`);
    return res;
}

serviceCard.delete = async (id) => {
    const res = await axios.post(`${config.apiUrl}/card/delete`,{
        id
    });
    return res;
}

serviceCard.create = async (payload) => {
    const formData = new FormData();
    formData.append('id',payload.id);
    formData.append('name',payload.name);
    formData.append('slug',payload.slug);
    formData.append('imagem',payload.imagem);
    formData.append('imagem_uploaded',( payload.imagem_uploaded ? 1 : 0 ));
    formData.append('brand_id',payload.brand_id);
    formData.append('category_id',payload.category_id);
    if ( payload.limit )
        formData.append('limit',payload.limit);
    if ( payload.limit_tax )
        formData.append('limit_tax',payload.limit_tax);
    const res = await axios.post(`${config.apiUrl}/card/create`,formData);
    return res;
}

serviceCard.update = async (payload) => {
    const formData = new FormData();
    formData.append('id',payload.id);
    formData.append('name',payload.name);
    formData.append('slug',payload.slug);
    formData.append('imagem',payload.imagem);
    formData.append('imagem_uploaded',( payload.imagem_uploaded ? 1 : 0 ));
    formData.append('brand_id',payload.brand_id);
    formData.append('category_id',payload.category_id);
    if ( payload.limit )
        formData.append('limit',payload.limit);
    if ( payload.limit_tax )
        formData.append('limit_tax',payload.limit_tax);
    const res = await axios.post(`${config.apiUrl}/card/update`,formData);
    return res;
}

export default serviceCard;