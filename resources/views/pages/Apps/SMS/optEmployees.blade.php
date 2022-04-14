<div class="row mt-2">
<div class="form-group mr-3">
    <div class="radio-inline">
        <label class="radio radio-square">
            <input type="radio" checked="checked" name="EmpSentTo" class="EmpSentTo" value="All"/>
            <span></span>
            All Employees
        </label>
        <label class="radio radio-square">
            <input type="radio" name="EmpSentTo" class="EmpSentTo" value="Specific"/>
            <span></span>
            Specific Employees
        </label>
    </div>
</div>
</div>
<div class="row" id="EmpSpecific" style="display:none;">
    <div class="form-group ">
        <div class="col-md-12"><label>Choose a Specific Employees Below:</label></div>
        <div class="col-md-12">
        <select name="Shopemployees[]" id="Shopemployees" class="chzn-select" multiple="multiple" style="width: 40em">          
            @foreach($Shopemployees as $list)
            <option value="{{ $list->id }}" >{{ $list->employee_name }}</option>
            @endforeach
            </select>
        </div>
    </div>
  
</div>