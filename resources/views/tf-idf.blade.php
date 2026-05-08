@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">
                        TF-IDF
                    </h3>

                    <p class="text-muted mb-0">
                        Proses pembobotan kata menggunakan TF-IDF
                    </p>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive text-nowrap px-3 pb-3">

                <table id="tfidfTable" class="table table-bordered table-hover" data-url="{{ route('tfidf.data') }}">

                    <thead class="table-light">

                        <tr>

                            {{-- NO --}}
                            <th width="5%" class="text-center">
                                NO
                            </th>

                            {{-- TERM --}}
                            <th class="text-center">
                                TERM
                            </th>

                            {{-- TF-IDF --}}
                            <th class="text-center">
                                TF-IDF
                            </th>

                        </tr>

                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

    @push('js')
        <script src="{{ asset('assets/js/tf-idf.js') }}"></script>
    @endpush
@endsection
