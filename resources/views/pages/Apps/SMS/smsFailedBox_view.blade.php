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
                        <h3 class="card-label text-white" id="tblCaption">Failed SMS List</h3>
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
                            <tbody class="text-left">
                                
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
       

    });

</script>
@endsection


