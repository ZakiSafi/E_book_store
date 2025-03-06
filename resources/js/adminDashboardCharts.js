async function fetchChartData(url) {
    try {
        const response = await fetch(url);
        if (!response.ok)
            throw new Error(`HTTP error! Status: ${response.status}`);
        return await response.json();
    } catch (error) {
        console.error("Error fetching chart data:", error);
        return { labels: [], data: [] }; // Return empty data to prevent crashes
    }
}

async function initializeChart(chartId, url, label) {
    const chartElement = document.getElementById(chartId);
    if (!chartElement) return; // Prevent errors if the chart does not exist

    const { labels, data } = await fetchChartData(url);
    const ctx = chartElement.getContext("2d");

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgba(99, 102, 241, 0.3)");
    gradient.addColorStop(1, "rgba(99, 102, 241, 0)");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: label,
                    data: data,
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

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".chart-container").forEach((container) => {
        container.style.height = "400px";
        container.style.width = "100%";
    });

    initializeChart(
        "booksBorrowedChart",
        "/api/books-borrowed",
        "Books Borrowed"
    );
    initializeChart(
        "booksDownloadedChart",
        "/api/books-downloaded",
        "Books Downloaded"
    );
});

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

// Modal Handling
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("categoryModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.getElementById("closePopup");

    if (openModalBtn && modal) {
        openModalBtn.addEventListener("click", () =>
            modal.classList.toggle("hidden")
        );
    }

    if (closeModalBtn && modal) {
        closeModalBtn.addEventListener("click", () =>
            modal.classList.add("hidden")
        );
    }
});

// Submenu Toggle
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

document.addEventListener("DOMContentLoaded", function () {
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
});
