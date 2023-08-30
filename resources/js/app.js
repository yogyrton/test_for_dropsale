import('./bootstrap');

import { createApp } from "vue/dist/vue.esm-bundler";

import App from './src/App.vue'

const app = createApp(App)

app.mount("#app")
