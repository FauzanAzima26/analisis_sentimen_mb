@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">

                <h3 class="mb-1">
                    Import Dataset CSV
                </h3>

                <p class="text-muted mb-0">
                    Upload dataset tweet untuk analisis sentimen
                </p>

            </div>

            {{-- FORM --}}
            <div class="card-body">
                <div id="alertMessage"></div>
                <form id="formImport" enctype="multipart/form-data">

                    @csrf

                    <div class="row align-items-end g-3">

                        {{-- FILE --}}
                        <div class="col-md-5">

                            <label class="form-label">
                                File CSV
                            </label>

                            <input type="file" name="file" class="form-control" accept=".csv,.xlsx,.xls" required>
                            <small class="text-muted">
                                Format file yang didukung: CSV, XLSX, XLS
                            </small>
                        </div>

                        {{-- BUTTON --}}
                        <div class="col-md-2 mb-5">

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-upload me-1"></i>
                                Import
                            </button>

                        </div>

                    </div>

                </form>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive px-3 pb-3">

                <table id="ImportDataset" class="table table-bordered" data-url="{{ route('dataset.data') }}">

                    <thead>

                        <tr>

                            <th width="5%" class="text-center">
                                NO
                            </th>

                            <th width="40%">
                                TWEET
                            </th>

                        </tr>

                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

    @push('js')
        <script src="{{ asset('assets/js/import_dataset.js') }}"></script>
    @endpush
@endsection
