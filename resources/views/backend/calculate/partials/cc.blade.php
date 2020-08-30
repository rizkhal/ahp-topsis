<div class="col-6 col-md-6 col-lg-6">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Candidate</h4>
            <div class="card-header-action">
                <button type="button" class="btn btn-sm btn-primary btn-clone-criteria">
                    <i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger btn-remove-criteria">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group criteria-container">
                <select name="candidate[]" class="criteria form-control"></select>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-md-6 col-lg-6">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Alternative</h4>
            <div class="card-header-action">
                <button type="button" class="btn btn-sm btn-primary btn-clone-alternative">
                    <i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger btn-remove-alternative">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group alternative-container">
                <select name="alternative[]" class="alternative form-control"></select>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/select2/dist/css/select2.min.css">
    <style type="text/css">
        .input-group-append > div {
            cursor: pointer;
        }
        .select2-container {
            margin-top: 1em!important;
        }
        .select2-selection__rendered {
            line-height: 3em!important;
        }
        .select2-container--default .select2-selection--single {
            width: 100%!important;
            border-color: #e4e6fc;
            background-color: #fdfdff;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://demo.getstisla.com/assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // custom select2
            const select2 = (element, url) => {
                element.select2({
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return data;
                        },
                        cache: true
                    }
                });
            };

            // enable / disable remove button
            const btnRemove = (element, btnRemove) => {
                if (element.length <= 1) {
                    btnRemove.prop('disabled', true);
                } else {
                    btnRemove.prop('disabled', false);
                }
            };

            // criteria
            btnRemove($('.criteria'), $('.btn-remove-criteria'));
            select2($('.criteria'), '{{ route("admin.json.student") }}');

            $('.btn-clone-criteria').click(function() {
                $('.criteria').select2('destroy');

                $(this).closest('.card').find('.criteria').first().clone(true).appendTo('.criteria-container');

                select2($('.criteria'), '{{ route("admin.json.student") }}');

                btnRemove($('.criteria'), $('.btn-remove-criteria'));
            });

            $('.btn-remove-criteria').click(function() {
                $(this).closest('.card').find('.select2').not(':first').last().remove();
                $(this).closest('.card').find('.criteria').not(':first').last().remove();

                btnRemove($('.criteria'), $('.btn-remove-criteria'));
            });

            // alternative
            btnRemove($('.alternative'), $('.btn-remove-alternative'));
            select2($('.alternative'), '{{ route("admin.json.alternative") }}');

            $('.btn-clone-alternative').click(function() {
                $('.alternative').select2('destroy');

                $(this).closest('.card').find('.alternative').first().clone(true).appendTo('.alternative-container');

                select2($('.alternative'), '{{ route("admin.json.alternative") }}');

                btnRemove($('.alternative'), $('.btn-remove-alternative'));
            });

            $('.btn-remove-alternative').click(function() {
                $(this).closest('.card').find('.select2').not(':first').last().remove();
                $(this).closest('.card').find('.alternative').not(':first').last().remove();

                btnRemove($('.alternative'), $('.btn-remove-alternative'));
            });
        });
    </script>
@endpush

