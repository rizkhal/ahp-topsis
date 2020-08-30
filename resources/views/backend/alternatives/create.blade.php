<x-app-layout title="Tambah Data Alternative">
    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Tambah Data Alternative"></x-breadcrumb>
            <div class="section-body">

                <form method="POST" action="{{ route('admin.alternatives.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" value="{{ old("title") }}">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="@error('description') is-invalid @enderror form-control">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @stop
</x-app-layout>
