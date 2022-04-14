<div class="row">
    <div class="form-group mr-5">
        <div class="col-md-12"><label>Choose a SMS Group Below:</label></div>
        <div class="col-md-12">
        <select name="send_groups[]" id="send_groups" class="chzn-select" multiple="multiple" style="width: 40em">          
            @foreach($smsGroups as $list)
            <option value="{{ $list->id }}" >{{ $list->group_name }}</option>
            @endforeach
            </select>
        </div>
    </div>
  
</div>