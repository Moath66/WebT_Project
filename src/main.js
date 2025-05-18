import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// 🔥 Import Toastification
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

// ✅ Use toast globally
app.use(Toast);
app.use(router);
app.mount("#app");
