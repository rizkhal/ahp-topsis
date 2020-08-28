<div class="card card-primary">
    <div class="card-header">
        <h4>Detail</h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Siswa</label>
            <select name="student" class="@error('student') is-invalid @enderror form-control students">
                <option selected disabled></option>
                @foreach ($students->all() as $student)
                    <option value="{{$student->id}}">{{$student->name}}</option>
                @endforeach
            </select>

            @error('student')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Catatan</label>
            <textarea name="notes" class="@error('is-invalid') is-invalid @enderror form-control">{{ old("notes") }}</textarea>

            @error('notes')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
