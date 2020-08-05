<div class="col-6 col-md-6 col-lg-6">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Criteria</h4>
        </div>
        <div class="card-body">
            <div id="criteria-container" class="form-group">
                <label>Criteria</label>
                <div class="input-group">
                    <input type="text" name="criteria[]" class="criteria form-control">
                    <select name="type[]" class="form-control">
                        <option value="1">Qualitative</option>
                        <option value="0">Quantitative</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text bg-primary" id="clone-criteria">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-6 col-md-6 col-lg-6">
    <div class="card card-primary">
        <div class="card-header">
            <h4>Candidate / Alternative</h4>
        </div>
        <div class="card-body">
            <div id="candidate-container" class="form-group">
                <label>Candidate</label>
                <div class="input-group">
                    <input type="text" name="candidate[]" class="alternative form-control">
                    <div class="input-group-append">
                        <div class="input-group-text bg-primary" id="clone-candidate">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style type="text/css">
        .input-group-append > div {
            cursor: pointer;
        }
        select.form-control {
            cursor: pointer;
            -webkit-appearance: none;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        let counter   = 0,
            criteria  = document.getElementById("clone-criteria"),
            candidate = document.getElementById("clone-candidate");

        criteria.addEventListener("click", () => {
            counter++;

            var select = `
                        <select name="type[]" class="form-control">
                            <option value="1">Qualitative</option>
                            <option value="0">Quantitative</option>
                        </select>
                    `;

            createElement("criteria-container", "div", "criteria-" + counter, inputElements("criteria-"+counter, "criteria[]", "criteria", select));
        }, false);

        candidate.addEventListener("click", () => {
            counter++;
            createElement("candidate-container", "div", "candidate-"+counter, inputElements("candidate-"+counter, "candidate[]", "alternative"));
        }, false);

        const inputElements = (id, name, classes, type = "") => {
            return `
                <div class="input-group mt-2">
                    <input type="text" name="${name}" class="form-control ${classes}">
                    ${type}
                    <div class="input-group-append">
                        <div class="input-group-text bg-danger" onclick="javascript:removeElement('${id}'); return false;">
                            <i class="fas fa-minus text-white"></i>
                        </div>
                    </div>
                </div>
            `;
        };

        const createElement = (parentId, elementTag, elementId, html) => {
            var element    = document.getElementById(parentId),
                newElement = document.createElement(elementTag);

            newElement.setAttribute('id', elementId);
            newElement.setAttribute('class', elementTag);

            newElement.innerHTML = html;
            element.appendChild(newElement);
        };

        const removeElement = (elementId) => {
            var element = document.getElementById(elementId);
            element.parentNode.removeChild(element);
        };
    </script>
@endpush

