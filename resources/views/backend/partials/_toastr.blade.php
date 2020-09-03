<!-- toastr -->
<script src="https://demo.getstisla.com/assets/modules/izitoast/js/iziToast.min.js"></script>
<script src="https://demo.getstisla.com/assets/js/page/modules-toastr.js"></script>

@if (session()->has('notice'))
    @php
        $values = session()->get('notice');
        dd($values);
    @endphp
    @if (is_array($values))
        <script type="text/javascript">
            @foreach ($values as $value)
                iziToast.{{$value['type']}}({
                    message: '{{$value['message']}}',
                    position: 'topRight'
                });
            @endforeach
        </script>
    @endif
    @php
        session()->forget('notice');
    @endphp
@endif
<!-- end toastr -->
