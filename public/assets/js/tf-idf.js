$(document).ready(function () {
    let table = $("#tfidfTable");

    let url = table.data("url");

    let processUrl = table.data("process-url");

    let dataTable = table.DataTable({
        processing: true,
        responsive: true,
        autoWidth: false,
        pageLength: 10,

        ajax: {
            url: url,
            type: "GET",
            dataSrc: "",
        },

        columns: [
            {
                data: null,
                className: "text-center",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },

            {
                data: "term",
                className: "text-center",
            },

            {
                data: "tfidf",
                className: "text-center",
            },
        ],

        initComplete: function () {
            $(".dataTables_filter").addClass("mb-3 me-3");

            $(".dataTables_length").addClass("mb-3 ms-3 mt-2");
        },
    });
});
