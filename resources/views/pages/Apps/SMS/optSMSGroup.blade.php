<div class="row">
    <div class="form-group">
        <div class="col-md-5"> <label>Choose SMS Groups Below:</label></div>
        <div class="col-md-12">
            <select name="send_groups" id="send_groups" class="form-control chzn-select" multiple style="width:100%;"  >
               
                @foreach(getListItems('Country') as $list)
                <option value="{{ $list->item_code }}" >{{ $list->item_description }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>