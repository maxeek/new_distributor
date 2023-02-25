require('./bootstrap')

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import InlineSvg from 'vue-inline-svg'
import ElementPlus from 'element-plus'
import Swal from 'sweetalert2'

import 'element-plus/dist/index.css'

window.Swal = Swal

const appName =
  window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => require(`@/Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ElementPlus)
      .mixin({
        methods: { route },
        components: {
          Link,
          Head,
          InlineSvg,
        },
      })
      .mount(el)
  },
})

InertiaProgress.init({ color: '#4B5563' })
