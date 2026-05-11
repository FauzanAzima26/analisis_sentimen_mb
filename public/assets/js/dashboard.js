// =====================================================
// RADIAL CHART
// =====================================================
function renderRadialChart(elementId, data) {
    const positifPercent =
        data.total > 0 ? ((data.positif / data.total) * 100).toFixed(1) : 0;

    const negatifPercent =
        data.total > 0 ? ((data.negatif / data.total) * 100).toFixed(1) : 0;

    const netralPercent =
        data.total > 0 ? ((data.netral / data.total) * 100).toFixed(1) : 0;

    const options = {
        chart: {
            height: 380,
            type: "radialBar",
        },

        series: [
            parseFloat(positifPercent),
            parseFloat(negatifPercent),
            parseFloat(netralPercent),
        ],

        labels: ["Positif", "Negatif", "Netral"],

        colors: ["#22bb33", "#bb2124", "#aaaaaa"],

        plotOptions: {
            radialBar: {
                hollow: {
                    size: "40%",
                },

                dataLabels: {
                    name: {
                        fontSize: "18px",
                    },

                    value: {
                        fontSize: "16px",

                        formatter: function (val) {
                            return val + "%";
                        },
                    },

                    total: {
                        show: true,
                        label: "Total Data",
                        color: "#696cff",

                        formatter: function () {
                            return data.total;
                        },
                    },
                },
            },
        },

        legend: {
            show: true,
            position: "bottom",
        },

        stroke: {
            lineCap: "round",
        },
    };

    const chart = new ApexCharts(document.querySelector(elementId), options);

    chart.render();
}

// =====================================================
// RENDER RADIAL
// =====================================================
renderRadialChart("#radialBarChartSVM", svmData);
renderRadialChart("#radialBarChartSMOTE", smoteData);

$("#singleTweetForm").on("submit", function (e) {
    e.preventDefault();

    let tweet = $('textarea[name="tweet"]').val();

    if (!tweet) {
        $("#result").html(
            '<div class="alert alert-warning">Tweet tidak boleh kosong</div>',
        );
        return;
    }

    $("#result").html('<div class="text-muted">Menganalisis...</div>');

    $.ajax({
        url: "/sentiment/predict",
        type: "POST",
        data: {
            tweet: tweet,
            _token: "{{ csrf_token() }}",
        },
        success: function (res) {
            $("#result").html(`
                <div class="alert alert-info">
                    <b>Clean Text:</b> ${res.clean_text} <br><br>
                    <b>SVM:</b> ${res.svm} <br>
                    <b>SVM dan SMOTE:</b> ${res.smote}
                </div>
            `);
        },
        error: function () {
            $("#result").html(`
                <div class="alert alert-danger">
                    Gagal menghubungi server
                </div>
            `);
        },
    });
});
