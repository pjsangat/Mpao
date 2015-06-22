<?php
	//echo '<pre>';echo print_r($requirments);echo '</pre>';
?>
<style type="text/css">
.modal-dialog {
	width: 1000px;
}
</style>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
<script type='text/javascript'>
	$(document).ready(function() {
		//test();
	});
	
	function reserveaircon(oForm,room_id)
	{
		var reservation_id = '<?php echo $this->uri->segment(4); ?>'
		gender = oForm.elements["gender"].value;
		date_time_in = oForm.elements["date_time_in"].value;
		date_time_out = oForm.elements["date_time_out"].value;
		if (date_time_in == null || date_time_in == "") {
        	//alert("Date must be filled out");
			oForm.elements["date_time_in"].focus();
        	return false;
    	}
		
		if (date_time_out == null || date_time_out == "") {
        	//alert("Date must be filled out");
			oForm.elements["date_time_out"].focus();
        	return false;
    	}
		waiteme('#airondiv');
		$.post('<?php echo base_url();?>student/reserve_rooms',
		{
			date_time_in:date_time_in,
			reservation_id:reservation_id,
			gender:gender,
			date_time_out:date_time_out,
			room_id:room_id
		},
		function(data){
			$('#airondiv').waitMe('hide');
			if(data == '1')
			{
				compute_reservation(reservation_id,room_id);
				document.getElementById(oForm.id).reset();
			}
		});	
		return false;
		//alert(oForm.name);	
	}
	
	function reserve_requirments(oForm,requirment_id)
	{
		var reservation_id = '<?php echo $this->uri->segment(4); ?>';
		date_time_in = oForm.elements["date_time_in"].value;
		date_time_out = oForm.elements["date_time_out"].value;
		if (date_time_in == null || date_time_in == "") {
        	//alert("Date must be filled out");
			oForm.elements["date_time_in"].focus();
        	return false;
    	}
		
		if (date_time_out == null || date_time_out == "") {
        	//alert("Date must be filled out");
			oForm.elements["date_time_out"].focus();
        	return false;
    	}
		waiteme('#requirmentsdiv');
		$.post('<?php echo base_url();?>student/reserve_requirment',
		{
			date_time_in:date_time_in,
			date_time_out:date_time_out,
			reservation_id:reservation_id,
			requirment_id:requirment_id
			
		},
		function(data){
			$('#requirmentsdiv').waitMe('hide');
			if(data == '1')
			{
				compute_reservation(reservation_id,null);
				document.getElementById(oForm.id).reset();
			}
		});	
		return false;
	}
	
	function reserverothers(oForm,room_id)
	{
		var reservation_id = '<?php echo $this->uri->segment(4); ?>';
		gender = oForm.elements["gender"].value;
		date_time_in = oForm.elements["date_time_in"].value;
		date_time_out = oForm.elements["date_time_out"].value;
		if (date_time_in == null || date_time_in == "") {
        	//alert("Date must be filled out");
			oForm.elements["date_time_in"].focus();
        	return false;
    	}
		
		if (date_time_out == null || date_time_out == "") {
        	//alert("Date must be filled out");
			oForm.elements["date_time_out"].focus();
        	return false;
    	}
		waiteme('#other_facility');
		$.post('<?php echo base_url();?>student/reserve_rooms',
		{
			date_time_in:date_time_in,
			date_time_out:date_time_out,
			reservation_id:reservation_id,
			room_id:room_id,
			gender:gender
			
		},
		function(data){
			$('#other_facility').waitMe('hide');
			if(data == '1')
			{
				compute_reservation(reservation_id,null);
				document.getElementById(oForm.id).reset();
			}
		});	
		return false;
	}
	
	function compute_reservation(reservation_id,room_id)
	{
		$.post('<?php echo base_url();?>student/compute_reservation',
		{
			reservation_id:reservation_id
		},
		function(data){
			$('.modal-title').html('Computation');
			$('.modal-body').html(data);
			$('#add_propertie').modal('show');
		});	
		return false;	
	}
	function test()
	{
		$('.modal-title').html('test');
		$('.modal-body').html('test');
		$('#add_propertie').modal('show');	
	}
	
	function reserve()
	{
		var csrf_test_name = $("input[name=csrf_test_name]").val();
		var female    = $('#female').val();
		alert(female);
		$.post('<?php echo base_url();?>student/compute_reservation',
		{
			female:female
		},
		function(data){
			alert(data);
		});	
		return false;
	}
	
	function waiteme(containerid)
	{
		$(containerid).waitMe({
			effect: 'ios',
			text: 'Loading...',
			bg: 'rgba(255,255,255,0.7)',
			color:'#000',
			sizeW:'',
			sizeH:''
		});
	}
