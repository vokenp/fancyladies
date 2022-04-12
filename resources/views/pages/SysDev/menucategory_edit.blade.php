<?php
   $columns = json_decode($cols,true);
 ?>
<div class="card card-custom  col-md-12 ">
    <div class="card-header bg-gray-700  flex-wrap border-0 pt-6 pb-0">
        <div class="card-title"> <h3 class="card-label text-white"> Manage Sub Menu</h3></div>
        <div class="card-toolbar">
            <a href="{{ route($tblContent) }}" class="btn btn-sm btn-pill btn-outline-warning font-weight-bolder text-white" title="Back to List"><i class="flaticon2-left-arrow-1"></i> Back </a>

            <a href="#" class="btn btn-sm btn-pill btn-outline-success font-weight-bolder text-white"  title="Add New SubItem"  data-toggle="modal" data-target="#AddSubMenuModal" ><i class="flaticon2-plus"></i> Add Sub Item </a>
        </div>
    
    </div>
   
    <div class="card-body">
     <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-2 px-2 py-md-2 px-md-0 bg-light-success"  >
            <div class="col-md-9">
                <div class="border-bottom w-100 "></div>
                    <div class="d-flex justify-content-left  pt-8">

                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2r">Menu Title</span>
                            <span class="text-white">{{ $rst->menu_title }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Menu Icon</span>
                            <span class="text-white">{{ $rst->menu_icon }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Menu Bullet Type.</span>
                            <span class="text-white">{{ $rst->menu_bullet }}</span>
                        </div>

                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Menu Section</span>
                            <span class="text-white">{{ $rst->menu_section }}</span>
                        </div>
                    </div>
            </div>
        </div><!-- end: End-top Row-->
       
    </div>       <!-- end: Card-body-->



    <div class="card-footer  ">
        <table class="table table-hover table-striped row-border nowrap" id="displaySubmenus" style="width:90%;">
            <thead class="font-weight-bold text-center bg-light-dark">
                
            </thead>
            <tbody class="text-center text-bolder">
                
            </tbody>
        </table>
    </div>
</form>
</div>
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
                title: 'Record Successfully Saved',
                showConfirmButton: false,
                timer: 1000
            });
            table.draw();
        $('#formDataAdd').trigger("reset");
        $('#AddSubMenuModal').modal('hide');
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

               // initialize btn delete
    $('body').on('click', '.subItemEdit', function () {
        var row = $(this).data("value");
        alert(row);
        alert(JSON.stringify(row)); 
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
                    url: "{{route('sysdev.menucats.delsubmenu')}}" + '/' + row_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
                    success: function (data) {
                        swal_success_delete()
                        table.draw();
                    },
                    error: function (data) {
                        
                        swal_error(data);
                    }
                });
            }
        })
    });
     

        var table = $('#displaySubmenus').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "55vh",
            
            scrollX: true,
            resposive:true,
            lengthMenu: [[20,50, 100, 200], [20,50, 100, 200]],
            ajax: {
                url: "{{ route('sysdev.menucats.listsubmenus') }}",
                data: function (d) {
                    d.menucategory_id = {{ $rst->id }};
                },
           headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
           
            } ,
            columns: <?php echo json_encode($columns);?>
        });

        $("#formDataAdd").validate({
            debug: false,
            rules: {
            
            },
            messages: {
              
            },
            submitHandler: function(form) {
            // do other stuff for a valid form
            $.ajax({
                data: $('#formDataAdd').serialize(),
                url: "{{ route('sysdev.menucats.save_submenu') }}",
                type: "PUT",
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

@include('pages.SysDev.submenu_add_modal')