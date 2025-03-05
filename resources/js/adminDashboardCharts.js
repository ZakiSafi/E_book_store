async function fetchChartData(url) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
}

async function initializeChart(chartId, url, label) {
    const { labels, data } = await fetchChartData(url);

    const ctx = document.getElementById(chartId).getContext("2d");

    // Gradient for the chart background
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgba(99, 102, 241, 0.3)"); // Indigo with transparency
    gradient.addColorStop(1, "rgba(99, 102, 241, 0)"); // Fade out

    new Chart(ctx, {
        type: "line", // You can change this to 'bar' or 'area' for a different look
        data: {
            labels: labels,
            datasets: [
                {
                    label: label,
                    data: data,
                    borderColor: "#6366f1", // Indigo
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4, // Smooth curves
                    pointRadius: 5, // Larger points
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
            layout: {
                padding: {
                    top: 30,
                    right: 20,
                    bottom: 20,
                    left: 20,
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: "#6b7280", // Gray for ticks
                        font: {
                            family: "Poppins, sans-serif",
                            size: 12,
                            weight: "500",
                        },
                    },
                },
                y: {
                    beginAtZero: true, // Start Y-axis from 0
                    grid: {
                        color: "#e5e7eb", // Light gray grid lines
                    },
                    ticks: {
                        color: "#6b7280", // Gray for ticks
                        font: {
                            family: "Poppins, sans-serif",
                            size: 12,
                            weight: "500",
                        },
                        // Format large numbers (e.g., 16000 -> 16K)
                        callback: function (value) {
                            if (value >= 1000) {
                                return (value / 1000).toFixed(1) + "K";
                            }
                            return value;
                        },
                    },
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        color: "#374151", // Dark gray for legend
                        font: {
                            family: "Poppins, sans-serif",
                            size: 14,
                            weight: "600",
                        },
                    },
                },
                tooltip: {
                    backgroundColor: "#1e293b", // Dark tooltip background
                    titleColor: "#f3f4f6", // Light text for title
                    bodyColor: "#f3f4f6", // Light text for body
                    titleFont: {
                        family: "Poppins, sans-serif",
                        size: 14,
                    },
                    bodyFont: {
                        family: "Poppins, sans-serif",
                        size: 12,
                    },
                    padding: 10,
                    cornerRadius: 6,
                    // Format tooltip values (e.g., 16000 -> 16,000)
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || "";
                            if (label) {
                                label += ": ";
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat().format(
                                    context.parsed.y
                                );
                            }
                            return label;
                        },
                    },
                },
            },
            animation: {
                duration: 1000, // Smooth animation
                easing: "easeInOutQuart", // Smooth easing
            },
        },
    });
}

// Initialize the charts
document.addEventListener("DOMContentLoaded", () => {
    // Set a fixed height for the chart containers
    const chartContainers = document.querySelectorAll(".chart-container");
    chartContainers.forEach((container) => {
        container.style.height = "400px"; // Adjust height as needed
        container.style.width = "100%"; // Full width
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

const sidebar = document.querySelector("aside");
const footer = document.querySelector("footer");
const header = document.querySelector("header");

if (!sidebar || !footer || !header) {
    console.error("Sidebar, footer, or header not found in the DOM.");
} else {
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.target === footer) {
                // Footer reached
                if (entry.isIntersecting) {
                    sidebar.classList.add("at-footer");
                    sidebar.classList.remove("sticky"); // Remove sticky class when footer reaches
                } else {
                    sidebar.classList.add("sticky");
                    sidebar.classList.remove("at-footer");
                }
            } else if (entry.target === header) {
                // Header reached (for sticky behavior)
                if (entry.isIntersecting) {
                    sidebar.classList.remove("sticky"); // Remove sticky class when header is visible
                } else {
                    sidebar.classList.add("sticky"); // Make sidebar sticky when header is not visible
                }
            }
        },
        { rootMargin: "0px", threshold: 0 }
    );

    observer.observe(footer);
    observer.observe(header);
}

// pop up for category creation
document.addEventListener("DOMContentLoaded", () => {
    const model = document.getElementById("categoryModal");
    document.getElementById("openModal").addEventListener("click", function () {
        if (model) {
            model.classList.toggle("hidden");
        }
    });
});

// // Close Modal when clicking outside
const close = document.querySelector("#closePopup");
close.addEventListener("click", function () {
    const modal = document.getElementById("categoryModal");
    if (modal) {
        modal.classList.add("hidden");
    }
});

// toggle submenu of aside element

function toggleSubmenu(submenuId) {
    const submenu = document.getElementById(submenuId);
    const chevron = document.getElementById(
        submenuId.replace("Submenu", "Chevron")
    );

    if (submenu.style.maxHeight) {
        submenu.style.maxHeight = null; // Collapse submenu
        chevron.classList.replace("fa-chevron-down", "fa-chevron-right");
    } else {
        submenu.style.maxHeight = submenu.scrollHeight + "px"; // Expand submenu
        chevron.classList.replace("fa-chevron-right", "fa-chevron-down");
    }
}

document.addEventListener("click", function (event) {
    const submenus = ["userSubmenu", "bookSubmenu", "borrowedSubmenu"];
    submenus.forEach((submenuId) => {
        const submenu = document.getElementById(submenuId);
        const chevron = document.getElementById(
            submenuId.replace("Submenu", "Chevron")
        );
        const submenuParent = submenu.closest("li");

        if (!submenuParent.contains(event.target)) {
            submenu.style.maxHeight = null; // Collapse submenu
            chevron.classList.replace("fa-chevron-down", "fa-chevron-right");
        }
    });
});
