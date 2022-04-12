<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container">
<!--begin::Profile Personal Information-->
<div class="d-flex flex-row">
<!--begin::Aside-->
<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
<!--begin::Profile Card-->
<div class="card card-custom card-stretch">
    <!--begin::Body-->
    <div class="card-body pt-4">
        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end">
            

        </div>
        <!--end::Toolbar-->
        <!--begin::User-->
        <div class="d-flex align-items-center">
            <div>
            
                <div class="mt-2">
                    <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Reset Password</a>
                    <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Deactivate User</a>
                </div>
            </div>
        </div>
        <!--end::User-->
        <!--begin::Contact-->
        <div class="py-9">

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">User Name:</span>
                <span class="text-muted">{{ $rst->username }}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">User Type:</span>
                <span class="text-muted">{{ $rst->user_type }}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Created On:</span>
                <a href="#" class="text-muted text-hover-primary">{{ date_format($rst->created_at,'D jS M Y g:i A') }}</a>
            </div>
           
            <div class="d-flex align-items-center justify-content-between">
                <span class="font-weight-bold mr-2">Last Updated On:</span>
                <span class="text-muted">{{ date_format($rst->updated_at,'D jS M Y g:i A') }}</span>
            </div>
        </div>
        <!--end::Contact-->
        <!--begin::Nav-->
        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
            
            <div class="navi-item mb-2">
                <a href="#" class="navi-link py-4">
                    <span class="navi-icon mr-2"> <i class="flaticon-eye"></i></span>
                    <span class="navi-text font-size-lg">View Login Logs</span>
                </a>
            </div>

            <div class="navi-item mb-2">
                <a href="#" class="navi-link py-4">
                    <span class="navi-icon mr-2"> <i class="flaticon-eye"></i></span>
                    <span class="navi-text font-size-lg">View Active Log</span>
                </a>
            </div>
        
            
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Body-->
</div>
<!--end::Profile Card-->
</div>
<!--end::Aside-->
<!--begin::Content-->
<div class="flex-row-fluid ml-lg-8">
<!--begin::Card-->
<div class="card card-custom card-stretch">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">{{ $rst->name }} Profile</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Update personal informaiton</span>
        </div>
        <div class="card-toolbar">
            <a href="{{ route($tblContent) }}" class="btn btn-sm btn-pill btn-outline-info font-weight-bolder text-dark" title="Back to List"><i class="flaticon2-left-arrow-1"></i> Back to List </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form" id="formData" name="formData">
        @csrf
        <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
        <!--begin::Body-->
        <div class="card-body">
        
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Full Name</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ $rst->name ?? "" }}" id="name" name="name" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Phone No</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ $rst->phoneno ?? "" }}" name="phoneno" id="phoneno" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="email" value="{{ $rst->email ?? "" }}" name="email" id="email" required/>
                   
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                <div class="col-lg-9 col-xl-6">
                    <select name="user_type" class="form-control form-control-lg form-control-solid" id="user_type" required>  
                        <option></option>     
                        @foreach(getListItems('usertype') as $list)
                        {{ $selected = $rst->user_type == $list->item_code ? "selected" : ""}}
                        <option value="{{ $list->item_code }}" {{ $selected }}>{{ $list->item_description }}</option>
                      @endforeach
                    </select>
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
</div>
</div>
<!--end::Content-->
</div>
<!--end::Profile Personal Information-->
</div>
<!--end::Container-->
</div>

@section('scripts')

 {{-- page scripts --}}
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
           location.reload();
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

        function swal_success_delete() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Record Deleted Successfully',
                showConfirmButton: false,
                timer: 1000
            })
        }

        $("#formData").validate({
            debug: false,
            rules: {
            
            },
            messages: {
              
            },
            submitHandler: function(form) {
            // do other stuff for a valid form
            $.ajax({
                data: $('#formData').serialize(),
                url: "{{ route($storeAction) }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    data['success'] ? swal_success() :  swal_error(data['error']);
                    
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (data) {
                  // alert(JSON.stringify(data)); 
                   swal_error(data);
                   
                }
            });
            
            }
            });



        // statusing

    });

</script>
@endsection