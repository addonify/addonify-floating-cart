import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router/index.js'

/**
*  Instantiate pinia.
*
* @since 1.0.0
*/
const pinia = createPinia()
const app = createApp(App);

/**
* App use.
*
* @since 1.0.0
*/
app.use(pinia)
app.use(router)

/**
* Mount the app.
*
* @since 1.0.0
*/
app.mount("#___adfy-floatingcart-app___");