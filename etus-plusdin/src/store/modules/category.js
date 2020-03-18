import Vue from 'vue';
import serviceCategory from '../services/category';

const state = {
    list: [],
}

const getters= {
    getList:state=>state.list,
};

const mutations={
    setList(state,payload){
        Vue.set(state,'list',payload)
    },
}

const actions={
    findAll(context,payload){
        return new Promise((resolve,reject)=>{
            serviceCategory.findAll(payload)
            .then(response=>{
                context.commit('setList',response.data);
                resolve(response);
                return;
            })
            .catch(error=>{
                reject(error.response);
                return;
            })            
        })
    }
}

export default{
	namespaced: true,
	state,
	getters,
	mutations,
	actions
}