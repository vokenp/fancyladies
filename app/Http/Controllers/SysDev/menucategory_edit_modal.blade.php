<div class="modal fade" id="menucategory_create_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create New Menu Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="flaticon-close"></i>
                </button>
            </div>
            <form id="formData" name="formData">
                @csrf
                <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
            <div class="modal-body">
               
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Menu Title:</label>
                        <input type="text" name="menu_title" id="menu_title" value="{{ $rst->menu_name }}" class="form-control form-control-solid" placeholder="Enter Menu Title" required/>
                    </div>
        
                    <div class="form-group col-sm-6">
                        <label>Memu Icon:</label>
                        <input type="text" name="menu_icon" id="menu_icon"  value="{{ $rst->menu_icon ?? "" }}" class="form-control form-control-solid" placeholder="Enter Menu Icon"  required/>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Menu Bullet:</label>
                        <select name="menu_bullet" class="form-control" id="menu_bullet" required>
                                   
                            @foreach(getListItems('MenuBullet') as $list)
                            {{ $selected = $rst->menu_bullet == $list->item_code ? "selected" : ""}}
                            <option value="{{ $list->item_code }}" {{ $selected }}>{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>
        
                    <div class="form-group col-sm-6">
                        <label>Martial Status:</label>
                        <select name="menu_section" class="form-control" id="menu_section" required>
                                   
                            @foreach(getListItems('MenuSection') as $list)
                            {{ $selected = $rst->menu_section == $list->item_code ? "selected" : ""}}
                            <option value="{{ $list->item_code }}" {{ $selected }}>{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="flaticon-close"></i> Close</button>
                <button type="submit" class="btn btn-success font-weight-bold">Update Menu</button>
            </div
            </form>
        </div>
    </div>
</div>
