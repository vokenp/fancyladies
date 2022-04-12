$(function () {

    // initialize btn Edit
    $('body').on('click', '.editUserRecord', function () {
     var row_id = $(this).data("id");
     var base_url = window.location.origin;
    
     $.ajax({
         type: "GET",
         url:  "/sys/user/"+row_id+"/edit/",
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function (data) {
             $('#user_create_modal').modal('show');
             $('#row_id').val(data["id"]);
             $('#username').val(data["username"]);
             $('#username').prop("readonly", true);
             $("#user_type option[value="+data["user_type"]+"]").prop("selected", true);
             $('#user_create_modal').html("Update List Item");
             $('#btnSubmit').html('Update User Info');

         },
         error: function (data) {
             swal_error();
         }
     });
     
 });
});