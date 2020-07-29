<div class="card">
  <div class="card-header">
    <h4>Relative Interest Matrix</h4>
  </div>
  <div class="card-body">
    <button type="button" id="generate-matrix" class="btn btn-primary mb-3 float-right">Generate</button>
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

@push('scripts')
  <script type="text/javascript">
    var btn = document.getElementById("generate-matrix");
    var numbers = ["0","1","2","3","4","5","6","7","8","9","."];

    btn.addEventListener("click", () => {
      var tbody = '';
      var types = [];
      var criterias = [];
      var tr = `<th scope="col" class="text-center">#</th>`;

      var flag = false;
      var element = document.querySelectorAll("input.criteria");
      var size = element.length;

      if (element[0].value == "") {
        alert("heloooo");
        return false;
      }

      element.forEach((element, i) => {

        if (criterias.includes(element.value)) {
          flag = true;
          alert("helo world");
        }

        criterias.push(element.value);
        var td = '';
        tr+=`<th scope="col" class="text-center">${element.value}</th>`;

        for (var j = 0; j < size; j++) {
          td+='<td><input type="text" name="row['+i+']['+j+']" class="form-control table-input" id="table-input-'+i+'-'+j+'" data-i="'+i+'" data-j="'+j+'" value="'+ (i == j ? '1' : '') +'" ' + (i == j ? 'readonly ' : 'onKeyUp="return checkInputMatrix(this);"') + 'required /></td>';
        }

        tbody+=`
          <tr>
            <th scope="row" class="black white-text text-center">${element.value}</th>${td}
          </tr>`;
      });

      if (!flag) {
        document.getElementById("table-matrix-interest-top").innerHTML = tr;
        document.getElementById("table-matrix-interest-bottom").innerHTML = tbody;
      }

    }, false);

    const checkInputMatrix = (trig) => {
      str = trig.value;
      var nstr = "";

      for (var i = 0; i < str.length; i++) {
        nstr += str[i];
      }

      if (str[str.length-1] == ".") {
        return true;
      }

      nstr = nstr === "" ? "" : parseFloat(nstr);
      trig.value = nstr;

      var i = $(trig).data('i');
      var j = $(trig).data('j');

      if(nstr !== '') {
        var nextEl = null;
        var increment = null;
        $('#table-input-'+j+'-'+i).val('AUTO');

        if($('#table-input-'+i+'-'+(j + 1)).length > 0){
          j++;
          nextEl = $('#table-input-'+i+'-'+(j));
          increment &= j;
        }else if($('#table-input-'+(i + 1)+'-0').length > 0){
          i++;
          j=0;
          increment &= i;
          nextEl = $('#table-input-'+(i)+'-0');
        }

        if(nextEl){
          if(i!=j){
            increment++;
          }
        }

      }else{
        $('#table-input-'+j+'-'+i).val('');
      }
    };
  </script>
@endpush
