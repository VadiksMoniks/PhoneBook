import { createRouter, createWebHistory } from 'vue-router';
import MainPageComponent from './components/MainPageComponent.vue';
export default createRouter({
    routes: [{
            path: '/PhoneBookPackage/public/',
            component: MainPageComponent
        }
    ],

    history: createWebHistory(),
    
});