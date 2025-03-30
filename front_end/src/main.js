import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";
import jquery from 'jquery';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome"; 
import {library} from '@fortawesome/fontawesome-svg-core';
import {fas} from '@fortawesome/free-solid-svg-icons';
import router from "./router/index";
import App from "./App.vue";

window.$ = window.jQuery = jquery; // disponibilizar jquery através da variável window.$

library.add(fas); // disponibilizar em toda aplicação icones fontawesome como componete

createApp(App).use(router).component('fa', FontAwesomeIcon).mount("#app");
