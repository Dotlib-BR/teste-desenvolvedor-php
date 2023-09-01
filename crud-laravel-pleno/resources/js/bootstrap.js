const axios = require('axios');
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// const Echo = require('laravel-echo');
// const Pusher = require('pusher-js');
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.VITE_PUSHER_APP_KEY, // Altere para process.env
//     wsHost: process.env.VITE_PUSHER_HOST ?? `ws-${process.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`, // Altere para process.env
//     wsPort: process.env.VITE_PUSHER_PORT ?? 80, // Altere para process.env
//     wssPort: process.env.VITE_PUSHER_PORT ?? 443, // Altere para process.env
//     forceTLS: (process.env.VITE_PUSHER_SCHEME ?? 'https') === 'https', // Altere para process.env
//     enabledTransports: ['ws', 'wss'],
// });
