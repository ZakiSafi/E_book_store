document.addEventListener("DOMContentLoaded", () => {
    setupChart("booksBorrowedChart", "/api/books-borrowed", "Books Borrowed");
    setupChart(
        "booksDownloadedChart",
        "/api/books-downloaded",
        "Books Downloaded"
    );
    setupModal("categoryModal", "openModal", "closePopup");
    setupSubmenuToggles();
});

/**
 * Fetches chart data from the API.
 * @param {string} url - API endpoint for chart data.
 * @returns {Promise<{labels: [], data: []}>}
 */
async function fetchChartData(url) {
    try {
        const response = await fetch(url);
        if (!response.ok)
            throw new Error(`HTTP error! Status: ${response.status}`);
        return await response.json();
    } catch (error) {
        console.error("Error fetching chart data:", error);
        return { labels: [], data: [] }; // Return empty structure to prevent crashes
    }
}

/**
 * Initializes a chart with fetched data.
 * @param {string} chartId - ID of the canvas element.
 * @param {string} url - API endpoint for chart data.
 * @param {string} label - Label for the dataset.
 */
async function setupChart(chartId, url, label) {
    const chartElement = document.getElementById(chartId);
    if (!chartElement) return; // Prevents errors if the element doesn't exist

    const { labels, data } = await fetchChartData(url);
    const ctx = chartElement.getContext("2d");

    // Destroy existing chart instance if exists
    if (chartElement.chartInstance) {
        chartElement.chartInstance.destroy();
    }

    // Create gradient background
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgba(99, 102, 241, 0.3)");
    gradient.addColorStop(1, "rgba(99, 102, 241, 0)");

    // Initialize Chart.js
    chartElement.chartInstance = new Chart(ctx, {
        type: "line",
        data: {
            labels,
            datasets: [
                {
                    label,
                    data,
                    borderColor: "#6366f1",
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: "#6366f1",
                    pointBorderColor: "#fff",
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#6366f1",
                    borderWidth: 3,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { grid: { display: false }, ticks: { color: "#6b7280" } },
                y: {
                    beginAtZero: true,
                    grid: { color: "#e5e7eb" },
                    ticks: { color: "#6b7280" },
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: { color: "#374151" },
                },
                tooltip: {
                    backgroundColor: "#1e293b",
                    titleColor: "#f3f4f6",
                    bodyColor: "#f3f4f6",
                },
            },
            animation: { duration: 1000, easing: "easeInOutQuart" },
        },
    });
}


/**
 * Sets up modal functionality with smooth toggle.
 * @param {string} modalId - ID of the modal element.
 * @param {string} openButtonId - ID of the open modal button.
 * @param {string} closeButtonId - ID of the close modal button.
 */
function setupModal(modalId, openButtonId, closeButtonId) {
    const modal = document.getElementById(modalId);
    const openButton = document.getElementById(openButtonId);
    const closeButton = document.getElementById(closeButtonId);

    if (!modal) return;

    const toggleModal = () => modal.classList.toggle("hidden");

    openButton?.addEventListener("click", toggleModal);
    closeButton?.addEventListener("click", () => modal.classList.add("hidden"));
}

/**
 * Handles submenu toggling with smooth animation.
 */
function setupSubmenuToggles() {
    document.querySelectorAll(".submenu-toggle").forEach((toggle) => {
        toggle.addEventListener("click", function () {
            const submenuId = this.getAttribute("data-submenu-id");
            if (submenuId) toggleSubmenu(submenuId);
        });
    });

    document.addEventListener("click", function (event) {
        ["userSubmenu", "bookSubmenu", "borrowedSubmenu"].forEach(
            (submenuId) => {
                const submenu = document.getElementById(submenuId);
                const chevron = document.getElementById(
                    submenuId.replace("Submenu", "Chevron")
                );

                if (
                    submenu &&
                    chevron &&
                    !submenu.closest("li").contains(event.target)
                ) {
                    submenu.style.maxHeight = null;
                    chevron.classList.replace(
                        "fa-chevron-down",
                        "fa-chevron-right"
                    );
                }
            }
        );
    });
}

/**
 * Toggles a submenu open/closed with a sliding effect.
 * @param {string} submenuId - ID of the submenu element.
 */
function toggleSubmenu(submenuId) {
    const submenu = document.getElementById(submenuId);
    const chevron = document.getElementById(
        submenuId.replace("Submenu", "Chevron")
    );

    if (submenu && chevron) {
        const isOpen = submenu.style.maxHeight;
        submenu.style.maxHeight = isOpen ? null : submenu.scrollHeight + "px";
        chevron.classList.replace(
            isOpen ? "fa-chevron-down" : "fa-chevron-right",
            isOpen ? "fa-chevron-right" : "fa-chevron-down"
        );
    }
}



/**
 * Sets up the sticky sidebar behavior.
 */
// Sidebar Sticky Behavior
const sidebar = document.querySelector("aside");
const footer = document.querySelector("footer");
const header = document.querySelector("header");

if (sidebar && footer && header) {
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.target === footer) {
                sidebar.classList.toggle("at-footer", entry.isIntersecting);
                sidebar.classList.toggle("sticky", !entry.isIntersecting);
            } else if (entry.target === header) {
                sidebar.classList.toggle("sticky", !entry.isIntersecting);
            }
        },
        { rootMargin: "0px", threshold: 0 }
    );

    observer.observe(footer);
    observer.observe(header);
}


// Code for toggling shelves and categories bar
 document.addEventListener("DOMContentLoaded", function () {
     const categoriesButton = document.getElementById("categoriesButton");
     const shelvesButton = document.getElementById("shelvesButton");
     const categoriesBar = document.getElementById("categoriesBar");
     const shelvesBar = document.getElementById("shelvesBar");

     // Show Categories Bar and hide Shelves Bar
     categoriesButton.addEventListener("click", () => {
         categoriesBar.classList.toggle("hidden");
         shelvesBar.classList.add("hidden");
     });

     // Show Shelves Bar and hide Categories Bar
     shelvesButton.addEventListener("click", () => {
         shelvesBar.classList.toggle("hidden");
         categoriesBar.classList.add("hidden");
     });
 });

