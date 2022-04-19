<div class="card card-custom col-md-12 col-sm-12 col-lg-12 p-0">
    <div class="card-header bg-gray-700 ">
        <div class="card-title ">
            <h3 class="card-label text-white" ><i class="flaticon2-list-3 icon-2x mr-2 text-warning"></i> {{ @$page_title }}
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div> {{--  End Card Title --}}

        <div class="card-toolbar">
            <span class="label  label-inline font-weight-boldest mr-2 " style="font-size:16px;">Available SMS Units : {{ $smsBalance["data"]["account_units"] ?? "" }}  Worth Ksh : {{ $smsBalance["data"]["account_balance"] ?? ""}}</span> 
        </div> {{--  End ToolBar --}}
    </div> {{--  End Class Header --}}
    <form name="formDataInfo" id="formDataInfo">
         <input type="hidden" name="sms_bal_at" id="sms_bal_at" value="{{ $smsBalance["data"]["account_units"] }}">  
    <div class="card-body ">
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
                <div class="row">
                    <div id="optFreeNums" class="col-lg-12 col-sm-12 col-md-12 optDiv" >
                        @include('pages.Apps.SMS.optFreeNums')
                    </div>
        
                    <div id="optCustomers" class="col-lg-12 col-sm-12 col-md-12 optDiv" style="display:none">
                       @include('pages.Apps.SMS.optCustomers')
                    </div>
        
        
                    <div id="optEmployees" class="col-lg-12 col-sm-12 col-md-12 optDiv" style="display:none">
                        @include('pages.Apps.SMS.optEmployees')
                    </div>
        
                    <div id="optSMSGroup" class="col-lg-12 col-sm-12 col-md-12 optDiv" style="display:none">
                        @include('pages.Apps.SMS.optSMSGroup')
                    </div>
                </div>
            </div>{{--  End Left--}}

            <div class="col-lg-6 col-sm-6">
                <span id="vals"></span>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="col-md-3"> <label>Template:</label></div>
                    <div class="col-md-8">
                        <select name="message_type" id="message_type" class="form-control form-control-solid form-control form-control-solid-solid" placeholder="Choose Template" >
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
                       <textarea name="message_body"  id="message_body" class="form-control form-control-solid form-control   form-control-solid-solid" rows="4" required></textarea>
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
                </div>

            </div>{{--  End Left--}}
        </div> {{--  End Row --}}
    </div>  {{--  End Card-body --}}
     
    <div class="card-footer bg-gray-100 text-center">
        <button type="submit" class="btn btn-lg btn-success mr-2"><i class="fa fa-send"></i> Send SMS</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>  {{--  End Card-Footer --}}
    </form>
</div>{{--  End Cardr --}}

@section('scripts')
{{-- page scripts --}}
<script>
$(function () {
 
    $('.EmpSentTo').change(function(){
        var EmpToVal = $(".EmpSentTo:checked").val();
        
        if(EmpToVal != "All")
        {
          $('#EmpSpecific').css('display','block'); 
        }
        else{
           $('#EmpSpecific').css('display','none'); 
        }
    });


    $('.CustSentTo').change(function(){
        var CustToVal = $(".CustSentTo:checked").val();
        
        if(CustToVal != "All")
        {
          $('#CustSpecific').css('display','block'); 
        }
        else{
           $('#CustSpecific').css('display','none'); 
        }
    });
 
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
    position: 'centered',
    icon: 'success',
    title: 'SMS Message(s) Send Successful',
    showConfirmButton: true,
    timer: 6000
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



$("#formDataInfo").validate({
debug: false,
rules: {

},
messages: {
  
},
submitHandler: function(form) {
// do other stuff for a valid form
Swal.fire({
    title: 'Are you sure to SMS want to send this SMS(s) ?',
    text: "Please counter check if you have written the Correct Message!",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Send Now!'
}).then((result) => {
    if (result.isConfirmed) {

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
  })

}
});
// statusing

/*


$('#send_groups .chosen-search input').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "{{ route('apps.smsgroup.chosenlist') }}",
        data: function (d) {
            d.qry = request.term;
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function( data ) {
          $('#send_groups').empty();
          response( $.map( data, function( item ) {
            $('#send_groups').append('<option value="'+item.id+'">' + item.name + '</option>');
          }));
          $("#send_groups").trigger("chosen:updated");
        }
      });
    }
  });  
  */

});

</script>
@endsection