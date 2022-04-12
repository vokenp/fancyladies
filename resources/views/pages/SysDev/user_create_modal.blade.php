<!-- Modal-->
<div class="modal fade" id="{{ $modalName }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="flaticon-close"></i>
                </button>
            </div>
            <form id="formData" name="formData">
                @csrf
                <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
            <div class="modal-body">
               
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Full Name:</label>
                        <input type="text" name="name" id="name" value="" class="form-control form-control-solid" placeholder="Enter Full Name" required/>
                    </div>
        
                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>User Phone No:</label>
                        <input type="text" name="phoneno" id="phoneno" value="" class="form-control form-control-solid" placeholder="Enter Phone No" required/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>User Email:</label>
                        <input type="email" name="email" id="email" value="" class="form-control form-control-solid" placeholder="Enter Email" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label> User Name:</label>
                        <input type="text" name="username" id="username" value="" class="form-control form-control-solid" placeholder="Enter User Name" required/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>User Type:</label>
                        <select name="user_type" class="form-control" id="user_type" required>  
                            <option></option>     
                            @foreach(getListItems('usertype') as $list)
                            <option value="{{ $list->item_code }}" >{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>
    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="flaticon-close"></i> Close</button>
                <button type="submit" id = "btnSubmit" class="btn btn-success font-weight-bold">Create User</button>
            </div
            </form>
        </div>
    </div>
</div>

