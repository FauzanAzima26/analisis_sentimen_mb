$(document).ready(function () {
    let table = $("#preprocessing");

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
                data: "tweet",
            },

            {
                data: "clean_tweet",
                defaultContent: "-",
            },
        ],

        initComplete: function () {
            $(".dataTables_filter").addClass("mb-3 me-3");

            $(".dataTables_length").addClass("mb-3 ms-3 mt-2");
        },
    });

    $("#btnPreprocessing").click(function () {
        Swal.fire({
            title: "Jalankan preprocessing?",
            text: "Semua data akan diproses",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, proses",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: processUrl,

                    type: "POST",

                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },

                    beforeSend: function () {
                        $("#btnPreprocessing").prop("disabled", true).html(`
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Processing...
                        `);

                        Swal.fire({
                            title: "Processing...",
                            text: "Sedang menjalankan preprocessing",
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },

                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false,
                        });

                        dataTable.ajax.reload();
                    },

                    error: function (xhr) {
                        console.log(xhr.responseText);

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Preprocessing gagal",
                        });
                    },

                    complete: function () {
                        $("#btnPreprocessing").prop("disabled", false).html(`
                            <i class="ti ti-player-play me-1"></i>
                            Run Preprocessing
                        `);
                    },
                });
            }
        });
    });
});
