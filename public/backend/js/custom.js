/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

var criterias = [];
var candidates = [];
var numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "."];

const generateMatrix = () => {
    criterias = [];
    var tbody = '';
    var tr = `<th scope="col" class="text-center">#</th>`;
    var flag = false;
    var element = document.querySelectorAll("input.criteria");

    if (element[0].value == "") {
        swal({
            title: "Oops...",
            icon: "error",
            text: "Criteria tidak boleh kosong.",
        });
        return false;
    }

    element.forEach((el, i) => {

        if (criterias.includes(el.value)) {
            flag = true;
            if (el.value != "") {
                swal({
                    title: "Oops...",
                    icon: "error",
                    text: `Criteria "${el.value}" sudah ada.`,
                });
            }
        }

        criterias.push(el.value);

        var td = '';
        tr += `<th scope="col" class="text-center">${el.value}</th>`;
        for (var j = 0; j < element.length; j++) {
            if (element[j].value != "" && element[i].value != "") {
                td += '<td><input style="min-width:100px!important;" type="text" name="ahp[' + i + '][' + j + ']" class="form-control table-input" id="table-input-' + i + '-' + j + '" data-i="' + i + '" data-j="' + j + '" value="' + (i == j ? '1' : '') + '" ' + (i == j ? 'readonly ' : 'onKeyUp="return checkInputMatrix(this);"') + 'required /></td>';
            }
        }

        tbody += `
          <tr>
            <th scope="row" class="black white-text text-center">${el.value}</th>
            ${td}
          </tr>`;

    });
    if (!flag) {
        document.getElementById("table-matrix-interest-top").innerHTML = tr;
        document.getElementById("table-matrix-interest-bottom").innerHTML = tbody;
    }
};

const checkInputMatrix = (trig) => {
    var str = trig.value;
    var nstr = "";

    for (var i = 0; i < str.length; i++) {
        nstr += str[i];
    }

    if (str[str.length - 1] == ".") {
        return true;
    }

    nstr = nstr === "" ? "" : parseFloat(nstr);
    trig.Value = nstr;

    var i = $(trig).data('i');
    var j = $(trig).data('j');

    if (nstr !== '') {

        if (nstr == 1) {
            $('#table-input-' + j + '-' + i).val("1");
        } else {
            $('#table-input-' + j + '-' + i).val(1/nstr);
        }

        var nextEl = null;
        var increment = null;
        
        if ($('#table-input-' + i + '-' + (j + 1)).length > 0) {
            j++;
            nextEl = $('#table-input-' + i + '-' + (j));
            increment &= j;
        } else if ($('#table-input-' + (i + 1) + '-0').length > 0) {
            i++;
            j = 0;
            increment &= i;
            nextEl = $('#table-input-' + (i) + '-0');
        }
        if (nextEl) {
            if (i != j) {
                increment++;
            }
        }
    } else {
        $('#table-input-' + j + '-' + i).val('');
    }
};

const checkPairWiseMatrix = (trig, c) => {
    var str = $(trig).val();
    var nstr = '';

    for (let i = 0; i < str.length; i++) {
        if (numbers.includes(str[i])) {
            nstr += str[i];
        }
    }

    nstr = nstr === '' ? '' : parseFloat(nstr);
    $(trig).val(nstr);

    var i = $(trig).data('i');
    var j = $(trig).data('j');
    var table = $('#table-' + c + '-input-' + j + '-' + i);
    if (nstr !== '') {
        if (nstr == 1) {
            table.val("1");
        } else {
            table.val(1/nstr);
        }
    } else {
        table.val('');
    }
};

const generateMatrixPairWise = () => {
    $('#pairwise-body').html('');

    candidates = [];

    var flag = false;
    var input = $("input.alternative");

    if (input.val() == "") {
        swal({
            title: "Oops...",
            icon: "error",
            text: "Candidate tidak boleh kosong.",
        });
        return false;
    }

    $.each(input, function (i, element) { 
        var candidate = $(element).val();

        if(candidates.includes(candidate)){
            flag = true;
        }

        if (candidate != "") {
            candidates.push(candidate);
        }
    });

    if (criterias.length < 1) {
        swal({
            title: "Oops...",
            icon: "error",
            text: "Criteria tidak boleh kosong.",
        });
        return false;
    }

    if(!flag){
        criterias.forEach((element, i) => {
            printQuantitativeMatrix(element, i);
        });
    }
};

const printQuantitativeMatrix = (criteria_name, c) => {
    var size = candidates.length;
    var tbody = '';
    var i =0;
    candidates.forEach(element => {
        tbody += `
            <tr>
                <td>`+element+`</td>
                <td><input style="min-width:100px!important;" type="text" name=topsis[`+c+`][]" placeholder="Masukan Nilai" class="table-input form-control" value="" id="table-quantitative-`+c+`-`+i+`" required></td>
            </tr>
        `;
        i++;
    });
    var html = (c+1) + `. Data Alternative untuk Criteria : <strong>`+criteria_name+`</strong>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="black white-text">
                            <tr>
                                <th>Alternative</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            `+tbody+`
                        </tbody>
                    </table>
                </div>
                `;
    $('#pairwise-body').append(html);
};

// not use in this app
const printPairWiseMatrix = (criteria_name, c) => {
    var size = candidates.length;
    var tr = `<th scope="col" class="text-center">#</th>`;

    candidates.forEach(element => {
        tr+=`<th scope="col" class="text-center">`+ element +`</th>`;
    });
    var tbody = '';
    for (let i = 0; i < size; i++) {
        var td = '';
        
         for (let j = 0; j < size; j++) {
             td+='<td><input style="min-width:100px!important;" type="text" name="pairwise['+c+']['+i+']['+j+']" class="form-control table-input" id="table-'+c+'-input-'+i+'-'+j+'" data-i="'+i+'" data-j="'+j+'" value="'+ (i == j ? '1' : '') +'" ' + (i == j ? 'readonly ' : 'onKeyUp="return checkPairWiseMatrix(this,'+c+');"') + 'required/></td>';
         }

         tbody+=`<tr>
                    <th scope="row" class="black white-text text-center">`+candidates[i]+`</th>
                    `+td+`
                </tr>`
    }
    var html = (c+1) + `. PairWise Matrix for Criteria : <strong>`+criteria_name+`</strong>
                <table class="table table-striped">
                    <thead class="black white-text">
                        <tr>
                            `+tr+`
                        </tr>
                    </thead>
                    <tbody>
                        `+tbody+`
                    </tbody>
                </table>`;
    $('#pairwise-body').append(html);
};


