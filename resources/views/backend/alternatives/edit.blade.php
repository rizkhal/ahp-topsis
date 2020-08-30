<x-app-layout title="Ubah Data Alternative {{ $row->name }}">
    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Ubah Data Alternative"></x-breadcrumb>
            <div class="section-body">

                <form method="POST" action="{{ route('admin.alternatives.update', $row->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" value="{{ old("title", $row->name) }}">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="@error('description') is-invalid @enderror form-control">{{ old('description', $row->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary float-right">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @stop
</x-app-layout>
