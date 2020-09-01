<div class="card card-primary">
    <div class="card-header">
        <h4>Detail</h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Catatan</label>
            <textarea name="notes" class="@error('is-invalid') is-invalid @enderror form-control">{{ old("notes", "This is for testing.") }}</textarea>

            @error('notes')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
