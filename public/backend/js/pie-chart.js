Chart.register(ChartDataLabels);

const pieBackgroundColor = ["#2E3192", "#fc7f01", "#00a651"];
const pieHoverBackgroundColor = ["#2e59d9", "#FFAE5D", "#00BC5B"];
const pieLabels = ["FKRTL", "FKTP", "Penunjang"];
const pieOption = {
    maintainAspectRatio: false,
    animation: {
        duration: 2000,
    },
    plugins: {
        legend: {
            position: "bottom",
            align: "start",
            labels: {
                font: {
                    size: 10,
                },
            },
        },
        datalabels: {
            formatter: (value, ctx) => {
                let sum = 0;
                let dataArr = ctx.chart.data.datasets[0].data;
                dataArr.map((data) => {
                    sum += data;
                });
                let percentage = ((value * 100) / sum).toFixed(1) + "%";
                return percentage;
            },
            anchor: (ctx) => {
                if (ctx.dataset.backgroundColor[ctx.dataIndex] == "#00a651") {
                    return "center";
                } else {
                    return "end";
                }
            },
            align: (ctx) => {
                if (ctx.dataset.backgroundColor[ctx.dataIndex] == "#00a651") {
                    return "center";
                } else {
                    return "end";
                }
            },
            color: (ctx) => {
                if (ctx.dataset.backgroundColor[ctx.dataIndex] == "#00a651") {
                    return "#fff";
                } else {
                    return ctx.dataset.backgroundColor[ctx.dataIndex];
                }
            },
            textAlign: "center",
            font: function (context) {
                var radius =
                    context.chart.getDatasetMeta(0).data[context.dataIndex]
                        .outerRadius;
                var size = Math.round(radius / 8); // Increase this division factor to reduce the font size
                return {
                    size: size,
                    weight: "bold",
                };
            },
        },
    },
    tooltips: {
        enabled: false,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: "#dddfeb",
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
    },
};

var ctxPare = document.getElementById("pie-chart-pare");
var ctxBarru = document.getElementById("pie-chart-barru");
var ctxSidrap = document.getElementById("pie-chart-sidrap");
var ctxPinrang = document.getElementById("pie-chart-pinrang");

var pieDataPare = {
    labels: pieLabels,
    datasets: [
        {
            data: [7, 27, 13],
            backgroundColor: pieBackgroundColor,
            hoverBackgroundColor: pieHoverBackgroundColor,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        },
    ],
};

var pieDataBarru = {
    labels: pieLabels,
    datasets: [
        {
            data: [3, 20, 5],
            backgroundColor: pieBackgroundColor,
            hoverBackgroundColor: pieHoverBackgroundColor,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        },
    ],
};

var pieDataSidrap = {
    labels: pieLabels,
    datasets: [
        {
            data: [3, 24, 5],
            backgroundColor: pieBackgroundColor,
            hoverBackgroundColor: pieHoverBackgroundColor,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        },
    ],
};

var pieDataPinrang = {
    labels: pieLabels,
    datasets: [
        {
            data: [3, 32, 8],
            backgroundColor: pieBackgroundColor,
            hoverBackgroundColor: pieHoverBackgroundColor,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        },
    ],
};

var pieChartPare = new Chart(ctxPare, {
    type: "pie",
    data: pieDataPare,
    options: pieOption,
});

var pieChartBarru = new Chart(ctxBarru, {
    type: "pie",
    data: pieDataBarru,
    options: pieOption,
});

var pieChartSidrap = new Chart(ctxSidrap, {
    type: "pie",
    data: pieDataSidrap,
    options: pieOption,
});

var pieChartPinrang = new Chart(ctxPinrang, {
    type: "pie",
    data: pieDataPinrang,
    options: pieOption,
});
