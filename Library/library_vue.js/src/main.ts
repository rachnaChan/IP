import { createApp } from 'vue'
import App from './App.vue'
import { createPinia } from 'pinia'
import router from './router'
import store from './store'

import 'bootstrap/dist/js/bootstrap.js'
import 'bootstrap/dist/css/bootstrap.css'
import 'boxicons'
import 'jquery'
import 'popper.js'
const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(store)

store.dispatch('setAuthHeaderIfNeeded');

app.mount("#app")
