<x-app-layout title="Kelola Data Criteria">
    @push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/datatables/datatables-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/datatables/datatables-select-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendor/toast.min.css') }}">
    @endpush

    @push('scripts')
    <!-- Datatables -->
    <script src="{{ asset('backend/js/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/datatables/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/toast.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/sweetalert.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}

    <script type="text/javascript">
        $("#btn-add").click(function(e) {
            e.preventDefault();
            $("#modal-add").modal("show");
        });

        $("#form-store").submit(function(e) {
            e.preventDefault();

            let data = {},
            url  = $(this).attr('action');

            $.each($(this).serializeArray(), function() {
                data[this.name] = this.value;
            });

            $.ajax({
                url: url,
                dataType: "json",
                data: data,
                type: "post",
            }).always(function() {
                $("#form-store")[0].reset();
                $("#modal-add").modal("hide");
                $(".table").DataTable().ajax.reload();
            }).done(function(response) {
                iziToast.success({
                    title: response.title,
                    message: response.message,
                    position: 'topRight'
                });
            }).fail(function(xhr, status, error) {
                iziToast.error({
                    title: response.title,
                    message: response.message,
                    position: 'topRight'
                });
            });
        });
        
        $(document).on("click", ".btn-destroy", function() {
            swal({
                title: "Yakin untuk menghapus?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: $(this).data('url'),
                        type: "post",
                        data: {
                            _method: "DELETE",
                        },
                    }).done(function(response) {
                        iziToast.success({
                            title: response.title,
                            message: response.message,
                            position: 'topRight'
                        });
                        
                        $(".table").DataTable().ajax.reload();
                    });
                }
            });
        });
    </script>

    @endpush

    @section("app")
    <section class="section">
        {{-- breadcrumb --}}
        <x-breadcrumb title="Criteria"></x-breadcrumb>
        <div class="section-body">
            <a href="#" id="btn-add" class="btn btn-add btn-primary mb-2">Tambah</a>
            <div class="card">
                <div class="card-body">
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>
    </section>
    @include("backend::criteria.partials.modal")
    @stop
</x-app-layout>
