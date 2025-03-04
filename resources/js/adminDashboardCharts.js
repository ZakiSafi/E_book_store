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
