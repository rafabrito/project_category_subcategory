import { createApp } from "vue";
// import { BootstrapVue } from 'bootstrap-vue';
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome"; 
import {library} from '@fortawesome/fontawesome-svg-core';
import {fas} from '@fortawesome/free-solid-svg-icons';
import router from "./router/index";
import App from "./App.vue";


library.add(fas); // disponibilizar em toda aplicação icones fontawesome como componete

createApp(App).use(router).component('fa', FontAwesomeIcon).mount("#app");
