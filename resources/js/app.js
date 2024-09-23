import { createApp } from 'vue';
import MainComponent from './components/MainComponent.vue';

import router from './routes.js';

const app = createApp({

});

app.component('main-component', MainComponent);

app.use(router);
app.mount('#app');
