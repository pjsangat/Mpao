<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/waitMe.css">
<script src="<?php echo base_url();?>assets/js/waitMe.js"></script>
<script language="javascript">
	$(document).ready(function() {
		var current_effect = 'bounce';
		 $("#change_password").validate({
                rules: {
					password:{
						required:true,
						minlength : 5
					},
					confirm_password: {
						required:true,
						minlength : 5,
						equalTo : "#password"
					}
                },
				errorPlacement: function () {
            		return false;
        		},
                submitHandler: function(form) {
                  run_waitMe('#confirm_password',current_effect);
                  change_pword();
				   //register();
                }
        });
	});
	
	function run_waitMe(field,effect)
	{
			$(field + ' > form').waitMe({
				effect: effect,
				text: 'Please wait...',
				bg: 'rgba(255,255,255,0.7)',
				color:'#000',
				sizeW:'',
				sizeH:''
			});
	}
	
	function change_pword()
	{
		var password    = $('#password').val();
		$.post('<?php echo base_url();?>employer/change_pass',
			{
			password:password
			},
		       function(data){
				alert(data);
				$('#confirm_password > form').waitMe('hide');
			});	
		return false;
	}
	
	function change_notification()
	{
		var email_notification = jQuery("input:radio[name=optradio]:checked").val();
		$.post('<?php echo base_url();?>employer/update_notification',
			{
			email_notification:email_notification
			},
		       function(data){
				alert(data);
			});	
		return 	false;
	}
</script>
<div class="main_content">
<div class="row">
    <div class="span12 product_listing"></div>
  </div>
  
  <h3 class="title"><span class="pull-left">Company Settings</span></h3>
 	<ul class="nav nav-tabs">
          <li class="active"><a href="#confirm_password" data-toggle="tab">Change Password</a></li>
          <li><a href="#notification" data-toggle="tab">Notification</a></li>
          <li><a href="#delete_account" data-toggle="tab">Delete Account</a></li>
          
	</ul>
    
    <div class="tab-content">
    
        <div class="tab-pane active" id="confirm_password">
                <form id="change_password" name="change_password" method="post">
                    <div class="form-group">
                        <label>Password</label>
                            <input class="form-control" id="password" name="password" type="password">
                    </div>
                                                       
                    <div class="form-group">
                        <label>Confirm Password</label>
                             <input class="form-control" id="confirm_password" name="confirm_password" type="password">
                    </div>
                    
                    <div class="modal-footer">   
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            	</form>
        </div>
        
        <div class="tab-pane" id="notification">
        	<div class="form-group">
                <label>Email Notification</label>
                <div class="radio">
  					<label><input type="radio" id="email_notification" name="optradio" value="1" <?php if($notification['email_notification'] == '1') { ?>checked="checked" <?php } ?>>Yes</label>
				</div>
				<div class="radio">
  					<label><input type="radio" id="email_notification" name="optradio" value="0" <?php if($notification['email_notification'] == '0') { ?>checked="checked" <?php } ?>>No</label>
				</div>
          	</div>
             <button type="submit" class="btn btn-primary" onclick="change_notification(); return false;">Save changes</button>
        </div>
        
        <div class="tab-pane" id="delete_account">
        	<br />
            <p>Deleting your account will delete all of the content you have created. It will be completely irrecoverable.</p>
           <button type="submit" class="btn btn-primary">Delete Account</button>
        </div>
        
    
    </div>
    </div>