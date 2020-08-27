<x-app-layout title="Tambah Siswa">
    @push('styles')
        <style type="text/css">
            select {
               -o-appearance: none;
               -ms-appearance: none;
               -webkit-appearance: none;
               -moz-appearance: none;
               appearance: none;
            }
            textarea.form-control {
                min-height: 7em!important;
            }
        </style>
    @endpush

    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Tambah Siswa Baru"></x-breadcrumb>
            <div class="section-body">

                <form method="POST" action="{{ route('admin.students.store') }}">
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
                                        <label>Nomor Induk</label>
                                        <input type="number" name="nis" class="@error('nis') is-invalid @enderror form-control" value="{{ old("nis") }}">
                                        @error('nis')
                                            <span class="invalid-feedback">{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="gender" class="@error('gender') is-invalid @enderror form-control">
                                            <option selected disabled></option>
                                            @foreach ($genders as $key => $gender)
                                                <option value="{{$key}}">{{$gender}}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="address" class="@error('address') is-invalid @enderror form-control">{{ old('address') }}</textarea>
                                        @error('address')
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
