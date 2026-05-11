@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="mb-1">
                        Hasil Prediksi Sentimen
                    </h3>

                    <p class="text-muted mb-0">
                        Hasil klasifikasi SVM dan SVM + SMOTE
                    </p>
                </div>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive px-3 pb-3">

                <table id="prediction" class="table table-bordered table-hover" data-url="{{ route('hasil-prediksi.data') }}">

                    <thead class="table-light">

                        <tr>

                            {{-- NO --}}
                            <th width="5%" class="text-center">NO</th>

                            {{-- TWEET --}}
                            <th width="35%">TWEET</th>

                            {{-- CLEAN TWEET --}}
                            <th width="25%">CLEAN TWEET</th>

                            {{-- SVM --}}
                            <th width="15%">SVM</th>

                            {{-- SMOTE --}}
                            <th width="15%">SVM + SMOTE</th>

                        </tr>

                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

    @push('js')
        <script src="{{ asset('assets/js/prediction.js') }}"></script>
    @endpush
@endsection
