<!-- Modal-->
<div class="modal fade" id="expenses_edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
               <div class="modal-body">
               
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Expenses Date:</label>
                        <input type="date" name="expense_date" id="expense_date"  class="form-control form-control-solid" placeholder="Enter Expenses Date" required/>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Expenses Name:</label>
                        <input type="text" name="expense_name" id="expense_name"  class="form-control form-control-solid" placeholder="Enter Expenses Name" required/>
                    </div>
                   
                </div>
                
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Expense Amount:</label>
                        <input type="number" name="expense_amount" id="expense_amount"  class="form-control form-control-solid" placeholder="Enter Expense Amount" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Mode of Payment:</label>
                        <input type="text" name="expense_mop" id="expense_mop"  class="form-control form-control-solid" placeholder="Enter Expense Mode of Payment e.g Cash" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Remarks:</label>
                        <textarea name="expense_remarks" id="expense_remarks"  class="form-control form-control-solid" rows="3"></textarea>
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