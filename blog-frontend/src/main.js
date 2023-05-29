import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import Toaster from '@meforma/vue-toaster';
import store from './Store/index';


import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)
app.use(Toaster)
app.use(router)
app.use(store);
app.mount('#app')
