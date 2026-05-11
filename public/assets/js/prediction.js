$(document).ready(function () {
    let table = $("#prediction").DataTable({
        processing: true,

        serverSide: false,

        ajax: {
            url: $("#prediction").data("url"),
            type: "GET",
            dataSrc: "data",
        },

        columns: [
            // NO
            {
                data: null,

                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },

                className: "text-center",
            },

            // TWEET
            {
                data: "tweet",
                defaultContent: "-",
            },

            // CLEAN TWEET
            {
                data: "clean_tweet",
                defaultContent: "-",
            },

            // SVM
            {
                data: "sentimen_svm",
                className: "text-center",

                defaultContent: "-",

                render: function (data) {
                    if (data === "positif") {
                        return `<span class="badge bg-success">Positif</span>`;
                    }

                    if (data === "negatif") {
                        return `<span class="badge bg-danger">Negatif</span>`;
                    }

                    return `<span class="badge bg-secondary">Netral</span>`;
                },
            },

            // SMOTE
            {
                data: "sentimen_smote",
                className: "text-center",

                defaultContent: "-",

                render: function (data) {
                    if (data === "positif") {
                        return `<span class="badge bg-success">Positif</span>`;
                    }

                    if (data === "negatif") {
                        return `<span class="badge bg-danger">Negatif</span>`;
                    }

                    return `<span class="badge bg-secondary">Netral</span>`;
                },
            },
        ],
    });
});
