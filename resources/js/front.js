import axios from 'axios';
window.axios = axios;


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import '~resources/scss/app.scss';

import.meta.glob([
    '../img/**',
    '../fonts/**'
]);
import {createApp} from 'vue'

import App from './views/App.vue';

createApp(App).mount("#app")
