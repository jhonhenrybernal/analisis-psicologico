import Vue from "vue"
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

/**
 * @author Jhon Bernal
 * @description Oyente de transporte de informacion por ayuda de vuex
 * @tutorial https://vuex.vuejs.org/
 */
export default new Vuex.Store({

  state: {
    status: '',
    token: localStorage.getItem('token') || '',
    user : {},
    error : '',
  },
  values:{
    data:''
  },
  mutations: {
    auth_request(state){
      state.status = 'loading'
    },
    auth_success(state, token){
      state.status = 'success'
      state.token = token
      state.isLoggedIn = true;
    },
    set_user(state,user){
      state.user = user
    },
    handle_error(state,error){
      state.error = error
    },
    logout(state){
      state.status = ''
      state.token = ''
      state.isLoggedIn = false;
    },

    set_patient(values,patient){
      values.data = patient
    },

    set_status(values,status){
      values.data = status
    },

    set_patient(values,status){
      values.data = status
    },
    set_assessments(values,status){
      values.data = status
    },
    set_images(values,status){
      values.data = status
    }
  },
  actions: {
    login({commit}, user){
        return new Promise((resolve, reject) => {
          commit('auth_request')
          axios({url: 'login', data: user, method: 'POST' })
          .then(resp => {
            const token = 'Bearer '+resp.data.access_token
            const user = resp.data.user
            localStorage.setItem('token', token)
            axios.defaults.headers.common['Authorization'] = token
            commit('auth_success', token, user)
            commit('set_user',user)
            commit('handle_error', '')
            resolve(resp)
          })
          .catch(err => {
            localStorage.removeItem('token')
            reject(err)
          })
        })
    },
    Register({commit}, user){
      return new Promise((resolve, reject) => {
        commit('auth_request')
        axios({url: 'register', data: user, method: 'POST' })
        .then(resp => {
          const token = 'Bearer '+resp.data.access_token
          const user = resp.data.user
          localStorage.setItem('token', token)
          axios.defaults.headers.common['Authorization'] = token
          commit('auth_success', token, user)
          commit('handle_error', '')
          resolve(resp)
        })
        .catch(error => {
          localStorage.removeItem('token')
          reject(error)
        })
      })
    },
    logout({commit}){
      return new Promise((resolve, reject) => {
        commit('logout')
        localStorage.removeItem('token')
        delete axios.defaults.headers.common['Authorization']
        resolve()
      })
    },

    getUser({commit}){
      return new Promise((resolve, reject) => {
        axios({url:'user',method:'GET'}).then(res =>{
          commit('set_user',res.data)
          resolve(res)
        })
      }); 
    },
    getPatients({commit}){
      return new Promise((resolve, reject) => {
        axios({url:'patients',method:'GET'}).then(res =>{
          commit('set_patient',res.data)
          resolve(res)
        })
      }); 
    },
    getStatus({commit}){
      return new Promise((resolve, reject) => {
        axios({url:'status',method:'GET'}).then(res =>{
          commit('set_status',res.data)
          resolve(res)
        })
      }); 
    },
    getProcessPatient({commit},data){
      return new Promise((resolve, reject) => {
        axios({url: 'assessments/access/patients', data: data, method: 'POST' })
        .then(resp => {
          commit('set_patient', resp.data)
          resolve(resp)
        })
        .catch(err => {
          reject(err)
        })
      })
    },
    getAssessments({commit},data){
      return new Promise((resolve, reject) => {
        axios({url:'assessments',method:'GET'}).then(res =>{
          commit('set_assessments',res.data)
          resolve(res)
        })
      }); 
    },
    getImages({commit}){
      return new Promise((resolve, reject) => {
        axios({url:'imagesAssessment',method:'GET'}).then(res =>{
          commit('set_images',res.data)
          resolve(res)
        })
      }); 
    }
  },
  getters : {
    getImages: values => values.data,
    getAssessments: values => values.data,
    getStatus: values => values.data,
    getProcessPatient: values => values.data,
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    getUser: state=> state.user,
    getError: state=> state.error
  }
})