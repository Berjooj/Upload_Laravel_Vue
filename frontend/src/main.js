import Vue from 'vue';
import App from './App.vue';
import VueRouter from "vue-router";
import HelloWorld from "@/views/HelloWorld";
import UploadArquivo from "@/views/UploadArquivo";
import {BootstrapVue} from 'bootstrap-vue'
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/helloworld',
            component: HelloWorld
        },
        {
            path: '/upload',
            component: UploadArquivo
        },
        {
            path: '/',
            redirect: '/upload'
        }
    ]
});

Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')
