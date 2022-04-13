<?php
   $columns = json_decode($cols,true);
 ?>

<div class="card card-custom col-md-12 col-sm-12 col-lg-12 p-0">
    <div class="card-header bg-gray-700 ">
        <div class="card-title ">
            <h3 class="card-label text-white" ><i class="flaticon2-list-3 icon-2x mr-2 text-warning"></i> {{ @$page_title.' List' }}
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
        <div class="card-toolbar">
           
            <!--begin::Button-->
            @if (isset($hasModal))
            <a href="#" data-toggle="modal" data-target="{{ '#'.$modalName ?? "" }}" class="btn btn-success font-weight-bolder mr-1" title="{{ 'Create New '.$page_title }}">
            @else
            <a href="{{ route($btncreate) }}" class="btn btn-success font-weight-bolder mr-1" title="{{ 'Create New '.$page_title }}">
            @endif
          
            <span class="svg-icon svg-icon-md">
                <i class="flaticon2-plus text-white"></i>
            </span>Create New</a>
            <!--end::Button-->

            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-md">
                   
                </span>Export
                </button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
                                </span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
          
        </div>
    </div>

    <div class="card-body ">

        <table class="table table-hover table-striped  nowrap" id="displayTable" style="width:90%;">
            <thead class="font-weight-bold text-center bg-light-dark">
                
            </thead>
            <tbody class="text-center">
                
            </tbody>
        </table>

    </div>

</div>



@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}

     <script type="text/javascript" src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script> 

    {{-- page scripts --}}
    <script>
        $(function () {
            
    var table = $('#displayTable').DataTable({
        processing: true,
        serverSide: true,
        scrollY: "55vh",
        
        scrollX: true,
        resposive:true,
        lengthMenu: [[20,50, 100, 200], [20,50, 100, 200]],
        ajax: {
            url: "{{ route($listLink) }}",
       headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
       
        } ,
        columns: <?php echo json_encode($columns);?>
    });

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
        $('#formData').trigger("reset");
        $('#{{ $modalName ?? "" }}').modal('hide');
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
            error: function (data) {
               alert(JSON.stringify(data)); 
               swal_error(data);
               
            }
        });
        
        }
        });
    
          
        });
    </script>
   
   
@endsection

    @if (isset($hasModal))
          @include($hasModal)
    @endif
