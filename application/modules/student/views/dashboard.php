<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/fullcalendar.print.css' media='print' />
<style type="text/css">
.modal-dialog {
	width: 1000px;
}
</style>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.js"></script>
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			editable: true,
			eventLimit: true,
			events: {url:"<?php echo base_url();?>student/json",data:function(){ return { facilityid: "<?php echo $this->uri->segment(3); ?>"}; },type:"POST"},
			eventClick: function(calEvent, jsEvent, view) {
				
				get_data(calEvent.id);
    		},
			dayClick: function(date, jsEvent, view) {
				check_reservation(date.format());
				
				// change the day's background color just for fun
				//$(this).css('background-color', 'red');
	
			}
		});
		
	});
	
	function check_reservation(date)
	{
		waiteme();
		var csrf_test_name = $("input[name=csrf_test_name]").val();
		var facilityid = "<?php echo $this->uri->segment(3); ?>";
		$.post('<?php echo base_url();?>student/check_date',
		{
			date:date,
			csrf_test_name:csrf_test_name,
			facilityid:facilityid
		},
		function(data){
			$('#containers').waitMe('hide');
			$('.modal-title').html(date+' Reservation Form');
			$('.modal-body').html(data);
			$('#add_propertie').modal('show');
		});	
		return false;
	}
	
	function waiteme()
	{
		$('#containers').waitMe({
			effect: 'ios',
			text: 'Loading...',
			bg: 'rgba(255,255,255,0.7)',
			color:'#000',
			sizeW:'',
			sizeH:''
		});
	}
	
	function get_data(id)
	{
		var csrf_test_name = $("input[name=csrf_test_name]").val();
		$.post('<?php echo base_url();?>student/get_schedule',
		{
			id:id,
			csrf_test_name:csrf_test_name
		},
		function(data){
			$('.modal-title').html('Schedule');
			$('.modal-body').html(data);
			$('#add_propertie').modal('show');
		});	
		return false;	
	}

</script>

<div class="panel panel-default">
  <?php
		$attributes = array('name' => 'register', 'id' => 'register', 'role' => 'form');
		echo form_open('#',$attributes);
	?>
  <div id='calendar'></div>
  <?php
		echo form_close();
	?>
</div>
<div id="add_propertie" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
