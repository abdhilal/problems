import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// الاستماع إلى الرسائل الجديدة
window.Echo.private('chat.{{ auth()->user()->id }}')
    .listen('.new-message', (data) => {
        console.log("New message received:", data);

        // عرض الرسالة الجديدة
        const chatBox = document.getElementById('chat-box');
        if (chatBox) {
            const messageElement = document.createElement('div');
            messageElement.className = 'message';
            messageElement.innerHTML = `
                <strong>${data.senderId}:</strong>
                <p>${data.message}</p>
            `;
            chatBox.appendChild(messageElement);
        }
    });
