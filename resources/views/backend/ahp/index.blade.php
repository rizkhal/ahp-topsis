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
            <x-breadcrumb title="Analytical Hierarchy Process"></x-breadcrumb>
            <div class="section-body">
                <a href="{{ route('admin.ahp.create') }}" class="btn btn-primary mb-2">Buat Perhitungan</a>
                <div class="card">
                    <div class="card-body">
                        {{$dataTable->table()}}
                    </div>
                </div>
            </div>
        </section>
    @stop
</x-app-layout>
