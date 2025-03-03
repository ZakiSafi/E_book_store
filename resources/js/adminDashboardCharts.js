async function fetchChartData(url) {
    const response = await fetch(url);
    return await response.json();
}

async function initializeChart(chartId, url, label) {
    const { labels, data } = await fetchChartData(url);

    const chart = new FlowbiteCharts.Chart(document.getElementById(chartId), {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: label,
                    data: data,
                    borderColor: "#3b82f6",
                    backgroundColor: "#3b82f6",
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
            },
        },
    });
}

// Initialize the charts
document.addEventListener("DOMContentLoaded", () => {
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
