<!--begin::Form-->
    <form class="form" id="formDataInfo" name="formDataInfo">
        @csrf
        <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
        <!--begin::Body-->
        <div class="card-body">
        
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Member ID NO:</label>
                    <input type="text" name="member_idno" id="member_idno" value="{{ $rst->member_idno ?? "" }}" class="form-control   form-control-solid form-control   form-control-solid-solid" placeholder="Enter Member ID No" readonly/>
                </div>

                <div class="form-group col-sm-6">
                    <label>Member Name:</label>
                    <input type="text" name="member_name" id="member_name" value="{{ $rst->member_name ?? "" }}" class="form-control   form-control-solid form-control   form-control-solid-solid" placeholder="Enter Member Name" required/>
                </div>
            
            </div>
           
            <div class="row">
               
                <div class="form-group col-sm-6">
                    <label>Member Occupation:</label>
                    <input type="text" name="member_occupation" id="member_occupation"  value="{{ $rst->member_occupation ?? "" }}" class="form-control   form-control-solid form-control   form-control-solid-solid" placeholder="Enter Occupation" />
                </div>
    
                <div class="form-group col-sm-6">
                    <label>Member Date of Birth:</label>
                    <input type="date" name="member_dob" id="member_dob"  value="{{ $rst->member_dob ?? "" }}" class="form-control   form-control-solid form-control   form-control-solid-solid" placeholder="Enter DOB" />
                </div>
               
            </div>
           
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Member Gender:</label>
                    <select name="member_gender" class="form-control   form-control-solid" id="member_gender" required>
                               
                        @foreach(getListItems('Gender') as $list)
                        {{ $selected = $rst->member_gender == $list->item_code ? "selected" : ""}}
                        <option value="{{ $list->item_code }}" {{ $selected }}>{{ $list->item_description }}</option>
                      @endforeach
                    </select>
                </div>
    
                <div class="form-group col-sm-6">
                    <label>Martial Status:</label>
                    <select name="member_martialstatus" class="form-control   form-control-solid" id="member_martialstatus" required>
                               
                        @foreach(getListItems('MaritalStatus') as $list)
                        {{ $selected = $rst->member_martialstatus == $list->item_code ? "selected" : ""}}
                        <option value="{{ $list->item_code }}" {{ $selected }}>{{ $list->item_description }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
    
    
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Member PhoneNo:</label>
                    <input type="text" name="member_phoneno" id="member_phoneno"  value="{{ $rst->member_phoneno ?? "" }}" class="form-control   form-control-solid form-control   form-control-solid-solid" placeholder="Enter Phone No" required/>
                </div>
    
                <div class="form-group col-sm-6">
                    <label>Member Email:</label>
                    <input type="email" name="member_email" id="member_email"  value="{{ $rst->member_email ?? "" }}" class="form-control   form-control-solid form-control   form-control-solid-solid" placeholder="Enter Email"  required/>
                </div>
            </div>
            
        </div>
        <!--end::Body-->
        <div class="card-footer">
            <button type="submit" id="btnSave" class="btn btn-success mr-2">Save Changes</button>
            <a href="{{ route($tblContent) }}" class="btn btn-secondary" >Cancel</a>
        </div>
    </form>
    <!--end::Form-->