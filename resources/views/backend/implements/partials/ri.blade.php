@push('scripts')
  <script src="{{ asset('backend/js/vendor/sweetalert.min.js') }}"></script>
@endpush
<div class="card">
  <div class="card-header">
    <h4>Relative Interest Matrix</h4>
  </div>
  <div class="card-body">
    <button type="button" onclick="generateMatrix();" class="btn btn-primary mb-3 float-right">Generate</button>
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

<div class="card">
  <div class="card-header">
    <h4>Matrix Pair Wise</h4>
  </div>
  <div class="card-body">
    <button type="button" onclick="generateMatrixPairWise();" class="btn btn-primary mb-3 float-right">Generate</button>
    <div class="table-responsive" id="pairwise-body">
      {{-- using dom --}}
    </div>
  </div>
</div>
