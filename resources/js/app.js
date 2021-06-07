require("./bootstrap");
require("alpinejs");
window.DateTime = require("luxon").DateTime;
window.VueCookies = require("vue-cookies");

// window.Vue = require("vue").default;

// Register Vue Components
// Vue.component("dashboard-component", require("./components/DashboardComponent.vue").default);

import Vue from "vue";
import App from "./vue/app";

Vue.use(VueCookies);

// Initialize Vue
const app = new Vue({
    el: "#app",
    components: {
        App,
    },
});
