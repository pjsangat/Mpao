<style type="text/css">
	.btn-primary { margin-bottom:10px;}
</style>
<link href="<?php echo base_url();?>assets/css/uploadfile.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/js/jquery.uploadfile.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
<script type="application/javascript">
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
		
		get_company_image('<?php echo $this->session->userdata('user_id');?>','company_information');
	});
	
	function get_company_image(uid,table)
	{
		$.post('<?php echo base_url();?>employer/get_content',
			{
			uid:uid,
			table:table
			},
		       function(data){ 
				  $('#company_logo').html(data);
		});
		
		return false;
	}
	
	
	
</script>

<div id="company_logo"></div>
