@if (session('error'))
<div id="error-message" class="fixed top-13 left-0 right-0 bg-red-500 text-white p-4 text-center rounded-b-lg shadow-lg opacity-0 transition-opacity duration-500 ease-in-out w-full">
    {{ session('error') }}
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let message = document.getElementById('error-message');

        // Fade in effect
        message.classList.remove('opacity-0');
        message.classList.add('opacity-100');

        // Fade out effect after 2 seconds
        setTimeout(() => {
            message.classList.remove('opacity-100');
            message.classList.add('opacity-0');

            // Remove the message from the DOM after fading out (optional)
            setTimeout(() => message.style.display = 'none', 500);
        }, 2000);
    });
</script>

@php
// Forget the session message after displaying it
session()->forget('error');
@endphp
@endif
