<script language="javascript">
	$(document).ready(function() {
		$("#fileuploader").uploadFile({
                    url:"<?php echo base_url();?>employer/upload_logo",
                    fileName:"upl",
					onSuccess:function(files,data,xhr)
					{
						if(data == '1')
						{
							get_company_image('<?php echo $this->session->userdata('user_id');?>','company_information');	
						}
					}
            });
		
		 $("#employer_job_listing").validate({
                rules: {
					company_name:"required",
					company_overview:"required"
                },
				
				errorPlacement: function () {
            		return false;
        		},
                submitHandler: function(form) {
                  // form.submit();
                  editUser();
				   //register();
                }
        });
		
	});
	
	function editUser()
	{
		alert('tet');
		return false;
	}
	
	tinymce.init({
		    selector: "#description",
			width: "50",
		    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});
</script>
<div class="main_content">
<div class="row">
    <div class="span12 product_listing"></div>
  </div>
  
  <h3 class="title"><span class="pull-left">Company Information</span></h3>
 	<ul class="nav nav-tabs">
          <li class="active"><a href="#company_info" data-toggle="tab">Compnay Info</a></li>
          <li><a href="#company_image" data-toggle="tab">Company Logo</a></li>
          
	</ul>
    
    <div class="tab-content">
    
        <div class="tab-pane active" id="company_info">
                <form id="employer_job_listing" name="employer_job_listing" method="post">
                    <div class="form-group">
                        <label>Company Name</label>
                            <input class="form-control" id="company_name" name="company_name" value="<?php echo $logo['company_name']; ?>">
                    </div>
                                                       
                    <div class="form-group">
                        <label>Company Overview</label>
                            <textarea class="form-control" id="company_overview" name="company_overview">
                            	<?php echo $logo['company_overview']; ?>
                            </textarea>
                    </div>
                    
                    <div class="modal-footer">   
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
        
        <div class="tab-pane" id="company_image">
             <div id="fileuploader">Upload</div>
             <img src="<?php echo base_url().'/'. $logo['logo_thumbnail']; ?>" class="img-thumbnail" alt="Rounded Image">
        </div>
        
    
    </div>
    </div>