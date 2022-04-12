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
        $(window.location).attr('href', '{{ route($tblContent) }}');
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
               //alert(JSON.stringify(data)); 
               swal_error(data);
               
            }
        });
        
        }
        });

    
   
    // statusing

});
