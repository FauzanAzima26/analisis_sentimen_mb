@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- HEADER --}}
        <div class="row mb-4">

            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        <h3 class="mb-1">
                            Testing / Prediksi
                        </h3>

                        <p class="text-muted mb-0">
                            Prediksi sentimen tweet menggunakan model SVM dan SVM + SMOTE
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- FORM PREDIKSI --}}
        <div class="row mb-4">

            <div class="col-lg-5 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Input Prediksi
                        </h5>

                    </div>

                    <div class="card-body">

                        {{-- PILIH MODEL --}}
                        <div class="mb-4">

                            <label class="form-label d-block">
                                Pilih Model
                            </label>

                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="model" id="svm" value="SVM"
                                    checked>

                                <label class="form-check-label" for="svm">
                                    SVM
                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="model" id="svmSmote"
                                    value="SVM + SMOTE">

                                <label class="form-check-label" for="svmSmote">
                                    SVM + SMOTE
                                </label>

                            </div>

                        </div>

                        {{-- INPUT TWEET --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Tweet
                            </label>

                            <textarea id="tweet" class="form-control" rows="5" placeholder="Masukkan tweet..."></textarea>

                        </div>

                        {{-- BUTTON --}}
                        <button type="button" id="btnPredict" class="btn btn-primary w-100">

                            <i class="ti ti-brand-openai me-1"></i>

                            Analisis Sentimen

                        </button>

                    </div>

                </div>

            </div>

            {{-- HASIL --}}
            <div class="col-lg-7 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Hasil Prediksi
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row g-4">

                            {{-- MODEL --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block mb-1">
                                        Model
                                    </small>

                                    <h5 id="resultModel" class="mb-0">
                                        -
                                    </h5>

                                </div>

                            </div>

                            {{-- PREDIKSI --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block mb-1">
                                        Prediksi
                                    </small>

                                    <h5 id="resultPrediction" class="mb-0">
                                        -
                                    </h5>

                                </div>

                            </div>

                            {{-- CONFIDENCE --}}
                            <div class="col-12">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block mb-2">
                                        Confidence Score
                                    </small>

                                    <div class="progress">

                                        <div id="confidenceBar" class="progress-bar" role="progressbar" style="width: 0%">
                                            0%
                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- TWEET --}}
                            <div class="col-12">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block mb-2">
                                        Tweet
                                    </small>

                                    <p id="resultTweet" class="mb-0">
                                        -
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- UPLOAD CSV --}}
        <div class="row mb-4">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Upload CSV Testing
                        </h5>

                    </div>

                    <div class="card-body">

                        <form id="formCSV">

                            <div class="row g-3 align-items-end">

                                {{-- FILE --}}
                                <div class="col-md-6">

                                    <label class="form-label">
                                        File CSV
                                    </label>

                                    <input type="file" class="form-control" accept=".csv">

                                </div>

                                {{-- BUTTON --}}
                                <div class="col-md-3">

                                    <button type="submit" class="btn btn-primary w-100">

                                        <i class="ti ti-upload me-1"></i>

                                        Upload CSV

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        {{-- RIWAYAT PREDIKSI --}}
        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Riwayat Prediksi
                        </h5>

                    </div>

                    <div class="table-responsive text-nowrap px-3 pb-3">

                        <table id="predictionTable" class="table table-bordered table-hover">

                            <thead class="table-light">

                                <tr>

                                    <th width="40%">
                                        Tweet
                                    </th>

                                    <th width="15%" class="text-center">
                                        Model
                                    </th>

                                    <th width="15%" class="text-center">
                                        Prediksi
                                    </th>

                                    <th width="15%" class="text-center">
                                        Confidence
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                {{-- SAMPLE --}}
                                <tr>

                                    <td>
                                        Aplikasi sangat membantu
                                    </td>

                                    <td class="text-center">
                                        SVM
                                    </td>

                                    <td class="text-center">

                                        <span class="badge bg-label-success">
                                            Positif
                                        </span>

                                    </td>

                                    <td class="text-center">
                                        96%
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('js')
        <script src="{{ asset('assets/js/testing.js') }}"></script>
    @endpush
@endsection
