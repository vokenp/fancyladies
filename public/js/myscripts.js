$(function(){
  $('.mask-phoneNo').mask('254-999-999-999');
  $('[data-toggle="popover"]').popover();
  $('.select2').select2({
    width: 'auto',
    height: '100%',
  });
  $('.input-tags').tagsInput({width:'auto'});
  $(".chzn-select").chosen();
    // Datetimepicker
    $('.kt_datetimepicker').datetimepicker({
      pickerPosition: 'bottom-left',
      todayHighlight: true,
      autoclose: true,
      format: 'dd-mm-yyyy hh:ii'
  });
});