<div class="content d-flex flex-column flex-column-fluid " id="kt_content">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 col-sm-12 ">
            
            
            <div class="card card-custom gutter-b">
                <div class="card-header  bg-gray-700 ">
                    <div class="card-title">
                        <h3 class="card-label text-white" id="tblCaption">Compose SMS</h3>
                        
                    </div>
                    <div class="card-toolbar">
                        <span class="label  label-inline font-weight-boldest mr-2 " style="font-size:16px;">Available SMS Units : {{ $smsBalance["data"]["account_units"] }}  Worth Ksh : {{ $smsBalance["data"]["account_balance"] }}</span>
                      
                    </div>
                </div> {{--  End Class Header --}}
                <form name="formDataInfo" id="formDataInfo">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">

                        <div class="row">
                            <div class="form-group">
                                <label>Send SMS To:</label>
                                <div class="radio-inline">
                                    <label class="radio radio-lg">
                                        <input type="radio" checked="checked" name="send_category"  class="radioSendTo" value="optFreeNums"/>
                                        <span></span>
                                          Free Numbers
                                    </label>
                                    <label class="radio radio-lg">
                                        <input type="radio" name="send_category" class="radioSendTo" value="optCustomers"/>
                                        <span></span>
                                        Customers
                                    </label>
                                    <label class="radio radio-lg">
                                        <input type="radio" name="send_category" class="radioSendTo" value="optEmployees"/>
                                        <span></span>
                                        Employees
                                    </label>
                                    <label class="radio radio-lg">
                                        <input type="radio" name="send_category" class="radioSendTo" value="optSMSGroup"/>
                                        <span></span>
                                        SMS Groups
                                    </label>
                                </div>
                               
                            </div>  
                        </div>
                        <div class="separator separator-solid separator-border-2 separator-success"></div>
                        
                        <div id="optFreeNums" class="col-lg-12 col-sm-12 optDiv" >
                            @include('pages.Apps.SMS.optFreeNums')
                        </div>

                        <div id="optCustomers" class="col-lg-12 col-sm-12 optDiv" style="display:none">
                           @include('pages.Apps.SMS.optCustomers')
                        </div>


                        <div id="optEmployees" class="col-lg-12 col-sm-12 optDiv" style="display:none">
                            @include('pages.Apps.SMS.optEmployees')
                        </div>

                        <div id="optSMSGroup" class="col-lg-12 col-sm-12 optDiv" style="display:none">
                            @include('pages.Apps.SMS.optSMSGroup')
                        </div>

                    </div> {{--  End Right Section --}}

                    <div class="col-lg-6 col-sm-6">
                       
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <div class="col-md-3"> <label>Template:</label></div>
                            <div class="col-md-8">
                                <select name="message_type" id="message_type" class="form-control form-control-solid form-control form-control-solid-solid chzn-select" placeholder="Choose Template">
                                    <option value="Custom" data-value=''>Custom</option>
                                    @foreach($smsTemps as $temp)
                                    <option value="{{ $temp->template_code }}" data-value="{{ $temp->template_text }}">{{ $temp->template_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Message:</label>
                               <textarea name="message_body"  id="message_body" class="form-control form-control-solid form-control   form-control-solid-solid" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>When to Send:</label>
                                <select name="send_urgency" id="send_urgency" class="form-control form-control-solid form-control form-control-solid-solid" placeholder="Choose Template">
                                    <option value="SendNow">Send Now</option>
                                    <option value="Schedule">Schedule for Later</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="scheDate">
                            <div class="form-group col-sm-10">
                                <label>Schedule Date</label>
                                <input type="text" name="scheduled_date" id="scheduled_date"  class="form-control   form-control-solid form-control   form-control-solid-solid " placeholder="Enter Schedule Date" readonly/>
                            </div>
                        </div

                    </div> {{--  End Right Section --}}
                </div>  {{--  End Row --}}
            </div>{{--  End Card Body --}}
            <div class="separator separator-solid separator-border-2 separator-default"></div>
            <div class="card-footer justify-content-center">
                
                <div class="row">
                   
                    <div class="col-lg-2">
                        <button type="submit" class="btn  btn-lg font-weight-bold btn-success mr-3">Send</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
          </div>
      </div>
    
    </div> {{--  End Container --}}
</div> {{--  End Content --}}


@section('scripts')
 {{-- page scripts --}}
<script>
    $(function () {
       // BEgin Send Options
       $(".radioSendTo").change(function(){
        var sendToVal = $(".radioSendTo:checked").val();
        $('.optDiv').css('display','none');
        $('#'+sendToVal).css('display','block');
    });
       //End Send Options
     

       $('#send_urgency').change(function(){
        hideSchedule();
       });

       $('#message_type').change(function(){
       var TempMsg =  $('#message_type').children('option:selected').data('value');
          $('#message_body').html(TempMsg);
       });

       hideSchedule();
          function hideSchedule()
          {
             var sendurgency = $('#send_urgency').val();
             if(sendurgency == "SendNow")
             {
                $('#scheDate').hide();
             }
             else
             {
                $('#scheDate').show();
             }
          }
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

                    alert(JSON.stringify(data)); 
                   // data['success'] ? swal_success() :  swal_error(data['error']);
                    
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function (data) {
                  alert(JSON.stringify(data)); 
                   swal_error(data);
                   
                }
            });
         
            }
            });
        // statusing

    });

</script>
@endsection