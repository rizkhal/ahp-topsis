<x-app-layout title="Semua Data Tersimpan">
    @push('styles')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('backend/css/vendor/datatables/datatables-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/vendor/datatables/datatables-select-bs4.min.css') }}">
    @endpush

    @push('scripts')
        <!-- Datatables -->
        <script src="{{ asset('backend/js/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('backend/js/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('backend/js/vendor/datatables/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        {{$dataTable->scripts()}}
    @endpush

    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Dashboard"></x-breadcrumb>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{$dataTable->table()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @stop
</x-app-layout>
