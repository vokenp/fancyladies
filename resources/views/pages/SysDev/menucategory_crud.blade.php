<div class="card card-custom  col-md-10 mx-auto">
    <div class="card-header bg-gray-700  flex-wrap border-0 pt-6 pb-0">
        <div class="card-title"> <h3 class="card-label text-white">{{  $page_title}}</h3></div>
        <div class="card-toolbar">
            <a href="{{ route($tblContent) }}" class="btn btn-sm btn-pill btn-outline-warning font-weight-bolder text-white" title="Back to List"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    
    </div>
    <form id="formData" name="formData">
        <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
    <div class="card-body">
        
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Application Name:</label>
                <input type="text" name="application_name" id="application_name" value="{{ $rst->application_name ?? "" }}" class="form-control form-control-solid" placeholder="Enter Item Code"/>
            </div>
           
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Application Description:</label>
                <input type="text" name="application_description" id="application_description"  value="{{ $rst->application_description ?? "" }}" class="form-control form-control-solid" placeholder="Enter Item Description"/>
            </div>
        </div>

        

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Application IconRef:</label>
                <input type="text" name="application_iconref" id="application_iconref"  value="{{ $rst->application_iconref ?? "" }}" class="form-control form-control-solid" placeholder="Enter e.g fa fa-user"/>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Application Display Order:</label>
                <input type="number" name="display_order" id="display_order"  value="{{ $rst->display_order ?? "" }}" class="form-control form-control-solid" placeholder="Enter Display Order"/>
            </div>
        </div>
        
    </div>
</form>
    <div class="card-footer bg-gray-400 d-flex justify-content-center">
        <button type="submit" name="btnSave" id="btnSave" class="btn btn-success">Save Record</button>
    </div>
</div>