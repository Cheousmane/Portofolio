import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import Lenis from 'lenis';

NProgress.configure({ showSpinner: false, speed: 300, minimum: 0.1 });

const lenis = new Lenis({ duration: 1.2, easing: (t) => 1 - Math.pow(1 - t, 3), wheelMultiplier: 1 });
function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
requestAnimationFrame(raf);

createInertiaApp({
    title: (title) => (title ? `${title} — SID-TECH` : 'Ousmane Mohamed Sidibe — SID-TECH'),
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: false,
});

document.addEventListener('inertia:start', () => NProgress.start());
document.addEventListener('inertia:progress', (event) => NProgress.set(event.detail.progress / 100));
document.addEventListener('inertia:finish', () => NProgress.done());

const saved = localStorage.getItem('theme');
if (saved === 'dark') document.documentElement.setAttribute('data-theme', 'dark');
