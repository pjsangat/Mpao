<style type="text/css">
	.error {
		border: 1px solid #f00;
		background-color: #ffc;
	}
</style>
<script language="javascript">
	$(document).ready(function() {
	  $("#forgotpassword").validate({
                rules: {
					email:{
						required:true,
						email:true
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
                  // form.submit();
                  sendEmail();
				   //register();
                }
        });
		
		function sendEmail()
		{
			var email = $("#email").val();
			$.post('<?php echo base_url();?>users/sendEmail',
			{
			email:email
			},
		  	function(data){
				alert(data);	  
			});
		}
	  
	});
</script>
<div class="main_content">

      <form class="form-signin" action='#' id="forgotpassword" method="POST">
        <h2 class="form-signin-heading">Forgot Password</h2>
        <div class="form-group">
										<label for="inputPassword3">Email</label>
										<input type="text" class="form-control" id="email" name="email" placeholder="Email" style="width:200px">
									</div>
        
        <div class="form-group">										
										<button type="submit" class="btn btn-primary">Sign in</button>		
										<!--<button type="submit" class="btn btn-default"><img src="./Register   eDirectory_files/social-facebook.png" alt="Facebook" width="17px"> Sign in with Facebook</button>-->
									</div>
      </form>

</div> <!-- /container -->
