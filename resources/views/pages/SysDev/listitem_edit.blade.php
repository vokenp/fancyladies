<!-- Modal-->
<div class="modal fade" id="listitem_edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="flaticon-close"></i>
                </button>
            </div>
            <form id="formData2" name="formData2">
                @csrf
                <input type="hidden" name="row_id" id="row_id2" value="{{ $rst->id ?? "" }}">
               <div class="modal-body">
               
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Item Type:</label>
                        <select name="item_type" class="form-control" id="item_type2" >
                            <option value=''> -- Select Item --- </option>
                            @foreach($itemTypes as $item)
                            <option value="{{ $item->item_type }}">{{ $item->item_type }}</option>
                          @endforeach
                        </select> 
                    </div>   
                </div>
    
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Item Code:</label>
                        <input type="text" name="item_code" id="item_code2"  class="form-control form-control-solid" placeholder="Enter Item Code"/>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Item Description:</label>
                        <input type="text" name="item_description" id="item_description2"   class="form-control form-control-solid" placeholder="Enter Item Description"/>
                    </div>
                </div>
            

            </div>  <!-- End CardBody-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="flaticon-close"></i> Close</button>
                <button type="submit" id="btnSubmit" class="btn btn-success font-weight-bold">Save</button>
            </div
            </form>
        </div>
    </div>
</div>