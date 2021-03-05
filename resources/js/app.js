require('./bootstrap');

require('moment');

import Vue from 'vue';

import { App, plugin } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import { InertiaProgress } from '@inertiajs/progress';
import store from '@/store';

Vue.mixin({ methods: { route } });
Vue.use(plugin);
Vue.use(InertiaForm);
Vue.use(PortalVue);
InertiaProgress.init();

const app = document.getElementById('app');

new Vue({
    store,
    render: h => h(App, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => {
          try {
            return require(`./Pages/${name}`).default;
          } catch (error) {
            console.log('404 Not Found');
            console.error(error);
          }
        },
      },
    }),
  }).$mount(app)
