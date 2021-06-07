require("./bootstrap");
require("alpinejs");
window.DateTime = require("luxon").DateTime;
window.VueCookies = require("vue-cookies");

import Vue from "vue";
import App from "./vue/app";

Vue.use(VueCookies);

const app = new Vue({
    el: "#app",
    components: {
        App,
    },
});
