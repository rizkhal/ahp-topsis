<x-app-layout title="Semua Data Tersimpan">
    @push('styles')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('backend/css/vendor/datatables/datatables-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/vendor/datatables/datatables-select-bs4.min.css') }}">
    @endpush

    @push('scripts')
        <!-- DataTables -->
        <script src="{{ asset('backend/js/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('backend/js/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('backend/js/vendor/datatables/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        {{$dataTable->scripts()}}

        <script lang="javascript">
            $(document).ready(function() {
                $(document).on('click', '.btn-destroy', function() {
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Data yang anda hapus tidak dapat dikembalikan.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: $(this).data('url'),
                                type: 'POST', 
                                data: {
                                    '_method': 'DELETE'
                                }
                            }).done(function(response) {
                                $('.table').DataTable().ajax.reload();
                                notif(response.type, response.message);
                            }).fail(function(error) {
                                notif(response.type, response.message);
                            });
                        } else {
                            iziToast.info({
                                message: 'Maaf, terjadi kesalahan.',
                                position: 'topRight'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Students"></x-breadcrumb>
            <div class="section-body">
                <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-2" style="color:white;">
                    <i class="fa fa-plus"></i> Tambah
                </a>
                <div class="card">
                    <div class="card-body">
                        {{$dataTable->table()}}
                    </div>
                </div>
            </div>
        </section>
    @stop
</x-app-layout>
