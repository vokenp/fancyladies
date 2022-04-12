<?php
   $columns = json_decode($cols,true);
 ?>
<div class="content d-flex flex-column flex-column-fluid " id="kt_content">
    <div class="container">
      <div class="row">
        
          <div class="col-lg-12 col-sm-12 ">
            <div class="card card-custom gutter-b">
                <div class="card-header  bg-gray-700">
                    <div class="card-title">
                        <h3 class="card-label text-white" id="tblCaption">Mpesa Tranactions</h3>
                        {{-- <span class="d-block text-muted pt-2 font-size-sm">sorting &amp; pagination remote datasource</span> --}}   
                    </div>
                    <div class="card-toolbar">
                        
                    </div>
                </div> {{--  End Class Header --}}
            <div class="card-body">
               
                <div class="col-md-12">
                    <div class="table-responsive">
                        <h2 ></h2>
                        <table class="table table-hover table-striped" id="displayTable">
                           
                            <thead class="font-weight-bold text-center bg-success">
                                
                            </thead>
                            <tbody class="text-center">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


          </div>
      </div>
    
    </div> {{--  End Container --}}
</div> {{--  End Content --}}

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script> 
 {{-- page scripts --}}
<script>
    $(function () {


         // initialize btn save
         $('#btnSave').click(function (e) {
            e.preventDefault();

            $.ajax({
                data: $('#formData').serialize(),
                url: "{{ route($storeAction) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    
                    $('#formData2').trigger("reset");
                    swal_success();
                    table.draw();
                },
                error: function (data) {
                  // alert(JSON.stringify(data)); 
                    swal_error();
                   
                }
            });

        });
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
        function swal_error(data) {
            Swal.fire({
                position: 'centered',
                icon: 'error',
                title: data,
                showConfirmButton: true,
            })
        }


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
                url: "{{ route($storeAction) }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#employee_edit').modal('hide');
                    data['success'] ? swal_success() :  swal_error(data['error']);
                    $('#formData2').trigger("reset");
                    table.draw();
                },
                error: function (data) {
                  // alert(JSON.stringify(data)); 
                   swal_error(data);
                   
                }
            });
            
            }
            });
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
                url: "{{ route($listLink) }}",
               
            },
            error: function(ep){  // error handling code
               // alert(JSON.stringify(ep));
               // $("#tblListView_processing").css("display","none");
              }
        });
       
        $('#AddNewRec').click(function(){
            $('#row_id').val("");
            $('#employee_edit').modal('show');
            $('#modalLabel').html("Add New Employee");
            $('#employee_idno').prop('readonly',false);
            $('#btnSubmit').html('Save Employee');
            $('#formData2').trigger("reset");
           });
        

          // initialize btn Edit
          $('body').on('click', '.editRecord', function () {
            var row_id = $(this).data("id");
            
            $.ajax({
                type: "GET",
                url:  "/apps/employees/"+row_id+"/edit/",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#employee_edit').modal('show');
                    
                    $('#row_id').val(data["id"]);
                    $('#employee_name').val(data["employee_name"]);
                    $('#employee_idno').val(data["employee_idno"]);
                    $('#employee_idno').prop('readonly',true);
                    $('#employee_phoneno').val(data["employee_phoneno"]);
                    $('#employee_email').val(data["employee_email"]);
                    $('#modalLabel').html("Update Employee");
                    $('#btnSubmit').html('Update Employee');

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
                        type: "DELETE",
                        url: "{{route($delAction)}}" + '/' + row_id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            swal_success_delete()
                            table.draw();
                        },
                        error: function (data) {
                            swal_error();
                        }
                    });
                }
            })
        });

        // statusing


    });

</script>
@endsection


