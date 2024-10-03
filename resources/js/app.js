import "./bootstrap";

import Alpine from "alpinejs";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Alpine = Alpine;

Alpine.start();

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true,
    auth: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            Authorization: `Bearer ${localStorage.getItem("access_token")}`, // Make sure this is the correct token
        },
    },
});

let userId = 26;
// Listen for the event
window.Echo.private("todos." + userId) // Replace userId with the authenticated user's ID
    .listen("TodoNotificationEvent", (event) => {
        console.log(event.message);
        // Display the notification message in your app, e.g., using an alert or a custom notification UI
    });
