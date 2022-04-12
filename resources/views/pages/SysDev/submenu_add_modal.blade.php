<!-- Modal-->
<div class="modal fade" id="AddSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="flaticon-close"></i>
                </button>
            </div>
            <form id="formDataAdd" name="formDataAdd">
               
                <input type="hidden" name="row_id2" id="row_id2" value="">
                <input type="hidden" name="menucategory_id" id="menucategory_id" value="{{ $rst->id ?? "" }}">
            <div class="modal-body">
               
                <div class="row">
                    <div class="form-group col-sm-10">
                        <label>Menu Title:</label>
                        <input type="text" name="title" id="title" value="" class="form-control form-control-solid" placeholder="Enter Menu Title" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-10">
                        <label>Menu Page:</label>
                        <input type="text" name="page" id="page" value="" class="form-control form-control-solid" placeholder="Enter Menu page" required/>
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
