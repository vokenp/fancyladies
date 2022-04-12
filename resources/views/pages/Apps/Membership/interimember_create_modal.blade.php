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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create New Interim Member</h5>
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
                        <label>Member ID NO:</label>
                        <input type="text" name="member_idno" id="member_idno" value="" class="form-control form-control-solid" placeholder="Enter Member ID No" required/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Member Name:</label>
                        <input type="text" name="member_name" id="member_name" value="{{ $rst->member_name ?? "" }}" class="form-control form-control-solid" placeholder="Enter Member Name" required/>
                    </div>
                
                </div>
               
                <div class="row">
                   
                    <div class="form-group col-sm-6">
                        <label>Member Occupation:</label>
                        <input type="text" name="member_occupation" id="member_occupation"  v class="form-control form-control-solid" placeholder="Enter Occupation" />
                    </div>
        
                    <div class="form-group col-sm-6">
                        <label>Member Date of Birth:</label>
                        <input type="date" name="member_dob" id="member_dob"  value="{{ $rst->member_dob ?? "" }}" class="form-control form-control-solid" placeholder="Enter DOB" />
                    </div>
                   
                </div>
               
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Member Gender:</label>
                        <select name="member_gender" class="form-control" id="member_gender" required>
                                   
                            @foreach(getListItems('Gender') as $list)
                            
                            <option value="{{ $list->item_code }}" >{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>
        
                    <div class="form-group col-sm-6">
                        <label>Martial Status:</label>
                        <select name="member_martialstatus" class="form-control" id="member_martialstatus" required>
                                   
                            @foreach(getListItems('MaritalStatus') as $list)
                            
                            <option value="{{ $list->item_code }}" >{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
        
        
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Member PhoneNo:</label>
                        <input type="text" name="member_phoneno" id="member_phoneno"  value="{{ $rst->member_phoneno ?? "" }}" class="form-control form-control-solid" placeholder="Enter Phone No" required/>
                    </div>
        
                    <div class="form-group col-sm-6">
                        <label>Member Email:</label>
                        <input type="email" name="member_email" id="member_email"  value="{{ $rst->member_email ?? "" }}" class="form-control form-control-solid" placeholder="Enter Email"  required/>
                    </div>
                </div>
        

            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="flaticon-close"></i> Close</button>
                <button type="submit" class="btn btn-success font-weight-bold">Save Member</button>
            </div
            </form>
        </div>
    </div>
</div>
