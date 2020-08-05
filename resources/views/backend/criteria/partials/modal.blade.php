<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.criteria.store') }}" id="form-store">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kriteria</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Bobot Criteria</label>
            <input type="number" name="bobot" class="form-control">
          </div>
          <div class="form-group">
            <label>Type Criteria</label>
            <select name="type" class="form-control">
              <option value="0">Const</option>
              <option value="1">Benefit</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
