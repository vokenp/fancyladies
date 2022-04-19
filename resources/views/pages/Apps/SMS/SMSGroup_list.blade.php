<?php
   $columns = json_decode($cols,true);
 ?>
<div class="card card-custom col-md-12 col-sm-12 col-lg-12 p-0">
    <div class="card-header bg-gray-700 ">
        <div class="card-title ">
            <h3 class="card-label text-white" ><i class="flaticon2-list-3 icon-2x mr-2 text-warning"></i> {{ @$page_title }}
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div> {{--  End Card Title --}}

        <div class="card-toolbar">
            <a href="{{ route($tblContent) }}"  class="btn btn-outline-warning btn-sm font-weight-bolder mr-1" title="Add Free Numbers"> <span class="svg-icon svg-icon-md">
                <i class="fa fa-arrow-left"></i></span> Back to List</a>
        </div> {{--  End ToolBar --}}
    </div> {{--  End Class Header --}}
    <div class="card-body ">
        <div class="row">
            <div class="py-2">

                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Group Name:</span>
                    <span class="font-weight-bold mr-3 text-success">{{ $rst->group_name }}</span>
                </div>
    
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Group Description:</span>
                    <span class="font-weight-bold mr-3 text-success">{{ $rst->group_description }}</span>
                </div>
    
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2 ">Created On:</span>
                    <span class="font-weight-bold mr-3 text-success">{{ date_format($rst->created_at,'D jS M Y g:i A') }}</span>
                </div>
               
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">Last Updated On:</span>
                    <span class="font-weight-bold mr-3 text-success">{{ date_format($rst->updated_at,'D jS M Y g:i A') }}</span>
                </div>
            </div>
        </div>
    </div> {{--  End card-body --}}

    <div class="card-body">
        <div class="row">
            <a href="#" id="AddNewFreeNums" class="btn btn-warning btn-sm font-weight-bolder mr-1" title="Add Free Numbers"> <span class="svg-icon svg-icon-md">
                <i class="flaticon2-plus text-white"></i></span>Add Group Member</a>
        </div> 

        <div class="col-md-12">
            <div class="table-responsive">
                <h2 ></h2>
                <table class="table table-hover table-striped" id="displayTable">
                   
                    <thead class="font-weight-bold text-center bg-success">
                        
                    </thead>
                    <tbody class="text-left">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer bg-gray-100 text-center">
        <button type="submit" class="btn btn-lg btn-success mr-2"><i class="fa fa-send"></i> Send SMS</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>  {{--  End Card-Footer --}}
</div>{{--  End Cardr --}}




@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script> 
 {{-- page scripts --}}
<script>
    $(function () {
          // success alert
          function swal_success() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1000
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
        // error alert
        function swal_error() {
            Swal.fire({
                position: 'centered',
                icon: 'error',
                title: 'Something Went wrong !',
                showConfirmButton: true,
            })
        }
         // table serverside
        var table = $('#displayTable').DataTable({
            processing: false,
            serverSide: true,
            ordering: false,
            sScrollX: "100%",
            scrollY: "45vh",
            lengthMenu: [[20,50, 100, 200], [20,50, 100, 200]],
            columns: <?php echo json_encode($columns);?>,
            ajax: {
                url: "{{ route($grouplistlink) }}",
                data: function (d) {
                    d.group_id = {{ $rst->id }};
                },
               
            },
            error: function(ep){  // error handling code
               // alert(JSON.stringify(ep));
               // $("#tblListView_processing").css("display","none");
              }
        });

        $("#formData2").validate({
            debug: false,
            rules: {
            
            },
            messages: {
              
            },
            submitHandler: function(form) {
            // do other stuff for a valid form
            $.ajax({
                data: $('#formData2').serialize(),
                url: "{{ route($groupStore) }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#smsGroup_list_edit').modal('hide');
                    swal_success();
                    $('#formData2').trigger("reset");
                    table.draw();
                },
                error: function (data) {
                   //alert(JSON.stringify(data)); 
                   swal_error(data);
                   
                }
            });
            
            }
            });

        $('#AddNewFreeNums').click(function(){
            $('#row_id').val("");
            $('#smsGroup_list_edit').modal('show');
            $('#modalLabel').html("Add New Group Record");
            $('#btnSubmit').html('Save Record');
           });


               // initialize btn Edit
          $('body').on('click', '.editRecord', function () {
            var row_id = $(this).data("id");
            
            $.ajax({
                type: "GET",
                url:  "/apps/smsgroup/"+row_id+"/groupedit/",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#smsGroup_list_edit').modal('show');
                    
                    $('#row_id').val(data["id"]);
                    $('#groupmember_name').val(data["groupmember_name"]);
                    $('#groupmember_phoneno').val(data["groupmember_phoneno"]);
                    $('#modalLabel').html("Update Group Member");
                    $('#btnSubmit').html('Update Record');

                },
                error: function (data) {
                    swal_error();
                }
            });
            
        });


             // initialize btn delete
             $('body').on('click', '.deleteRecord', function () {
                var row_id = $(this).data("id");
               
                Swal.fire({
                    title: 'Are you sure to Delete this Record?',
                    text: "You won't be able to revert this Action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url:  "/apps/smsgroup/"+row_id+"/groupdelete/",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                swal_success_delete()
                                table.draw();
                            },
                            error: function (data) {
                                alert(JSON.stringify(data)); 
                                swal_error();
                            }
                        });
                    }
                })
            });
       

    });

</script>
@endsection

@include('pages.Apps.SMS.smsGroup_list_edit');