const labels = [
    "Puskesmas",
    "DPP",
    "Apotik",
    "Dokter Gigi",
    "Optik",
    "RS Kelas C",
    "RS Kelas B",
    "Klinik Utama",
    "Klinik Pratama",
    "Klinik Polri",
    "Klinik TNI",
    "RS Kelas D",
    "Laboratorium",
    "RS TNI/Polri Tingkat III",
];
const backgroundColor = [
    "#fc7f01",
    "#fc7f01",
    "#00a651",
    "#fc7f01",
    "#00a651",
    "#2E3192",
    "#2E3192",
    "#2E3192",
    "#fc7f01",
    "#fc7f01",
    "#fc7f01",
    "#2E3192",
    "#00a651",
    "#2E3192",
];
const option = {
    indexAxis: "y",
    elements: {
        bar: {
            borderWidth: 0.5,
        },
    },
    scaleShowValues: true,
    scales: {
        y: {
            ticks: {
                font: {
                    size: 10,
                },
            },
        },
        // x: {
        //     beforeUpdate(axis) {
        //         const labels = axis.chart.data.labels;
        //         for (let i = 0; i < labels.length; i++) {
        //             const lbl = labels[i];
        //             if (typeof lbl === "string" && lbl.length > 15) {
        //                 labels[i] = lbl.substring(0, 10) + "..."; // cutting
        //             }
        //         }
        //     },
        // },
    },
    plugins: {
        legend: {
            display: false,
        },
        title: {
            display: true,
            text: "Detail Jumlah Fasilitas Kesehatan",
        },
        datalabels: {
            color: "#fff",
            font: {
                size: 8,
            },
        },
    },
};

var ctxPare = document.getElementById("bar-chart-pare").getContext("2d");
var ctxBarru = document.getElementById("bar-chart-barru").getContext("2d");
var ctxSidrap = document.getElementById("bar-chart-sidrap").getContext("2d");
var ctxPinrang = document.getElementById("bar-chart-pinrang").getContext("2d");

var dataPare = {
    labels: labels,
    datasets: [
        {
            data: [8, 8, 8, 6, 4, 2, 2, 2, 2, 2, 1, 1, 1, 1],
            backgroundColor: backgroundColor,
            borderColor: backgroundColor,
            borderWidth: 1,
        },
    ],
};

var dataBarru = {
    labels: labels,
    datasets: [
        {
            data: [12, 3, 3, 2, 2, 1, 0, 2, 2, 1, 0, 0],
            backgroundColor: backgroundColor,
            borderColor: backgroundColor,
            borderWidth: 1,
        },
    ],
};

var dataSidrap = {
    labels: labels,
    datasets: [
        {
            data: [14, 4, 4, 2, 1, 2, 0, 0, 2, 1, 1, 1, 1],
            backgroundColor: backgroundColor,
            borderColor: backgroundColor,
            borderWidth: 1,
        },
    ],
};

var dataPinrang = {
    labels: labels,
    datasets: [
        {
            data: [17, 6, 6, 1, 2, 1, 0, 0, 5, 1, 1, 2],
            backgroundColor: backgroundColor,
            borderColor: backgroundColor,
            borderWidth: 1,
        },
    ],
};

var barChartPare = new Chart(ctxPare, {
    type: "bar",
    data: dataPare,
    options: option,
    responsive: true,
});

var barChartBarru = new Chart(ctxBarru, {
    type: "bar",
    data: dataBarru,
    options: option,
    responsive: true,
});

var barChartSidrap = new Chart(ctxSidrap, {
    type: "bar",
    data: dataSidrap,
    options: option,
    responsive: true,
});

var barChartPinrang = new Chart(ctxPinrang, {
    type: "bar",
    data: dataPinrang,
    options: option,
    responsive: true,
});
