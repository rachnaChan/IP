import './assets/css/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store';
// import setAuthHeader from './libs/apis/axiosConfig'
import 'bootstrap/dist/js/bootstrap.js'
import 'bootstrap/dist/css/bootstrap.css'
import 'boxicons'
import 'jquery'
import 'popper.js'

const app = createApp(App)

app.use(router)
app.use(store)

app.config.globalProperties.$baseURL = 'http://34.143.149.136:1001'

store.dispatch('setAuthHeaderIfNeeded');

app.mount('#app')

import saveDraftForm from './libs/apis/saveDraftForm';