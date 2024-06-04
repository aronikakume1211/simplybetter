// script.js

function startCountdown() {
    const timerElement = document.getElementById('mebrik_timer');

    function updateCountdown() {
        const now = new Date();
        const currentHour = now.getHours();
        const currentMinutes = now.getMinutes();
        const currentSeconds = now.getSeconds();

        // Calculate remaining time until next 12:00 PM
        const noon = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 12, 0, 0);
        if (now >= noon) {
            noon.setDate(noon.getDate() + 1);
        }

        const timeRemaining = noon - now;

        const hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 12);
        const minutes = Math.floor((timeRemaining / (1000 * 60)) % 60);
        const seconds = Math.floor((timeRemaining / 1000) % 60);

        // Display the timer
        timerElement.textContent = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
    }

    function pad(number) {
        return number < 10 ? '0' + number : number;
    }

    // Update the countdown every second
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

document.addEventListener('DOMContentLoaded', startCountdown);
