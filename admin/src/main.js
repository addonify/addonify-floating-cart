import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import Vue3ColorPicker from "vue3-colorpicker";
import "vue3-colorpicker/style.css";

const pinia = createPinia()
const app = createApp(App);
app.use(pinia)
app.use(router)
app.use(Vue3ColorPicker)
app.mount("#___adfy-floating-cart-app___");