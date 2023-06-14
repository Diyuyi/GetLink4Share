import './assets/main.css';
import '../node_modules/bootstrap/dist/css/bootstrap.min.css';
import '../node_modules/bootstrap/dist/css/bootstrap-grid.min.css';
import '../node_modules/bootstrap/dist/css/bootstrap-utilities.min.css';
import '../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';
import './static/fontawesome/css/all.min.css';
import axios from 'axios';
window.axios = axios;

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

const app = createApp(App);
app.use(router);
app.mount('body');