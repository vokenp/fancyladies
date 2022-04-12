<!-- Modal-->
<div class="modal fade" id="employee_edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                        <label>Employee ID:</label>
                        <input type="text" name="employee_idno" id="employee_idno"  class="form-control form-control-solid" placeholder="Enter Employee ID" required/>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Employee Name:</label>
                        <input type="text" name="employee_name" id="employee_name"  class="form-control form-control-solid" placeholder="Enter Employee Name" required/>
                    </div>
                   
                </div>
                

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Employee Phone:</label>
                        <input type="text" name="employee_phoneno" id="employee_phoneno"  class="form-control form-control-solid" placeholder="Enter Employee Phone No" required/>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Employee Email:</label>
                        <input type="email" name="employee_email" id="employee_email"  class="form-control form-control-solid" placeholder="Enter Employee Email" required/>
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