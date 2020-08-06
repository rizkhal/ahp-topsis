@push('scripts')
  <script src="{{ asset('backend/js/vendor/sweetalert.min.js') }}"></script>
@endpush
<div class="card card-primary">
  <div class="card-header">
    <h4>Matrix Criteria (AHP)</h4>
    <div class="card-header-action">
      <button type="button" onclick="generateMatrix();" class="btn btn-primary mb-3">Generate</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr id="table-matrix-interest-top">
            {{-- using dom --}}
          </tr>
        </thead>
        <tbody id="table-matrix-interest-bottom">
          {{-- using dom --}}
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card card-primary">
  <div class="card-header">
    <h4>Matrix Criteria (TOPSIS)</h4>
    <div class="card-header-action">
      <button type="button" onclick="generateMatrixPairWise();" class="btn btn-primary mb-3 float-right">Generate</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive" id="pairwise-body">
      {{-- using dom --}}
    </div>
  </div>
</div>
