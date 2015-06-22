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
</script>

<div class="main_content">
  <div class="row">
    <div class="span12 product_listing"></div>
  </div>
  
  <h3 class="title"><span class="pull-left">Employer List</span></h3>
 
  
  <?php
  	if(empty($employer)) {
		echo 'No Companies was found';	
	} else {

							foreach($employer as $emp) {
						?>
  <div class="listing-item">
    <div class="row">
      <div class="col-md-7">
        <div class="featured-item">
          <div class="row">
            <div class="col-md-8"> <h5> <?php echo $emp->first_name .' '.$emp->last_name; ?>  </h5>
            <p>
            	<a href="#" onclick="edit('<?php echo $emp->id; ?>','company_joblisting','Edit Job'); return false;">Edit</a> | 
            	<a href="#" onclick="__confirm('<?php echo $emp->id; ?>','Delete Job Posting?','company_joblisting'); return false;">Delete</a> | <a href="<?php echo base_url().''.$emp->username;?>" target="_blank">Profile</a> | <a href="<?php echo base_url();?>admin/employer_job_list/<?php echo $emp->userid; ?>">Job Posted</a> 
            </p>
            
            </div>
         
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="other_info">
          <p>
            <strong>Date Registered:</strong> <?php echo $this->date_config->convert_data($emp->created_on);?>
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
