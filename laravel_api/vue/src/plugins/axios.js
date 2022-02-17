import Vue from 'vue'
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'
/* axios.defaults.baseURL = 'https://jsonplaceholder.typicode.com/' */

Vue.use({
    install(Vue){
        Vue.prototype.$http = axios
    }
})