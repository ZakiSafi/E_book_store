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
if (upload && addMenu) {
    upload.addEventListener("click", function () {
        if (addMenu.classList.contains("hidden")) {
            addMenu.classList.remove("hidden");
        } else {
            addMenu.classList.add("hidden");
        }
    });

    document.addEventListener("click", function (event) {
        if (!addMenu.contains(event.target) && !upload.contains(event.target)) {
            addMenu.classList.add("hidden");
        }
    });
}
if (dropdownButton && mobileMenu) {
    dropdownButton.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });
}
