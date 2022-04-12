<div class="card card-custom  col-md-10 mx-auto">
    <div class="card-header bg-gray-700  flex-wrap border-0 pt-6 pb-0">
        <div class="card-title"> <h3 class="card-label text-white"> Create New {{  $page_title}}</h3></div>
        <div class="card-toolbar">
            <a href="{{ route($tblContent) }}" class="btn btn-sm btn-pill btn-outline-warning font-weight-bolder text-white" title="Back to List"><i class="flaticon2-left-arrow-1"></i> Back</a>
        </div>
    
    </div>
    <form id="formData" name="formData">
        @csrf
        <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
    <div class="card-body">
        
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Member Name:</label>
                <input type="text" name="member_name" id="member_name" value="{{ $rst->member_name ?? "" }}" class="form-control form-control-solid" placeholder="Enter Member Name" required/>
            </div>

            <div class="form-group col-sm-6">
                <label>Member Date of Birth:</label>
                <input type="date" name="member_dob" id="member_dob"  value="{{ $rst->member_dob ?? "" }}" class="form-control form-control-solid" placeholder="Enter DOB"  required/>
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

    <div class="card-footer bg-gray-400 d-flex justify-content-center">
        <button type="submit" name="btnSave" id="btnSave" class="btn btn-success">Save Record</button>
    </div>
</form>
</div>
@section('scripts')
<script>
    $(function () {
        // success alert
        function swal_success() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Record Successfully Saved',
                showConfirmButton: false,
                timer: 1000
            });
            $(window.location).attr('href', '{{ route($tblContent) }}');
        }
        // error alert
        function swal_error(data) {
            Swal.fire({
                position: 'centered',
                icon: 'error',
                title: data,
                showConfirmButton: true,
            })
        }
     

     
   
        
       
        // statusing

    });

</script>
@endsection