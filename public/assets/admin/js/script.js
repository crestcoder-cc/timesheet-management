var ctx = document.getElementById('myChart').getContext("2d");

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Month",
            borderColor: "#A8C5DA",
            pointBorderColor: "#A8C5DA",
            pointBackgroundColor: "#A8C5DA",
            pointHoverBackgroundColor: "#A8C5DA",
            pointHoverBorderColor: "#A8C5DA",
            pointBorderWidth: 1,
            pointHoverRadius: 1,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
            data: [20, 30, 40, 40, 30, 20, 30, 40, 50, 30, 20, 30]
        },
        {
            label: "Year",
            borderColor: "#1C1C1C",
            pointBorderColor: "#1C1C1C",
            pointBackgroundColor: "#1C1C1C",
            pointHoverBackgroundColor: "#1C1C1C",
            pointHoverBorderColor: "#1C1C1C",
            pointBorderWidth: 1,
            pointHoverRadius: 1,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 4,
            data: [30, 20, 20, 30, 40, 30, 20, 30, 40, 50, 50, 40]
        }]
    },
    options: {
        legend: {
            position: "top"
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }

            }],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"
                },
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});