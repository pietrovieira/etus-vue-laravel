import Vue from 'vue';
import serviceCard from '../services/card';

const state = {
    list: [],
    page: 0,
    per_page: 10,
    loaded: true,
    detail: null,
}

const getters= {
    getDetail:state=>state.detail,
    getList:state=>state.list,
    getPage:state=>state.page,
    getLoaded:state=>state.loaded,
    getPerPage:state=>state.per_page,
};

const mutations={
    setList(state,payload){
        Vue.set(state,'list',payload)
    },
    addList(state,payload){
        let _list = state.list;
        payload.forEach(value => {
            _list.push(value);
        });
        Vue.set(state,'list',_list);
    },
    setPage(state,payload){
        Vue.set(state,'page',payload)
    },
    setPerPage(state,payload){
        Vue.set(state,'per_page',payload)
    },
    setDetail(state,payload){
        Vue.set(state,'detail',payload)
    },
    setLoaded(state,payload){
        Vue.set(state,'loaded',payload)
    },
    nextPage(state,payload){
        let newPage = parseInt(payload) + 1;
        Vue.set(state,'page',newPage)
    },
    
}

const actions={
    setPage(context,payload){
        context.commit('setPage',payload);
    },
    setList(context,payload){
        context.commit('setList',payload);
    },
    findAll(context,payload){
        return new Promise((resolve,reject)=>{
            serviceCard.productList(payload)
            .then(response=>{
                if ( response.data.data.length > 0 )
                {
                    context.commit('addList',response.data.data);
                    context.commit('setPerPage',response.data.per_page);
                    context.commit('nextPage',response.data.current_page);
                }
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