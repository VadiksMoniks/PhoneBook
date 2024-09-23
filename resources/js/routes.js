import { createRouter, createWebHistory } from 'vue-router';
import MainPageComponent from './components/MainPageComponent.vue';
export default createRouter({
    routes: [{
            path: '/test/public/phonebook',
            component: MainPageComponent
        }
    ],

    history: createWebHistory(),
    
});