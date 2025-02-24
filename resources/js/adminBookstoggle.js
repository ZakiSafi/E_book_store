const sidebarToggle = document.getElementById("sidebar-toggle");
const sidebarDropdown = document.getElementById("sidebar-dropdown");

sidebarToggle.addEventListener("click", () => {
    sidebarDropdown.classList.toggle("hidden");
});

// Close dropdown when clicking outside
document.addEventListener("click", (e) => {
    if (
        !sidebarToggle.contains(e.target) &&
        !sidebarDropdown.contains(e.target)
    ) {
        sidebarDropdown.classList.add("hidden");
    }
});

// action toggle and sideBar
const actionToggles = document.getElementsByClassName("action-toggle");
const actionSideBars = document.getElementsByClassName("action-sideBar");

for (let i = 0; i < actionToggles.length; i++) {
    actionToggles[i].addEventListener("click", function () {
        actionSideBars[i].classList.toggle("hidden");
    });
}

document.addEventListener("click", (e) => {
    for (let i = 0; i < actionToggles.length; i++) {
        if (
            !actionToggles[i].contains(e.target) &&
            !actionSideBars[i].contains(e.target)
        ) {
            actionSideBars[i].classList.add("hidden");
        }
    }
});
