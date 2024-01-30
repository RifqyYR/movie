Chart.register(ChartDataLabels);

const zoomLevel = window.innerWidth / document.documentElement.clientWidth;
const pieBackgroundColor = ["#00a651", "#fc7f01"];
const pieHoverBackgroundColor = ["#46DF90", "#FD9B3A"];
const pieLabels = ["Klaim Diajukan", "Klaim Belum Diajukan"];
const pieOption = {
    // maintainAspectRatio: true,
    responsive: true,
    aspecRatio: 1,
    animation: {
        duration: 2500,
    },
    plugins: {
        legend: {
            display: false,
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
            anchor: "center",
            align: "end",
            color: "#fff",
            textAlign: "center",
            font: function (context) {
                var radius =
                    context.chart.getDatasetMeta(0).data[context.dataIndex]
                        .outerRadius;
                var size = Math.round(radius / 6); // Increase this division factor to reduce the font size
                return {
                    size: size,
                    weight: "bold",
                };
            },
        },
    },
};

$.ajax({
    url: "/home/data-pie",
    method: "GET",
    success: function (data) {
        var dataClaimPare =
            data.claims.ParePare == undefined ? 0 : data.claims.ParePare.length;
        var dataClaimBarru =
            data.claims.Barru == undefined ? 0 : data.claims.Barru.length;
        var dataClaimSidrap =
            data.claims.Sidrap == undefined ? 0 : data.claims.Sidrap.length;
        var dataClaimPinrang =
            data.claims.Pinrang == undefined ? 0 : data.claims.Pinrang.length;

        var dataFaskesPare = data.hospitals.ParePare.length;
        var dataFaskesBarru = data.hospitals.Barru.length;
        var dataFaskesSidrap = data.hospitals.Sidrap.length;
        var dataFaskesPinrang = data.hospitals.Pinrang.length;

        var ctxPare = document.getElementById("pie-chart-pare");
        var ctxBarru = document.getElementById("pie-chart-barru");
        var ctxSidrap = document.getElementById("pie-chart-sidrap");
        var ctxPinrang = document.getElementById("pie-chart-pinrang");

        var pieDataPare = {
            labels: pieLabels,
            datasets: [
                {
                    data: [dataClaimPare, dataFaskesPare - dataClaimPare],
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
                    data: [dataClaimBarru, dataFaskesBarru - dataClaimBarru],
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
                    data: [dataClaimSidrap, dataFaskesSidrap - dataClaimSidrap],
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
                    data: [
                        dataClaimPinrang,
                        dataFaskesPinrang - dataClaimPinrang,
                    ],
                    backgroundColor: pieBackgroundColor,
                    hoverBackgroundColor: pieHoverBackgroundColor,
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                },
            ],
        };

        new Chart(ctxPare, {
            type: "pie",
            data: pieDataPare,
            options: pieOption,
        });

        new Chart(ctxBarru, {
            type: "pie",
            data: pieDataBarru,
            options: pieOption,
        });

        new Chart(ctxSidrap, {
            type: "pie",
            data: pieDataSidrap,
            options: pieOption,
        });

        new Chart(ctxPinrang, {
            type: "pie",
            data: pieDataPinrang,
            options: pieOption,
        });
    },
});

var ctxBarru = document.getElementById("pie-chart-barru");
var ctxSidrap = document.getElementById("pie-chart-sidrap");
var ctxPinrang = document.getElementById("pie-chart-pinrang");

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
