@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- TITLE --}}
        <div class="mb-4">
            <h3 class="fw-bold">Dashboard Analisis Sentimen MBG</h3>
            <p class="text-muted">Visualisasi perbandingan SVM dan SVM + SMOTE</p>
        </div>

        {{-- ========================= --}}
        {{-- SVM SECTION --}}
        {{-- ========================= --}}
        <div class="container-xxl flex-grow-1 container-p-y pt-0">
            <h5 class="mb-3 fw-bold">Model SVM</h5>

            <div class="row g-6">

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-success h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="ti ti-mood-smile ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $svm_positif }}</h4>
                            </div>
                            <p class="mb-1">Positif</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="ti ti-mood-sad ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $svm_negatif }}</h4>
                            </div>
                            <p class="mb-1">Negatif</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-secondary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="ti ti-mood-neutral ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $svm_netral }}</h4>
                            </div>
                            <p class="mb-1">Netral</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="ti ti-database ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $total }}</h4>
                            </div>
                            <p class="mb-1">Total Data</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ========================= --}}
        {{-- SMOTE SECTION --}}
        {{-- ========================= --}}
        <div class="container-xxl flex-grow-1 container-p-y pt-0">

            <h5 class="mb-3 fw-bold">Model SVM + SMOTE</h5>

            <div class="row g-6">

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-success h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="ti ti-mood-smile ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $smote_positif }}</h4>
                            </div>
                            <p class="mb-1">Positif</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="ti ti-mood-sad ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $smote_negatif }}</h4>
                            </div>
                            <p class="mb-1">Negatif</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-secondary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="ti ti-mood-neutral ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $smote_netral }}</h4>
                            </div>
                            <p class="mb-1">Netral</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="ti ti-rocket ti-28px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $total }}</h4>
                            </div>
                            <p class="mb-1">Total Data</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ========================= --}}
        {{-- CHART SECTION --}}
        {{-- ========================= --}}
        <div class="row g-4">

            {{-- SVM --}}
            <div class="col-md-6 col-12 mb-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SVM Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div id="radialBarChartSVM"></div>
                    </div>
                </div>
            </div>

            {{-- SMOTE --}}
            <div class="col-md-6 col-12 mb-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SMOTE Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div id="radialBarChartSMOTE"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ========================= --}}
        {{-- SINGLE TWEET TEST --}}
        {{-- ========================= --}}
        <div class="container-xxl flex-grow-1 container-p-y pt-0">

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12">

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">Test Sentimen Single Tweet</h5>
                            <small class="text-muted">Coba model secara real-time (tanpa disimpan ke database)</small>
                        </div>

                        <div class="card-body">

                            <form id="singleTweetForm">
                                <textarea class="form-control" name="tweet" placeholder="Masukkan tweet..." maxlength="280" rows="4"></textarea>

                                <button type="submit" class="btn btn-primary mt-3 w-100">
                                    Test Sentimen
                                </button>
                            </form>

                            <div id="result" class="mt-3"></div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    </div>

    @push('js')
        <script>
            const svmData = {
                positif: {{ $svm_positif }},
                negatif: {{ $svm_negatif }},
                netral: {{ $svm_netral }},
                total: {{ $total }}
            };

            const smoteData = {
                positif: {{ $smote_positif }},
                negatif: {{ $smote_negatif }},
                netral: {{ $smote_netral }},
                total: {{ $total }}
            };
        </script>

        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endpush
@endsection
