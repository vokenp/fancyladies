<!-- Modal-->
<div class="modal fade" id="shopservices_edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                        <label>Service Name:</label>
                        <input type="text" name="service_name" id="service_name"  class="form-control form-control-solid" placeholder="Enter Service Name" required/>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Service Description:</label>
                        <textarea name="service_description" id="service_description" rows="4" class="form-control form-control-solid" placeholder="Enter Service Description" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Service Price:</label>
                        <input type="number" name="service_price" id="service_price"  class="form-control form-control-solid" placeholder="Enter Service Price" required/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Service Commission:</label>
                        <input type="number" name="service_commission" id="service_commission"  class="form-control form-control-solid" placeholder="Enter Service Commission" required/>
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