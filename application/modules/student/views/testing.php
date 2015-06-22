<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- Latest compiled and minified CSS -->
<link href="<?php echo base_url();?>assets/bootstrapdatepicker/css/bootstrap-datepicker3.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">


<!-- jQuery library -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/bootstrapdatepicker/js/bootstrap-datepicker.js"></script>

<!-- Latest compiled JavaScript -->


</head>

<body>
<div id="Grid">
    <input type="text" class="date" id="sunday"/>
    <input type="text" class="date" id="monday"/>
    <input type="text" class="date" id="tuesday"/>
    <input type="text" class="date" id="wednesday"/>
    <input type="text" class="date" id="sunday"/>
    <input type="text" class="date" id="monday"/>
    <input type="text" class="date" id="tuesday"/>
    <input type="text" class="date" id="wednesday"/>
  </div>
<script language="javascript">
	$(function(){
		$('#Grid').find('input[class="date"]').each(function(){
			 alert("Changed: " + this.id);
		});
	});//document ready

//Create a function for datepicker
function makeDatepicker(id){
  alert(id);
}
</script>
</body>
</html>