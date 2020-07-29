<div class="card">
    <div class="card-header">
        <h4>Candidate</h4>
    </div>
    <div class="card-body">
        <div id="candidate-container" class="form-group">
            <label>Candidate</label>
            <div class="input-group">
                <input type="text" name="candidate[]" class="form-control">
                <div class="input-group-append">
                    <div class="input-group-text bg-primary" id="clone-candidate">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        let counter  = 0,
            candidate = document.getElementById("clone-candidate");

        candidate.addEventListener("click", () => {
            counter++;
            createElement("candidate-container", "div", "candidate-" + counter, element("criteria[]", counter));
        }, false);

        const element = (name, indent) => {
            return `
                <div class="input-group mt-2">
                    <input type="text" name="${name}" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text bg-danger" onclick="javascript:removeElement('candidate-${indent}'); return false;">
                            <i class="fas fa-minus text-white"></i>
                        </div>
                    </div>
                </div>
            `;
        };
    </script>
@endpush
