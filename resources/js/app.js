require("./bootstrap");
require("alpinejs");
window.DateTime = require("luxon").DateTime;
window.VueCookies = require("vue-cookies");
window.Vue = require("vue").default;
Vue.use(VueCookies);

// Register Vue Components
Vue.component("transaction-component", require("./components/TransactionComponent.vue").default);

// Initialize Vue
const app = new Vue({
    el: "#app",
});
