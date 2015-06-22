<script language="javascript">
	 tinymce.init({
		    selector: "#description-<?php echo $info['id']; ?>",
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
					  edit_job_action('company_joblisting');
					}
		});
	});
	
	function edit_job_action(table)
	{
		var id    = $('#id').val();
		var title    = $('#title').val();
		var description    =  tinymce.get('description-<?php echo $info['id']; ?>').getContent();
		var salary    = $('#salary').val();
		var type    = $('#type').val();
		var category    = $('#category').val();
		$.post('<?php echo base_url();?>employer/edit_action',
		{
			id:id,
			title:title,
			description:description,
			salary:salary,
			type:type,
			table:table,
			category:category
		},
		function(data){
			custom_message(data);
			$('#add_propertie').modal('hide');
		});	
		return false;	
	}
</script>

<form id="employer_job_listing" name="employer_job_listing" method="post">
	<div class="form-group">
  		<label>Title</label>
        	<input class="form-control" id="title" name="title" value="<?php echo $info['title']; ?>">
            <input type="hidden" name="id" id="id" value="<?php echo $info['id']; ?>">
  	</div>
    
    <div class="form-group">
    	<label>Category</label>
       		<select class="form-control" id="category" name="category">
            	<?php
					foreach($category as $cat)
					{
				?>
           				<option value="<?php echo $cat->id;?>" <?php if($cat->id == $info['category_id']) { ?> selected="selected" <?php } ?>><?php echo $cat->category_name;?></option>
               	<?php
					}
				?>
        	</select>
 	</div>
                                       
 	<div class="form-group">
    	<label>Job Description</label>
      		<textarea class="form-control" rows="3" id="description-<?php echo $info['id']; ?>" name="description-<?php echo $info['id']; ?>" cols="120"><?php echo $info['description']; ?></textarea>
  	</div>
    
    <div class="form-group">
    	<label>Salary</label>
        <div class="form-group input-group">
     		<span class="input-group-addon">$</span>
        	<input type="text" class="form-control" id="salary" name="salary" value="<?php echo $info['salary']; ?>">
        	<span class="input-group-addon">.00</span>
 		</div>     		
  	</div>
    
   	<div class="form-group">
    	<label>Type</label>
       		<select class="form-control" id="type" name="type">
           		<option value="Full Time" <?php if($info['type'] == 'Full Time') { ?> selected="selected" <?php }?>>Full Time</option>
           		<option value="Part Time" <?php if($info['type'] == 'Part Time') { ?> selected="selected" <?php }?>>Part Time</option>
        	</select>
 	</div>
    
   	<div class="modal-footer">   
   		<button type="submit" class="btn btn-primary">Save changes</button>
   		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  	</div>
</form>