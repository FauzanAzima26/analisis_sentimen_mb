$(document).ready(function () {
    // DATATABLE
    let table = $("#predictionTable").DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,

        initComplete: function () {
            $(".dataTables_filter").addClass("mb-3 me-3");

            $(".dataTables_length").addClass("mb-3 ms-3 mt-2");
        },
    });

    // PREDIKSI
    $("#btnPredict").click(function () {
        let tweet = $("#tweet").val();

        let model = $("input[name='model']:checked").val();

        // VALIDASI
        if (tweet.trim() === "") {
            Swal.fire({
                icon: "warning",
                title: "Peringatan",
                text: "Tweet tidak boleh kosong",
            });

            return;
        }

        // BUTTON LOADING
        $("#btnPredict").prop("disabled", true).html(`
                <span class="spinner-border spinner-border-sm me-1"></span>
                Processing...
            `);

        /*
        ============================================
        SIMULASI PREDIKSI
        NANTI GANTI DENGAN AJAX / API PYTHON
        ============================================
        */

        setTimeout(function () {
            // RANDOM DEMO
            let prediction = Math.random() > 0.5 ? "Positif" : "Negatif";

            let confidence = Math.floor(Math.random() * (99 - 85) + 85);

            // UPDATE HASIL
            $("#resultModel").text(model);

            $("#resultPrediction").text(prediction);

            $("#resultTweet").text(tweet);

            // PROGRESS BAR
            $("#confidenceBar")
                .css("width", confidence + "%")
                .text(confidence + "%");

            // WARNA BADGE
            if (prediction === "Positif") {
                $("#resultPrediction")
                    .removeClass()
                    .addClass("text-success fw-bold");

                $("#confidenceBar")
                    .removeClass()
                    .addClass("progress-bar bg-success");
            } else {
                $("#resultPrediction")
                    .removeClass()
                    .addClass("text-danger fw-bold");

                $("#confidenceBar")
                    .removeClass()
                    .addClass("progress-bar bg-danger");
            }

            // BADGE TABLE
            let badge =
                prediction === "Positif"
                    ? `
                    <span class="badge bg-label-success">
                        Positif
                    </span>
                `
                    : `
                    <span class="badge bg-label-danger">
                        Negatif
                    </span>
                `;

            // TAMBAH KE TABEL
            table.row
                .add([
                    tweet,

                    `
                    <span class="badge bg-label-primary">
                        ${model}
                    </span>
                `,

                    badge,

                    `
                    <span class="fw-semibold">
                        ${confidence}%
                    </span>
                `,
                ])
                .draw(false);

            // RESET BUTTON
            $("#btnPredict").prop("disabled", false).html(`
                    <i class="ti ti-brand-openai me-1"></i>
                    Analisis Sentimen
                `);

            // ALERT
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Prediksi berhasil dilakukan",
                timer: 1800,
                showConfirmButton: false,
            });
        }, 1000);
    });

    // UPLOAD CSV
    $("#formCSV").submit(function (e) {
        e.preventDefault();

        Swal.fire({
            icon: "info",
            title: "Info",
            text: "Fitur upload CSV belum dihubungkan ke model",
        });
    });
});
