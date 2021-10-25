import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
const asset = document.querySelector("meta[name='asset']").content;
import bootstrap from 'bootstrap';

createInertiaApp({
  resolve: name => import(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) }).use(plugin);
    app.config.globalProperties.$route = route;
    app.config.globalProperties.$asset = asset;
    app.mount(el)
  },
})