<x-app-layout title="Buat Perhitungan">

    @push('styles')
        <style lang="css">
            button[type='submit']:disabled {
                cursor: not-allowed;
                border: 1px solid #6274fc;
                background-color: #6274fc;
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

                @if (!$students->exists())
                    <div class="alert alert-info alert-has-icon">
                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                      <div class="alert-body">
                        <div class="alert-title">Info</div>
                        Data siswa masih kosong, silahkan tambahkan data siswa terlebih dahulu.
                      </div>
                    </div>
                @endif

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
                            <button type="submit" class="btn btn-primary float-right" {{(!$students->exists()) ? 'disabled' : ''}}>Hitung</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </section>
    @stop
</x-app-layout>
