import Vue from 'vue';
import serviceUser from '../services/user';

const state = {
    logged: false,
    access_token: null,
    profile: {
        "id": null,
        "username": null,
        "fullName": null
    }
}

const getters= {
    getAccessToken:state=>state.access_token,
    getProfile:state=>state.profile,
    getLogged:state=>state.logged,
};

const mutations={
    setProfile(state,payload){
        Vue.set(state,'profile',payload)
    },
    setAccessToken(state,payload){
        Vue.set(state,'access_token',payload)
    },
    setLogged(state,payload){
        Vue.set(state,'logged',payload)
    },
}

const actions={
    setLogged(context,payload){
        context.commit('setLogged',payload);
    },
    setProfile(context,payload){
        context.commit('setProfile',payload);
    },
    logout(context,payload){
        return new Promise((resolve,reject)=>{
            serviceUser.logout(payload)
            .then(response=>{
                context.commit('setLogged',false);
                context.commit('setAccessToken',null);
                context.commit('setProfile',{
                    "id": null,
                    "username": null,
                    "fullName": null
                });
                resolve(response);
                return;
            })
            .catch(error=>{
                context.commit('setLogged',false);
                context.commit('setAccessToken',null);
                context.commit('setProfile',{
                    "id": null,
                    "username": null,
                    "fullName": null
                });
                reject(error.response);
                return;
            })            
        })
    },
    auth(context,payload){
        return new Promise((resolve,reject)=>{
            serviceUser.auth(payload)
            .then(response=>{
                context.commit('setLogged',true);
                context.commit('setAccessToken',response.data.access_token);
                context.commit('setProfile',{
                    "id": null,
                    "username": null,
                    "fullName": null
                });
                resolve(response);
                return;
            })
            .catch(error=>{
                context.commit('setLogged',false);
                context.commit('setAccessToken',null);
                context.commit('setProfile',{
                    "id": null,
                    "username": null,
                    "fullName": null
                });
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