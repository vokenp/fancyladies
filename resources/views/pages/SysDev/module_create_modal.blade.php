<?php
   $columns = json_decode($cols,true);
   $SysTbl = json_decode(getListItems('SystemTables'),true);
    $Systblist = array();
        foreach($SysTbl as $key => $sVal)
        {
            $Systblist[] = $sVal['item_code'];
        }
 ?>
<!-- Modal-->
<div class="modal fade" id="{{ $modalName }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create New Module</h5>
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
                        <label>Module Name:</label>
                        <input type="text" name="module_name" id="module_name" value="" class="form-control form-control-solid" placeholder="Enter Module Name" required/>
                    </div>
        
                    <div class="form-group col-sm-6">
                        <label>Menu Category:</label>
                        <select name="menucategory_id" class="form-control" id="menucategory_id" required>  
                            <option value=""></option>     
                            @foreach($menuCategory as $list)
                            <option value="{{ $list->id }}" >{{ $list->menu_title }}</option>
                          @endforeach
                        </select>
                    </div>
                   
                </div>

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label>Display Order:</label>
                        <input type="number" name="display_order" id="display_order"  value="" class="form-control form-control-solid" placeholder="Enter Display Order"  required/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Module Type:</label>
                        <select name="module_type" class="form-control" id="module_type" required>       
                            @foreach(getListItems('ModuleType') as $list)
                            <option value="{{ $list->item_code }}" >{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>
    
                </div>

                <div class="row">
                    
                    <div class="form-group col-sm-6">
                        <label>Page Link:</label>
                        <input type="text" name="page_link" id="page_link"  value="" class="form-control form-control-solid" placeholder="Enter Page Link"  />
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Model Name:</label>
                        <select name="model_name" class="form-control" id="model_name">
                            <option value=""></option>   
                            @foreach(getModels() as $models)
                            {{ $modName = substr($models, strrpos($models, '\\' )+1) }}
                            @if (!in_array($modName, $Systblist))
                            <option value="{{ $modName }}">{{ $modName }}</option>
                            @endif
                           
                          @endforeach
                        </select>
                    </div>
    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="flaticon-close"></i> Close</button>
                <button type="submit" class="btn btn-success font-weight-bold">Save</button>
            </div
            </form>
        </div>
    </div>
</div>
