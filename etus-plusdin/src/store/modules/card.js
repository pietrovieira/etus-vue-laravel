import Vue from 'vue';
import serviceCard from '../services/card';

const state = {
    list: [],
    page: 0,
    per_page: 10,
    loaded: true,
    edit: null,
}

const getters= {
    getEdit:state=>state.edit,
    getList:state=>state.list,
    getPage:state=>state.page,
    getLoaded:state=>state.loaded,
    getPerPage:state=>state.per_page,
};

const mutations={
    setList(state,payload){
        Vue.set(state,'list',payload)
    },
    setPage(state,payload){
        Vue.set(state,'page',payload)
    },
    setPerPage(state,payload){
        Vue.set(state,'per_page',payload)
    },
    setEdit(state,payload){
        Vue.set(state,'edit',payload)
    },
    setLoaded(state,payload){
        Vue.set(state,'loaded',payload)
    },
}

const actions={
    setLoaded(state,payload){
        context.commit('setLoaded',payload);
    },
    setEdit(context,payload){
        context.commit('setEdit',payload);
    },
    setPage(context,payload){
        context.commit('setPage',payload);
    },
    setPerPage(context,payload){
        context.commit('setPerPage',payload);
    },
    update(context,payload){
        return new Promise((resolve,reject)=>{
            context.commit('setLoaded',false);
            if ( payload.name === null || payload.name === 'null' ){
                delete payload['name'];
            }
            if ( payload.slug === null || payload.slug === 'null' ){
                delete payload['slug'];
            }
            if ( payload.imagem === undefined || payload.imagem === 'undefined' ){
                delete payload['imagem'];
            }
            serviceCard.update(payload)
            .then(response=>{
                context.commit('setLoaded',true);
                resolve(response);
                return;
            })
            .catch(error=>{
                context.commit('setLoaded',true);
                reject(error.response);
                return;
            })            
        })
    },
    create(context,payload){
        return new Promise((resolve,reject)=>{
            context.commit('setLoaded',false);
            if ( payload.name === null && payload.name === 'null' ){
                delete payload['name'];
            }
            if ( payload.slug === null && payload.slug === 'null' ){
                delete payload['slug'];
            }
            if ( payload.imagem === undefined && payload.imagem === 'undefined' ){
                delete payload['imagem'];
            }
            serviceCard.create(payload)
            .then(response=>{
                context.commit('setLoaded',true);
                resolve(response);
                return;
            })
            .catch(error=>{
                context.commit('setLoaded',true);
                reject(error.response);
                return;
            })            
        })
    },
    findOne(context,payload){
        return new Promise((resolve,reject)=>{
            serviceCard.findOne(payload)
            .then(response=>{
                resolve(response);
                return;
            })
            .catch(error=>{
                reject(error.response);
                return;
            })            
        })
    },
    findAll(context,payload){
        return new Promise((resolve,reject)=>{
            serviceCard.findAll(payload)
            .then(response=>{
                context.commit('setList',response.data.data);
                context.commit('setPerPage',response.data.per_page);
                context.commit('setPage',response.data.current_page);
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