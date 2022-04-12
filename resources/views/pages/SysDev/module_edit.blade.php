<?php
$SysTbl = json_decode(getListItems('SystemTables'),true);
$Systblist = array();
    foreach($SysTbl as $key => $sVal)
    {
        $Systblist[] = $sVal['item_code'];
    }
?>
<div class="content d-flex flex-column flex-column-fluid " id="kt_content">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header bg-gray-700">
                <div class="card-title"> <h3 class="card-label text-white"><i class="fa fa-edit text-white"></i> Manage Module</h3></div>
                <div class="card-toolbar">
                    <a href="{{route($tblContent) }}" class="btn btn-sm btn-pill btn-outline-warning font-weight-bolder text-white" title="Back to List"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            
            </div>
            <form id="formDataAdd" name="formDataAdd">
                <input type="hidden" name="row_id" id="row_id" value="{{ $rst->id ?? "" }}">
                <input type="hidden" name="module_code" id="module_code"    value="{{ $rst->module_code }}"/>
            <div class="card-body">

               
                
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Module Name:</label>
                        <input type="text" name="module_name" id="module_name"   class="form-control form-control-solid" placeholder="Enter Module Name" value="{{ $rst->module_name }}"/>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Menu Category:</label>
                        <select name="menucategory_id" class="form-control" id="menucategory_id">
                            <option value=""></option>
                            @foreach($menuCategory as $list)
                            {{ $selected = $rst->menucategory_id == $list->id ? "selected" : ""}}
                            <option value="{{ $list->id }}" {{ $selected }}>{{ $list->menu_title }}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Module Display Order:</label>
                        <input type="number" name="display_order" id="display_order"   class="form-control form-control-solid" placeholder="Enter Display Order" value="{{ $rst->display_order }}"/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Select Module Type:</label>
                        <select name="module_type" class="form-control" id="module_type" required="true">
                           
                            @foreach(getListItems('ModuleType') as $list)
                            {{ $selected = $rst->module_type == $list->item_code ? "selected" : ""}}
                            <option value="{{ $list->item_code }}" {{ $selected }}>{{ $list->item_description }}</option>
                          @endforeach
                        </select>
                    </div>

                </div>


                <div class="row">
                    
                    <div class="form-group col-sm-6">
                        <label>Page Link:</label>
                        <input type="text" name="page_link" id="page_link"  value="{{ $rst->page_link }}" class="form-control form-control-solid" placeholder="Enter Page Link"  />
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Select Model:</label>
                       
                        <select name="model_name" class="form-control" id="model_name">
                            <option value="">-- Select Model --</option>
                            @foreach(getModels() as $models)
                            {{ $modName = substr($models, strrpos($models, '\\' )+1) }}
                            {{ $selected = $rst->model_name == $modName ? "selected" : ""}}
                            @if (!in_array($modName, $Systblist))
                                <option value="{{ $modName }}" {{ $selected }}>{{ $modName }}</option>
                            @endif
                            
                          @endforeach
                        </select>
                      
                    </div>
                </div>
                
            </div>
            
            <div class="card-footer bg-gray-400 d-flex justify-content-center">
                <button type="submit" name="btnSave" id="btnSave" class="btn btn-success"><i class="fas fa-edit"></i> Update Module</button>
            </div>
        </form>
        </div>{{-- End card --}}
          
        
          

        <div class="card card-custom gutter-b">
            
            <div class="card-header">
                <div class="card-title"> <h3 class="card-label"> <i class="fa fa-list text-teal"></i> Module View</h3></div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-warning " name="btnUpdateView" id="btnUpdateView" title="Update View"><i class="fas fa-edit"></i> Update View</button>
                </div>
           </div>
           <div class="card-body">
               <span id="response"></span>
               <form name="frmmoduleview" id="frmmoduleview" method="POST" accept-charset="UTF-8">
            <table class="table table-bordered ">
                <thead>
                <tr>
                     <th>#</th>
                    <th>Column Name</th>
                    <th>Display Name</th>
                    <th>Display Order</th>
                     <th>Show</th>
                     
                </tr>
                </thead>
                <tbody>
                   
                        
                     <input type="hidden" name="module_id" id="module_id" value="{{ $rst->id ?? "" }}">
                    
                     <?php $i = 0; ?>
                     @foreach(getModCols($rst->model_name,$rst->id,$rst->parent_table) as $modField => $modValue)
                     <?php  
                        $IsChecked = $modValue['is_searchable'] == 'Y' ? "checked" : "";
                        $DisplayName = $modValue['display_name'] != '' ? $modValue['display_name'] : ucwords(str_replace('_',' ',$modField));
                     ?>
                         <tr>
                             <input type="hidden" name="field_name[{{ $modField }}]" id="{{ 'fn-'.$modField }}"    value="{{ $modField }}"/>
                             <td>{{ $i += 1 }}</td>
                             <td><b>{{ $modField}}</b></td>
                             <td><input type="text" name="display_name[{{ $modField }}]" id="{{ 'dn-'.$modField }}"   class="form-control form-control-solid" placeholder="Enter Display Name" value="{{ $DisplayName }}"/></td>
                             <td><input type="number" name="display_order[{{ $modField }}]" id="{{ 'do-'.$modField }}"   class="form-control form-control-solid" placeholder="Enter Display Order" value="{{ $modValue['display_order']  }}"/></td>
                             
                             <td><span class="switch switch-success"><label><input type="checkbox" {{ $IsChecked }} name="is_search[{{ $modField }}]" id="{{ 'chk-'.$modField }}" onclick='DoCheckBox("{{ $modField }}");' /><span></span>
                                 <input type="hidden" name="is_searchable[{{ $modField }}]" id="{{ 'ischk-'.$modField }}" value="{{ $modValue['is_searchable'] }}">
                             </td>
                             
                         </tr>    
                     @endforeach
                            
                </tbody>
            </table>
           </form>
           </div>
        </div> {{-- End card --}}

    
    </div> {{-- End Container --}}
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
                url: "{{ route('sysdev.module.store') }}",
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

            $('#btnUpdateView').click(function () {
               // e.preventDefault();
              
               $.ajax({
               data: $('#frmmoduleview').serialize(),
                url: "{{ route('sysdev.module.modviews') }}",
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
            });

       
        // statusing

    });


    function DoCheckBox(fieldName){
        
        if($("#chk-"+fieldName).is(":checked")) {
                    $("#ischk-"+fieldName).val("Y");
             
             }
             else {
                 $("#ischk-"+fieldName).val("N");
             }
             
     }
  

</script>
@endsection