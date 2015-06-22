<?php //echo $this->input->post('date'); ?><br>
<?php
//echo '<pre>';print_r($rooms);echo '</pre>';
//echo '<pre>';print_r($rooms_facility);echo '</pre>';
?>
<style type="text/css">
	.error { color:red; }
	
</style>
<script language="javascript">
	$(document).ready(function() {
		 $("#reserve").validate({
			 rules: {
				title_activity:"required" ,
				nature:"required",
				organizer:"required",
				representative:"required",
				position:"required",
				barangay:"required",
				email:{
						required:true,
						email:true
				},
				mobile:"required"
			 },
			 submitHandler: function(form) {
             		waitemes();
                  addReservation();
            }
			 
		});
	});
	
	function waitemes()
	{
		$('#reserve_form').waitMe({
			effect: 'ios',
			text: 'Loading...',
			bg: 'rgba(255,255,255,0.7)',
			color:'#000',
			sizeW:'',
			sizeH:''
		});
	}
	
	function addReservation()
	{
		var title_activity    = $('#title_activity').val();
		var date    = $('#date').val();
		var nature    = $('#nature').val();
		var organizer    = $('#organizer').val();
		var representative    = $('#representative').val();
		var position    = $('#position').val();
		var barangay    = $('#barangay').val();
		var city    = $('#city').val();
		var email    = $('#email').val();
		var mobile    = $('#mobile').val();
		var landline    = $('#landline').val();
		var facityid = $('#facityid').val();
		
		$.post('<?php echo base_url();?>student/addreservation',
			{		
			title_activity:title_activity,
			nature:nature,
			organizer:organizer,
			representative:representative,
			position:position,
			barangay:barangay,
			email:email,
			mobile:mobile,
			landline:landline,
			date:date,
			facityid:facityid
			},
		       function(data){
				if(data != 0)
				{
					window.location = "<?php echo base_url();?>student/rooms_available/"+facityid+'/'+data;
					//get_rooms(data,facityid);	
				}
			});	
		return false;	
	}
	
	function get_rooms(reserve_id,facityid)
	{
		$.post('<?php echo base_url();?>student/rooms_available',
			{
			reserve_id:reserve_id,
			facityid:facityid
			},
		       function(data){ 
			    $('#reserve_form').waitMe('hide');
				$('.modal-title').html('Rooms Available');
				$('.modal-body').html(data);
				$('#add_propertie').modal('show');
		});
	}
	
</script>

<div class="row" id="reserve_form">
	<div class="col-md-10">
    
	<?php
		$attributes = array('name' => 'reserve', 'id' => 'reserve', 'role' => 'form');
		echo form_open('#',$attributes);
		
	?>
    	<div class="form-group">
        	<label> Title of Activity</label>
            <input type="text" class="form-control" id="title_activity" name="title_activity" />
            <input type="hidden" id="date" name="date" value="<?php echo $this->input->post('date'); ?>" />
            <input type="hidden" id="facityid" name="facityid" value="<?php echo $this->input->post('facilityid'); ?>" />
        </div>
        <div class="form-group">
        	<label> Nature of activity</label>
            <select class="form-control" id="nature" name="nature">
            	<?php foreach($nature as $nt) { ?>
            		<option value="<?php echo $nt->activityID;?>"><?php echo $nt->Activity; ?></option>
                <?php } ?>
            </select>
        </div>
        <hr />
        <div class="form-group">
        	<label>Name of Organizer</label>
            <input type="text" class="form-control" id="organizer" name="organizer" />
        </div>
        <div class="form-group">
        	<label>Authorized Representative</label>
            <input type="text" class="form-control" id="representative" name="representative" />
        </div>
        <div class="form-group">
        	<label>Position</label>
            <input type="text" class="form-control" id="position" name="position" />
        </div>
        <hr />
        <div class="form-group">
        	<label>St/Brgy</label>
            <input type="text" class="form-control" id="barangay" name="barangay" />
        </div>
        <div class="form-group">
        	<label>City</label>
             <select class="form-control" id="city" name="city">
            	<?php foreach($city as $ct) { ?>
            		<option value="<?php echo $ct->CityID;?>"><?php echo $ct->City; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
        	<label>Email</label>
            <input type="text" class="form-control" id="email" name="email" />
        </div>
        <div class="form-group">
        	<label>Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" />
        </div>
        <div class="form-group">
        	<label>Landline or Fax</label>
            <input type="text" class="form-control" id="landline" name="landline" />
        </div>
        <div class="form-group">										
			<button type="submit" class="btn btn-primary">Submit</button>										
		</div>
     <?php
		echo form_close();
	?>
     
    </div>
    
    <!--<div class="col-md-2">
    		<div id="room_open"></div>
    </div>-->
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