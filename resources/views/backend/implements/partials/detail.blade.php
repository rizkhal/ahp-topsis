<div class="card card-primary">
    <div class="card-header">
        <h4>Detail</h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Judul Perhitungan</label>
            <input type="text" name="title" class="form-control" value="{{ old("title") }}" required>
        </div>
        <div class="form-group">
            <label>Deskripsi Perhitungan</label>
            <textarea name="description" class="form-control" required>{{ old("description") }}</textarea>
        </div>
    </div>
</div>
