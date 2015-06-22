<style type="text/css">
	.error {
		border: 1px solid #f00;
		background-color: #ffc;
	}
	#infoMessage { color:red; }
</style>
<script language="javascript">
	$(document).ready(function() {
		
		 $("#register").validate({
                rules: {
					first_name:"required",
					last_name:"required",
					password1:{
						required:true,
						minlength : 5
					},
					password2: {
						required:true,
						minlength : 5,
						equalTo : "#password1"
					},
					email:{
						required:true,
						email:true,
						remote: {
							url:"<?php echo base_url();?>auth/checkEmails/",
							type:"post",
							data : {
								email : function(){
									return $("#email").val();
								},
								csrf_test_name : function(){
									return $("input[name=csrf_test_name]").val();
								}
							}
						}
					}
                },
				messages: {
					email:{
						remote:"Email Already Exist"
					}
                },
				errorPlacement: function () {
            		return false;
        		},
                submitHandler: function(form) {
                  waiteme();
                  addUser();
				   //register();
                }
        });
	});
	
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
	
	function addUser() {
		var first_name    = $('#first_name').val();
		var last_name    = $('#last_name').val();
		var password1    = $('#password1').val();
		var email    = $('#email').val();
		var type    = $('#type').val();
		var csrf_test_name = $("input[name=csrf_test_name]").val();
			$.post('<?php echo base_url();?>auth/register',
			{
			first_name:first_name,
			last_name:last_name,
			password1:password1,
			email:email,
			type:type,
			csrf_test_name:csrf_test_name
			},
		       function(data){
				if(data == '1')
				{
					$('#register')[0].reset();
					$('#containers').waitMe('hide');	
				}
			});	
	}
</script>
<div class="main_content" id="containers">						
						<h3 class="title"><span class="pull-left">LOGIN / REGISTER</span></h3>						
						<div class="row">
							<div class="col-md-6">
								<h4>Returning Client</h4>
								
                               
								
                                 <?php
								 	echo form_open('auth/login');
								 ?>
                                 <div id="infoMessage"><?php echo $message;?></div>
									<div class="form-group">
										<label for="inputEmail3">Email Address</label>
                                        
										<input type="email" class="form-control" id="identity" name="identity" placeholder="Email">
									</div>
									<div class="form-group">
										<label for="inputPassword3">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Password">
									</div>
									<div class="form-group">										
										<label><input type="checkbox"> Remember me</label>										
									</div>
									<div class="form-group">										
										<button type="submit" class="btn btn-primary">Sign in</button>		
										<!--<button type="submit" class="btn btn-default"><img src="./Register   eDirectory_files/social-facebook.png" alt="Facebook" width="17px"> Sign in with Facebook</button>-->
									</div>
									<div class="form-group">		
										<a href="<?php echo base_url();?>auth/forgot_pass">Forgot Password</a>										
									</div>
								<?php
									echo form_close();
								?>
							</div>
                            
							<div class="col-md-6">
								<h4>New Client</h4>
								
                                 <?php
								 	$attributes = array('name' => 'register', 'id' => 'register', 'role' => 'form');
								 	echo form_open('#',$attributes);
								 ?>	
									<div class="form-group">
										<label for="inputFirstName">First Name</label>
                                      
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
									</div>
									<div class="form-group">
										<label for="inputLastName">Last Name</label>
										<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
									</div>
                                    <div class="form-group">
										<label for="inputEmail3">Type</label>
										<select class="form-control" id="type" name="type">
                                        	<option value="2">Ateneo Student</option>
                                            <option value="3">Non-Student</option>
                                        </select>
									</div>
									<div class="form-group">
										<label for="inputEmail3">Email Address</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<label for="inputPassword1">Password</label>
										<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
									</div>
									<div class="form-group">
										<label for="inputPassword2">Confirm Password</label>
										<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
									</div>									
									<div class="form-group">										
										<button type="submit" class="btn btn-primary">Create your account</button>										
									</div>
								<?php
									echo form_close();
								?>
							</div>
						</div>						
</div>