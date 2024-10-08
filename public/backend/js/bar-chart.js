function numToMonth(month) {
    if (month == 0) return "Januari";
    if (month == 1) return "Februari";
    if (month == 2) return "Maret";
    if (month == 3) return "April";
    if (month == 4) return "Mei";
    if (month == 5) return "Juni";
    if (month == 6) return "Juli";
    if (month == 7) return "Agustus";
    if (month == 8) return "September";
    if (month == 9) return "Oktober";
    if (month == 10) return "November";
    if (month == 11) return "Desember";
}

const labels = ["Total Faskes", "Faskes Telah Mengajukan", "Faskes Belum Mengajukan"];
const backgroundColor = ["#2E3192", "#00a651", "#fc7f01"];
const yearNow = new Date().getFullYear();
const monthNow = numToMonth(new Date().getMonth());
const option = {
    animation: {
        duration: 2200,
    },
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
    },
    plugins: {
        legend: {
            display: false,
        },
        title: {
            display: true,
            text: "ABSENSI KLAIM FKRTL REGULER (INACBGS) - " + monthNow.toUpperCase() + " " + yearNow,
            font: {
                size: 12,
            },
        },
        datalabels: {
            color: "#fff",
        },
    },
};
const optionFKTP = {
    animation: {
        duration: 2200,
    },
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
    },
    plugins: {
        legend: {
            display: false,
        },
        title: {
            display: true,
            text: "ABSENSI KLAIM FKTP REGULER (NON KAPITASI) - " + monthNow.toUpperCase() + " " + yearNow,
            font: {
                size: 12,
            },
        },
        datalabels: {
            color: "#fff",
        },
    },
};

$.ajax({
    url: "/home/data-bar-fkrtl",
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

        var ctxPare = document
            .getElementById("bar-chart-fkrtl-pare")
            .getContext("2d");

        var ctxBarru = document
            .getElementById("bar-chart-fkrtl-barru")
            .getContext("2d");

        var ctxSidrap = document
            .getElementById("bar-chart-fkrtl-sidrap")
            .getContext("2d");

        var ctxPinrang = document
            .getElementById("bar-chart-fkrtl-pinrang")
            .getContext("2d");

        var dataPare = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesPare,
                        dataClaimPare,
                        dataFaskesPare - dataClaimPare,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };

        var dataBarru = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesBarru,
                        dataClaimBarru,
                        dataFaskesBarru - dataClaimBarru,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };
        
        var dataSidrap = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesSidrap,
                        dataClaimSidrap,
                        dataFaskesSidrap - dataClaimSidrap,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };
        
        var dataPinrang = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesPinrang,
                        dataClaimPinrang,
                        dataFaskesPinrang - dataClaimPinrang,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };

        new Chart(ctxPare, {
            type: "bar",
            data: dataPare,
            options: option,
            responsive: true,
        });

        new Chart(ctxBarru, {
            type: "bar",
            data: dataBarru,
            options: option,
            responsive: true,
        });
        
        new Chart(ctxSidrap, {
            type: "bar",
            data: dataSidrap,
            options: option,
            responsive: true,
        });
        
        new Chart(ctxPinrang, {
            type: "bar",
            data: dataPinrang,
            options: option,
            responsive: true,
        });
    },
});

$.ajax({
    url: "/home/data-bar-fktp",
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

        var ctxPare = document
            .getElementById("bar-chart-fktp-pare")
            .getContext("2d");

        var ctxBarru = document
            .getElementById("bar-chart-fktp-barru")
            .getContext("2d");

        var ctxSidrap = document
            .getElementById("bar-chart-fktp-sidrap")
            .getContext("2d");

        var ctxPinrang = document
            .getElementById("bar-chart-fktp-pinrang")
            .getContext("2d");

        var dataPare = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesPare,
                        dataClaimPare,
                        dataFaskesPare - dataClaimPare,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };

        var dataBarru = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesBarru,
                        dataClaimBarru,
                        dataFaskesBarru - dataClaimBarru,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };
        
        var dataSidrap = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesSidrap,
                        dataClaimSidrap,
                        dataFaskesSidrap - dataClaimSidrap,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };
        
        var dataPinrang = {
            labels: labels,
            datasets: [
                {
                    data: [
                        dataFaskesPinrang,
                        dataClaimPinrang,
                        dataFaskesPinrang - dataClaimPinrang,
                    ],
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 2,
                },
            ],
        };

        new Chart(ctxPare, {
            type: "bar",
            data: dataPare,
            options: optionFKTP,
            responsive: true,
        });

        new Chart(ctxBarru, {
            type: "bar",
            data: dataBarru,
            options: optionFKTP,
            responsive: true,
        });
        
        new Chart(ctxSidrap, {
            type: "bar",
            data: dataSidrap,
            options: optionFKTP,
            responsive: true,
        });
        
        new Chart(ctxPinrang, {
            type: "bar",
            data: dataPinrang,
            options: optionFKTP,
            responsive: true,
        });
    },
});
