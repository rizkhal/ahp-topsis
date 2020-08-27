<x-app-layout title="Buat Perhitungan">
    @push('styles')
        <style type="text/css">
            textarea.form-control {
                min-height: 7em!important;
            }
        </style>
    @endpush

    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Buat Perhitungan"></x-breadcrumb>
            <div class="section-body">
                <h2 class="section-title">Perhitungan AHP - TOPSIS</h2>
                <p class="section-lead">Perhitungan dibuat menggunakan metode AHP dan TOPSIS</p>

                <form method="POST" action="{{ route('admin.calculate.store') }}">
                    @csrf
                    <div class="row">                        
                        <div class="col-12 col-md-12 col-lg-12">
                            @include("backend::calculate.partials.detail")
                        </div>

                        @include("backend::calculate.partials.cc")

                        <div class="col-12 col-md-12 col-lg-12">
                            @include("backend::calculate.partials.ri")
                        </div>
                        <div class="col-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary float-right">Hitung</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @stop
</x-app-layout>