</script>

<div class="panel panel-primary" id="airondiv">
  <div class="panel-heading">Reservation Details</div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
		<div class="col-md-6">
        	<table class="table table-striped table-bordered table-hover">
      			<tbody>
                	<tr>
                    	<td>Title Of Activity:</td>
                        <td><?php echo $details['name'];?></td>
                    </tr>
                    <tr>
                    	<td>Nature Of Activity</td>
                        <td><?php echo $details['activityID'];?></td>
                    </tr>
                    <tr>
                    	<td>Name Of user/organizer</td>
                        <td><?php echo $details['organizer'];?></td>
                    </tr>
                    <tr>
                    	<td>Authorized Representative</td>
                        <td><?php echo $details['authorized_Person'];?></td>
                    </tr>
                     <tr>
                    	<td>Postion</td>
                        <td><?php echo $details['position'];?></td>
                    </tr>
        		</tbody>
            </table>
            <button type="submit" class="btn btn-success bg-lg" onclick="compute_reservation('<?php echo $this->uri->segment(4);?>',null);return false;"> Show Computation</button>
        </div>
		<div class="col-md-6">
        	<table class="table table-striped table-bordered table-hover">
      			<tbody>
                	<tr>
                    	<td>Date</td>
                        <td><?php echo $details['date_activity'];?></td>
                    </tr>
                    <tr>
                    	<td>Mobile Number</td>
                        <td><?php echo $details['mobile'];?></td>
                    </tr>
                    <tr>
                    	<td>Email Address</td>
                        <td><?php echo $details['email'];?></td>
                    </tr>
                    <tr>
                    	<td>Fax or Landline</td>
                        <td><?php echo $details['landline'];?></td>
                    </tr>
                     <tr>
                    	<td>Address</td>
                        <td><?php echo $details['st_brgy'];?></td>
                    </tr>
        		</tbody>
            </table> 
        </div>
		<?php //print_r($details); ?> 
	</div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->    
    
    

<div class="panel panel-primary" id="airondiv">
  <div class="panel-heading">Jppollock<br>
    Airconditioned Bedrooms </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr class="bg-success">
            <td rowspan="2"><div align="center"><strong>Room Number</strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Dates/Inclusive Time</strong></div></td>
            <td colspan="2"><div align="center"><strong>Total Number of Persons</strong></div></td>
            <td rowspan="2"><div align="center"><strong>Add<br>
                Reservation</strong></div></td>
          </tr>
          <tr class="bg-success">
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
            <td align="center">Male</td>
            <td align="center">Female</td>
          </tr>
          <?php
	   	foreach($aircon as $ai) {
			$charges_query = $this->db->query("select * from charges where rent_space_id = '".$ai->rentspace_ID."'");
			$charges_result = $charges_query->result();
			$count = $charges_query->num_rows();
	?>
    <form method="post" id="aircon_<?php echo $ai->rentspace_ID;?>" name="aircon_<?php echo $ai->rentspace_ID;?>">
          <tr>
          
            <td class=""><div align="left"><strong>
                <label style="Margin-left:1em;"><?php echo $ai->Name;?></label></strong>
                <div>
                <?php
							foreach($charges_result as $chresult) {
						?>
                        	P<?php echo $chresult->amount;?> / Head<br />	
                        <?php
							}
						?>
                </div>
                </div></td>
            <td ><div class="input-group date form_datetime_in col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:255px;">
                <input class="form-control"  type="text" value="" name="date_time_in" id="date_time_in" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
            <td ><div class="input-group date form_datetime_out col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:255px;" >
                <input class="form-control"  type="text" value="" name="date_time_out" id="date_time_out" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
            <td >
            	<?php if($ai->is_male == '1') { ?>
                		<select name="gender" class="form-control" id="gender">
                    	<?php
							for($x=1; $x<=$count; $x++) {
						?>
                        	<option value="<?php echo $x;?>"><?php echo $x;?></option>	
                        <?php
							}
						?>
                    </select>
                <?php } else { ?>
                		<select disabled="disabled" class="form-control">
                        	<option value="0">0</option>
                        </select>
                <?php } ?>
            </td>
            <td >
            	<?php if($ai->is_female == '1') { ?>
                	<select name="gender" class="form-control" id="gender">
                    	<?php
							for($x=1; $x<=$count; $x++) {
						?>
                        	<option value="<?php echo $x;?>"><?php echo $x;?></option>	
                        <?php
							}
						?>
                    </select>
                 <?php } else { ?>
                		<select disabled="disabled" class="form-control">
                        	<option value="0">0</option>
                        </select>
                <?php } ?>
            </td>
            <td ><center>
                <button type="submit" class="btn btn-success bg-lg" onclick="reserveaircon(this.form,'<?php echo $ai->rentspace_ID;?>');return false;"><span class="glyphicon glyphicon-plus"></span> Add</button>
              </center></td>
              
          </tr>
          <tr>
            <td class="">&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          </form> 
          <?php
		}
	?>
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->

