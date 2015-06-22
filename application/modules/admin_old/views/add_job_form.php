<script language="javascript">
 tinymce.init({
		    selector: "#description",
		    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		});
	$(document).ready(function() {
		$("#employer_job_listing").validate({
					rules: {
						title:"required",
						description:"required",
						salary:"required"
					},
					submitHandler: function(form) {		  
					  add_job_action('company_joblisting');
					}
		});
	});
	
	function add_job_action(table)
	{
		var title    = $('#title').val();
		var description    =  $('#description').val();
		var salary    = $('#salary').val();
		var type    = $('#type').val();
		var category    =  $('#category').val();
		$.post('<?php echo base_url();?>employer/add_job_action',
		{
			table:table,
			title:title,
			description:description,
			salary:salary,
			type:type,
			category:category
		},
		function(data){
			if(data == '1')
			{
				$('#add_propertie').modal('hide');
				custom_message('Job Posted');
			}
		});	
		return false;	
	}
</script>
<form id="employer_job_listing" name="employer_job_listing" method="post">
	<div class="form-group">
  		<label>Title</label>
        	<input class="form-control" id="title" name="title">
  	</div>
    
    <div class="form-group">
    	<label>Category</label>
       		<select class="form-control" id="category" name="category">
            	<?php
					foreach($category as $cat)
					{
				?>
           				<option value="<?php echo $cat->id;?>"><?php echo $cat->category_name;?></option>
               	<?php
					}
				?>
        	</select>
 	</div>
                                       
 	<div class="form-group">
    	<label>Summary</label>
      		<textarea class="form-control" rows="3" id="description" name="description" cols="120"></textarea>
  	</div>
    
    <div class="form-group">
    	<label>Salary</label>
        <div class="form-group input-group">
     		<span class="input-group-addon">$</span>
        	<input type="text" class="form-control" id="salary" name="salary">
        	<span class="input-group-addon">.00</span>
 		</div>     		
  	</div>
    
   	<div class="form-group">
    	<label>Type</label>
       		<select class="form-control" id="type" name="type">
           		<option value="Full Time">Full Time</option>
           		<option value="Part Time">Part Time</option>
        	</select>
 	</div>
    
   	<div class="modal-footer">   
   		<button type="submit" class="btn btn-primary">Save changes</button>
   		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  	</div>
</form>