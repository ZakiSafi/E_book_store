const menuBtn = document.getElementById("menu-btn");
const mobileMenu = document.getElementById("mobile-menu");
const upload = document.getElementById("upload");
const addMenu = document.getElementById("add_menu");
const dropdownButton = document.getElementById("dropdownButton");

if (menuBtn && mobileMenu) {
    menuBtn.addEventListener("click", () => {
        if (mobileMenu.classList.contains("hidden")) {
            // Show the menu
            mobileMenu.classList.remove("hidden");
        } else {
            // Hide the menu
            mobileMenu.classList.add("hidden");
        }
    });
}
if (dropdownButton && mobileMenu) {
    dropdownButton.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });
}

// <!-- JavaScript to Toggle Dropdown -->
// if (dorpdown-toggle && dropdown-menu) {
//     document
//         .getElementById("dropdown-toggle")
//         .addEventListener("click", function () {
//             const dropdownMenu = document.getElementById("dropdown-menu");
//             dropdownMenu.classList.toggle("hidden");
//         });
// }

// // Close dropdown when clicking outside
// document.addEventListener("click", function (event) {
//     const dropdownMenu = document.getElementById("dropdown-menu");
//     const dropdownToggle = document.getElementById("dropdown-toggle");
//     if (
//         !dropdownToggle.contains(event.target) &&
//         !dropdownMenu.contains(event.target)
//     ) {
//         dropdownMenu.classList.add("hidden");
//     }
// });

// Showing password input
document.querySelectorAll(".toggle-password").forEach((button) => {
    button.addEventListener("click", function () {
        const password = document.getElementById("password");
        const password_confirm = document.getElementById(
            "password_confirmation"
        );
        const icon = this.querySelector("i");

        // Toggle visibility for password field
        if (password) {
            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        // Toggle visibility for password_confirm field if it exists
        if (password_confirm) {
            if (password_confirm.type === "password") {
                password_confirm.type = "text";
            } else {
                password_confirm.type = "password";
            }
        }
    });
});

// open pop up for profile picture
document.querySelectorAll(".popup_profile").forEach((button) => {
    button.addEventListener("click", function () {
        const popup = document.getElementById("profileModal");
        popup.classList.remove("hidden");
    });
});

// document.getElementById("close-popup").addEventListener("click", function () {
//     const popup = document.getElementById("profileModal");
//     popup.classList.add("hidden");
// });
