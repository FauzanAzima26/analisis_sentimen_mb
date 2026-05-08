@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- HEADER --}}
        <div class="row mb-4">

            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        <h3 class="mb-1">
                            Perbandingan Model
                        </h3>

                        <p class="text-muted mb-0">
                            Evaluasi performa model SVM dan SVM + SMOTE
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- A. TABEL PERFORMA --}}
        <div class="row mb-4">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Tabel Performa Model
                        </h5>

                    </div>

                    <div class="table-responsive px-3 pb-3">

                        <table class="table table-bordered table-hover">

                            <thead class="table-light">

                                <tr>

                                    <th width="30%">
                                        Metric
                                    </th>

                                    <th class="text-center">
                                        SVM
                                    </th>

                                    <th class="text-center">
                                        SVM + SMOTE
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>Accuracy</td>

                                    <td class="text-center">
                                        89.21%
                                    </td>

                                    <td class="text-center text-success fw-bold">
                                        96.49%
                                    </td>

                                </tr>

                                <tr>

                                    <td>Precision</td>

                                    <td class="text-center">
                                        88%
                                    </td>

                                    <td class="text-center text-success fw-bold">
                                        96%
                                    </td>

                                </tr>

                                <tr>

                                    <td>Recall</td>

                                    <td class="text-center">
                                        87%
                                    </td>

                                    <td class="text-center text-success fw-bold">
                                        95%
                                    </td>

                                </tr>

                                <tr>

                                    <td>F1-Score</td>

                                    <td class="text-center">
                                        87%
                                    </td>

                                    <td class="text-center text-success fw-bold">
                                        95%
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        {{-- RADAR CHART --}}
        <div class="row mb-4">

            <div class="col-lg-6 col-12 mb-6">

                <div class="card">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Radar Chart Comparison
                        </h5>

                    </div>

                    <div class="card-body pt-2">

                        <canvas class="chartjs" id="radarChart" data-height="355"></canvas>

                    </div>

                </div>

            </div>

        </div>

        {{-- CONFUSION MATRIX --}}
        <div class="row">

            {{-- SVM --}}
            <div class="col-md-6 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Confusion Matrix SVM
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered text-center">

                                <thead class="table-light">

                                    <tr>

                                        <th></th>

                                        <th>
                                            Predicted Positive
                                        </th>

                                        <th>
                                            Predicted Negative
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <th class="table-light">
                                            Actual Positive
                                        </th>

                                        <td>120</td>

                                        <td>15</td>

                                    </tr>

                                    <tr>

                                        <th class="table-light">
                                            Actual Negative
                                        </th>

                                        <td>18</td>

                                        <td>110</td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

            {{-- SVM + SMOTE --}}
            <div class="col-md-6 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h5 class="card-title mb-0">
                            Confusion Matrix SVM + SMOTE
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered text-center">

                                <thead class="table-light">

                                    <tr>

                                        <th></th>

                                        <th>
                                            Predicted Positive
                                        </th>

                                        <th>
                                            Predicted Negative
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <th class="table-light">
                                            Actual Positive
                                        </th>

                                        <td>130</td>

                                        <td>5</td>

                                    </tr>

                                    <tr>

                                        <th class="table-light">
                                            Actual Negative
                                        </th>

                                        <td>4</td>

                                        <td>128</td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('js')
    @endpush
@endsection