<div class="panel panel-primary">
  <div class="panel-heading">Jppollock<br>
    Non Aircon Bedrooms </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <!--<table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr class="bg-success">
            <td rowspan="2"><div align="center"><strong>Room Number</strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Dates/Inclusive Time</strong></div></td>
            <td colspan="3"><div align="center"><strong>Total Number of Persons</strong></div></td>
            <td rowspan="2"><div align="center"><strong>Add<br>
                Reservation</strong></div></td>
          </tr>
          <tr class="bg-success">
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
            <td><div align="center">Male</div></td>
            <td><div align="center">Female</div></td>
            <td><div align="center">Bothdenger</div></td>
          </tr>
          <?php
	   	foreach($noaircon as $nonai) {
	?>
          <tr>
            <td class=""><div align="left"><strong>
                <label style="Margin-left:1em;"><?php echo $nonai->Name;?></label>
                </strong></div></td>
            <td rowspan="3" ><div class="input-group date form_datetime col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;">
                <input class="form-control"  type="text" value="" name="date_time" id="date_time" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
            <td rowspan="3" ><div class="input-group date form_datetime col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;" >
                <input class="form-control"  type="text" value="" name="date_time" id="date_time" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
            <td rowspan="3" ><div align="center">
                <select name="male11" class="form-control" required="">
                  <option selected="selected" value="0">0</option>
                </select>
              </div></td>
            <td rowspan="3" ><div align="center">
                <?php
				//if($ai->is_female == '1')
				$count_person = $this->db->query("select * from charges where rent_space_id = '".$nonai->rentspace_ID."'");
				echo $count_person->num_rows()
			?>
                <select name="female11" class="form-control" required="">
                  <option selected="selected" value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div></td>
            <td rowspan="3" ><div align="center">
                <select name="both11" class="form-control" disabled="disabled">
                  <option selected="selected" value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div></td>
            <input value="0" name="both11" type="hidden">
            <td rowspan="3" ><center>
                <button type="submit" class="btn btn-success bg-lg" onclick="reserve();return false;"><span class="glyphicon glyphicon-plus"></span> Add</button>
              </center></td>
          </tr>
          <tr> 
            <!--<td><label style="Margin-left:1em;">Regular Price :₱350.00 / head</label></td>--> 
          <!--</tr>
          <tr> 
            <!--<td><label style="Margin-left:1em;">Succeding Price : ₱250.00 / head</label></td>--> 
          <!--</tr>
          <?php
		}
	?>
        </tbody>
      </table>-->
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->

