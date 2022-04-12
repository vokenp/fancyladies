$(function(){
  $('.mask-phoneNo').mask('254-999-999-999');
  $('[data-toggle="popover"]').popover();
    // Datetimepicker
    $('.kt_datetimepicker').datetimepicker({
      pickerPosition: 'bottom-left',
      todayHighlight: true,
      autoclose: true,
      format: 'dd-mm-yyyy hh:ii'
  });
});