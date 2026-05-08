@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="mb-1">
                        Text Processing
                    </h3>

                    <p class="text-muted mb-0">
                        Proses preprocessing dataset tweet
                    </p>
                </div>

                {{-- BUTTON PREPROCESSING --}}
                <button type="button" id="btnPreprocessing" class="btn btn-primary">
                    <i class="ti ti-player-play me-1"></i>
                    Run Preprocessing
                </button>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive text-nowrap px-3 pb-3">

                <table id="preprocessing" class="table table-bordered table-hover" data-url="{{ route('dataset.data') }}"
                    data-process-url="{{ route('text-processing.data') }}">

                    <thead class="table-light">

                        <tr>

                            {{-- NO --}}
                            <th width="5%" class="text-center">
                                NO
                            </th>

                            {{-- TWEET ASLI --}}
                            <th width="45%">
                                TWEET SEBELUM PREPROCESSING
                            </th>

                            {{-- TWEET CLEAN --}}
                            <th width="45%">
                                TWEET SESUDAH PREPROCESSING
                            </th>

                        </tr>

                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

    @push('js')
        <script src="{{ asset('assets/js/text_processing.js') }}"></script>
    @endpush
@endsection
