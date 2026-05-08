$(document).ready(function () {
    let table = $("#ImportDataset");
    let url = table.data("url");

    // DATATABLE
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
                data: "tweet",
            },

            {
                data: "sentiment",
                className: "text-center",
                render: function (data) {
                    if (data == "positif") {
                        return `<span class="badge bg-label-success">Positif</span>`;
                    }

                    if (data == "negatif") {
                        return `<span class="badge bg-label-danger">Negatif</span>`;
                    }

                    return `<span class="badge bg-label-secondary">Netral</span>`;
                },
            },
        ],
    });

    // IMPORT DATASET
    $("#formImport").submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "/dataset/import",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            beforeSend: function () {
                $("button[type=submit]").html(`
                    <span class="spinner-border spinner-border-sm"></span>
                    Importing...
                `);

                $("button[type=submit]").prop("disabled", true);
            },

            success: function (response) {
                $("#alertMessage").html(`
                    <div class="alert alert-success alert-dismissible">
                        ${response.message}
                    </div>
                `);

                $("#formImport")[0].reset();

                dataTable.ajax.reload();
            },

            error: function (xhr) {
                $("#alertMessage").html(`
                    <div class="alert alert-danger alert-dismissible">
                        Gagal import dataset
                    </div>
                `);
            },

            complete: function () {
                $("button[type=submit]").html(`
                    <i class="ti ti-upload me-1"></i>
                    Import
                `);

                $("button[type=submit]").prop("disabled", false);
            },
        });
    });
});
