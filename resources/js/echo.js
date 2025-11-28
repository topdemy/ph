import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


window.Echo.private('asterisk.queues')
    .listen('.QueueCallerLeave', (event) => {
        console.log("Caller left queue:", event);

        // const queue = event.queue;
        // const caller = event.caller;
        // const position = event.position;
        // const count = event.count;
        //
        // updateQueueUI(queue, caller, position, count);
    });
