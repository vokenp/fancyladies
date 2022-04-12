<div class="d-flex flex-column-fluid">
    <div class="container"> <!--begin::Container-->
        <div class="card card-custom gutter-b"><!--Begin::Card-->
            <!--begin::Header-->
            <div class="card-header py-3 bg-gray-700">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-white">{{ $rst->member_name }} Profile</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1 text-white">Update personal informaiton</span>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route($tblContent) }}" class="btn btn-sm btn-pill btn-outline-warning font-weight-bolder text-white" title="Back to List"><i class="flaticon2-left-arrow-1"></i> Back to List </a>
                </div>
            </div>
            <!--end::Header-->
            <div class="card-body"><!--Begin::Body-->
                <div class="d-flex">
                <!--begin::Pic-->
                <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                        <span class="font-size-h3 symbol-label font-weight-boldest">DS</span>
                    </div>
                </div>
                <!--end::Pic-->

                <!--begin: Info-->
                    <div class="flex-grow-1">
                    <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                     <!--begin::Name-->
                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $rst->member_name }}</a>
                             <!--end::Name-->
                                <span class="label label-light-success label-inline font-weight-bolder mr-2 font-size-h5">{{ $rst->member_no }}</span>
                        </div>

                        </div>
                        <!--begin::User-->
                                <!--begin::Actions-->
                            <div class="mb-10">
                                <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Send SMS</a>

                            </div>
                        <!--end::Actions-->
                        </div>  <!--end::Title-->
                        
                        <!--begin::Content-->
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                             Some Info Should Come Here

                            </div>
                            <!--end::Content-->
                        </div>
                    <!--end::Info-->
                </div><!--End::d-flex-->
            </div><!--End::Body-->
        </div><!--End::Card-->

        <!--begin::Card-->
<div class="card card-custom">
<!--Begin::Header-->
<div class="card-header card-header-tabs-line">
<div class="card-toolbar">
<ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
<li class="nav-item mr-3">
    <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
    <span class="nav-icon mr-2">
     <span class="svg-icon mr-3"> </span>
    </span>
<span class="nav-text font-weight-bold">Member Bio Info</span>
</a>
</li>

<li class="nav-item mr-3">
<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
    <span class="nav-icon mr-2"></span>
    <span class="nav-text font-weight-bold">Contributions</span>
</a>
</li>

<li class="nav-item mr-3">
<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
    <span class="nav-icon mr-2"></span>
    <span class="nav-text font-weight-bold">Plegdes</span>
</a>
</li>

<li class="nav-item mr-3">
<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_5">
    <span class="nav-icon mr-2"></span>
    <span class="nav-text font-weight-bold">Prayer Requests</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
    <span class="nav-icon mr-2"></span>
    <span class="nav-text font-weight-bold">Notes</span>
    </a>
</li>
</ul>
</div>
</div>
<!--end::Header-->
<!--Begin::Body-->
<div class="card-body">
    <div class="tab-content pt-5">
        <!--begin::Tab Content-->
         <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
            @include('pages.Apps.Membership.memberinfo_tab')
         </div> <!--end::Tab2 Content-->

        <!--begin::Tab Content-->
            <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                @include('pages.Apps.Membership.membercontribution_tab')
            </div> <!--end::Tab3 Content-->

        <!--begin::Tab Content-->
            <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                @include('pages.Apps.Membership.memberpledges_tab')
            </div> <!--end::Tab4 Content-->

         <!--begin::Tab Content-->
            <div class="tab-pane" id="kt_apps_contacts_view_tab_5" role="tabpanel">
                @include('pages.Apps.Membership.memberprayerreqs_tab')
         </div> <!--end::Tab5 Content-->

        <!--begin::Tab Content-->
            <div class="tab-pane" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                @include('pages.Apps.Membership.membernotes_tab')
            </div> <!--end::Tab1 Content-->


</div>
</div>

<!--end::Body-->
</div> <!--end::Card-->



    </div> <!--End::Container-->
</div><!--End:d-flex flex-column-fluid-->


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

        $("#formDataInfo").validate({
            debug: false,
            rules: {
            
            },
            messages: {
              
            },
            submitHandler: function(form) {
            // do other stuff for a valid form
            $.ajax({
                data: $('#formDataInfo').serialize(),
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