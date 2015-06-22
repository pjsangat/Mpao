<style type="text/css">
	.btn-primary { margin-bottom:10px;}
</style>
<script src="<?php echo base_url();?>assets/js/boostrap_dialog.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css">
<script type="application/javascript">
	function edit(id,table,title)
	{
		$.post('<?php echo base_url();?>employer/get_single_content',
		{
			id:id,
			table:table
		},
		function(data){
			$('.modal-title').html(title);
			$('.modal-body').html(data);
			$('#add_propertie').modal('show');
		});	
		return false;
	}
	
	function get_applicants(job_id,job_title)
	{
		$.post('<?php echo base_url();?>employer/get_applicants',
		{
			job_id:job_id,
			job_title:job_title
		},
		function(data){
			$('.modal-title').html('Applicant for '+job_title);
			$('.modal-body').html(data);
			$('#add_propertie').modal('show');
		});	
		return false;	
	}
	
	function addjob(title,form_name)
	{
		$.post('<?php echo base_url();?>employer/get_form',
		{
			form_name:form_name
		},
		function(data){
			$('.modal-title').html(title);
			$('.modal-body').html(data);
			$('#add_propertie').modal('show');
		});	
		return false;
	}
	
	function __confirm(id,message,table)
		{
			BootstrapDialog.confirm(message, function(result){
				if(table == 'company_joblisting')
				{
					if(result) {
						$.post('<?php echo base_url();?>employer/delete',
						{
							id:id,
							table:table
						},
						function(data){
							if(data == '1')
							{
								location.reload();	
							}
						});		
					}
				} else if(table == 'gadgets' || table == 'user_bookmark' || table == 'followed') {
					if(result) {
						waiteme();
						$.post('<?php echo base_url();?>members/delete',
						{
							id:id,
							table:table,
						},
						function(data){
							if(data == '1')
							{
								location.reload();	
							}
						});		
					}	
				}
					
			});
		}
</script>

<div class="main_content">
  <div class="row">
    <div class="span12 product_listing"></div>
  </div>
  
  <h3 class="title"><span class="pull-left">Job Listing</span></h3>
 
   <button type="button" class="btn btn-primary" onclick="addjob('Add Job Opening','add_form'); return false;">Add Job</button>
  <?php
  	if(empty($job)) {
		echo 'No job was found';	
	} else {

							foreach($job as $jb) {
						?>
  <div class="listing-item">
    <div class="row">
      <div class="col-md-7">
        <div class="featured-item">
          <div class="row">
            <div class="col-md-4"> <h5> <a href="<?php echo base_url();?>jobs/job-opening/<?php echo $jb->id.'/'.preg_replace("![^a-z0-9]+!i", "-",$jb->title);?>"> <?php echo $jb->title;?> </a> </h5>
            <p>
            	<a href="#" onclick="edit('<?php echo $jb->id; ?>','company_joblisting','Edit Job'); return false;">Edit</a> | 
            	<a href="#" onclick="__confirm('<?php echo $jb->id; ?>','Delete Job Posting?','company_joblisting'); return false;">Delete</a> | <a href="#" onclick="get_applicants('<?php echo $jb->id; ?>','<?php echo $jb->title;?>'); return false;">Applicants</a>
            </p>
            
            </div>
            <div class="col-md-8">
              
              <p><?php echo substr(strip_tags($jb->description),0,150);?>...</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="other_info">
          <p> <strong>Salary:</strong> $<?php echo $jb->salary;?><br>
            <strong>Date Posted:</strong> <?php echo $this->date_config->per_page($jb->time_posted);?><br>
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php
							}
	}
							echo $pagination;
	?>
</div>


<div id="add_propertie" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
      			<div class="modal-dialog">
        			<div class="modal-content">
						<div class="modal-header">
            				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            				<h4 class="modal-title"></h4>
          				</div>
          					<div class="modal-body"></div>
        			</div><!-- /.modal-content -->
      			</div><!-- /.modal-dialog -->
    		</div> <!-- /.modal -->
