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
    if (!chartElement) return;

    // Set the chart element to take full width of its container
    chartElement.style.width = '100%';
    chartElement.style.borderRadius = '12px';
    chartElement.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.08)';

    const { labels, data } = await fetchChartData(url);
    const ctx = chartElement.getContext("2d");

    // Destroy existing chart instance if exists
    if (chartElement.chartInstance) {
        chartElement.chartInstance.destroy();
    }

    // Create more vibrant gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, chartElement.height);
    gradient.addColorStop(0, "rgba(99, 102, 241, 0.5)");
    gradient.addColorStop(0.7, "rgba(99, 102, 241, 0.2)");
    gradient.addColorStop(1, "rgba(99, 102, 241, 0)");

    // Create border gradient for more depth
    const borderGradient = ctx.createLinearGradient(0, 0, chartElement.width, 0);
    borderGradient.addColorStop(0, '#6366f1');
    borderGradient.addColorStop(1, '#8b5cf6');

    // Initialize Chart.js with modern styling
    chartElement.chartInstance = new Chart(ctx, {
        type: "bar",
        data: {
            labels,
            datasets: [
                {
                    label,
                    data,
                    borderColor: borderGradient,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    borderRadius: 6, // Rounded bar tops
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(99, 102, 241, 0.7)',
                    hoverBorderColor: '#fff',
                    barPercentage: 0.7, // Makes bars slightly thinner for modern look
                    categoryPercentage: 0.8
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 20,
                    right: 20,
                    bottom: 20,
                    left: 20
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: "#6b7280",
                        font: {
                            weight: '500'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgba(229, 231, 235, 0.5)",
                        drawBorder: false
                    },
                    ticks: {
                        color: "#6b7280",
                        padding: 10,
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    },
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        color: "#374151",
                        font: {
                            size: 14,
                            weight: '600'
                        },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    },
                },
                tooltip: {
                    backgroundColor: "rgba(30, 41, 59, 0.95)",
                    titleColor: "#f3f4f6",
                    bodyColor: "#f3f4f6",
                    titleFont: {
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw.toLocaleString()}`;
                        }
                    }
                },
            },
            animation: {
                duration: 1000,
                easing: "easeInOutQuart",
                animateScale: true,
                animateRotate: true
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
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