<div class="panel panel-primary" id="other_facility">
  <div class="panel-heading">Jppollock<br>
    Other Facility </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
	
    <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr class="bg-success">
            <td rowspan="2"><div align="center"><strong>Room </strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Dates/Inclusive Time</strong></div></td>
            <td rowspan="2" align="center">Total Number of Persons</td>
            <td rowspan="2"><div align="center"><strong>Add<br>
            Reservation</strong></div></td>
          </tr>
          <tr class="bg-success">
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
          </tr>
          <?php
	   	foreach($others as $otherf) {
			
		?>
    <form method="post" id="otherfacility_<?php echo $otherf->rentspace_ID;?>" name="otherfacility_<?php echo $otherf->rentspace_ID;?>">
          <tr>
          
            <td class=""><div align="left"><strong>
                <label style="Margin-left:1em;"><?php echo $otherf->Name;?></label></strong>
                </div></td>
            <td ><div class="input-group date form_datetime col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;">
                <input class="form-control"  type="text" value="" name="date_time_in" id="date_time_in" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
            <td ><div class="input-group date form_datetime col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;" >
                <input class="form-control"  type="text" value="" name="date_time_out" id="date_time_out" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
            <td >
				
                <select id="gender" name="gender" class="form-control">
                	<?php for($x=1; $x<=$otherf->No_person_Max; $x++) { ?>
                		<option value="<?php echo $x;?>"><?php echo $x;?></option>
                    <?php } ?>
                </select>
            </td>
            <td ><center>
              <button type="submit" class="btn btn-success bg-lg" onclick="reserverothers(this.form,'<?php echo $otherf->rentspace_ID;?>');return false;"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </center></td>
          </tr>
          </form> 
          <?php
		}
	?>
        </tbody>
      </table>

 </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->

    


<div class="panel panel-default" id="requirmentsdiv">
  <div class="panel-heading">Jppollock<br>
    Requirments </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>Particulars</th>
            <th align="center">Date/Time From</th>
            <th align="center">Date/Time To</th>
            <th>No of Unit Requested</th>
            <th>Cost Per Unit</th>
            <th>Add Requirments</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($requirments as $rq) { ?>
        <form method="post" id="requirments<?php echo $rq->requirement_ID;?>" name="requirments<?php echo $rq->requirement_ID;?>">
          <tr>
            <td><?php echo $rq->requirement_name;?></td>
            <td>
            	<div class="input-group date form_datetime col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;">
                <input class="form-control"  type="text" value="" name="date_time_in" id="date_time_in" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div>
            </td>
            <td>
            	<div class="input-group date form_datetime col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;">
                <input class="form-control"  type="text" value="" name="date_time_out" id="date_time_out" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div>
            </td>
            <td>
            	<select class="form-control" id="unit" name="unit">
                	<?php for($x=1; $x<=$rq->Available_Item; $x++) { ?>
                		<option value="<?php echo $x;?>"><?php echo $x;?></option>
                    <?php } ?>
                </select>
            </td>
            <td><?php echo $rq->Price;?></td>
            <td>
            	<button type="submit" class="btn btn-success bg-lg" onclick="reserve_requirments(this.form,'<?php echo $rq->requirement_ID; ?>');return false;"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </td>
          </tr>
          </form>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel --> 

<script type="text/javascript">
	$(document).ready(function() {
		//test();
	
		$('.form_datetime_in').datetimepicker({
			//language:  'fr',
			format: "yyyy-mm-dd HH:ii p",
			weekStart: 1,
			todayBtn: false,
			autoclose: true,
			todayHighlight: 1,
			startView: 2,
			minuteStep:30,
			forceParse: 0,
			showMeridian: true,
			startDate:new Date(),
			pickerPosition: "top",
			pickTime: false
		}).on('changeDate', function (selected) {
			var startDate = new Date(selected.date.valueOf());
			$('.form_datetime_out').datetimepicker('setStartDate', startDate);
		}).on('clearDate', function (selected) {
			$('.form_datetime_out').datetimepicker('setStartDate', null);
		});
	
		 $('.form_datetime_out').datetimepicker({
			//language:  'fr',
			format: "yyyy-mm-dd HH:ii p",
			weekStart: 1,
			todayBtn: false,
			autoclose: true,
			todayHighlight: 1,
			startView: 2,
			minuteStep:30,
			forceParse: 0,
			showMeridian: true,
			startDate:new Date(),
			pickerPosition: "top",
			pickTime: false
		}).on('changeDate', function (selected) {
			var endDate = new Date(selected.date.valueOf());
			$('.form_datetime_in').datetimepicker('setEndDate', endDate);
		}).on('clearDate', function (selected) {
			$('.form_datetime_in').datetimepicker('setEndDate', null);
		});
	
	});
</script>
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
