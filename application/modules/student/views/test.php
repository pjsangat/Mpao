<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />

 
  <input class="form-control"  type="text" value="" name="daterange" readonly>
 
<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
		showOn: 'button',
		buttonImage: 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif',
		buttonImageOnly: true
    });
});
</script>