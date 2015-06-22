<!DOCTYPE HTML>

</html>
		<head>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/bootstrap.min.css' />
	<link rel="stylesheet" type="text/css" href="<?php   echo base_url();  ?>assets/boosstrap/media/css/jquery.dataTables.css">
  	<script type="text/javascript" language="javascript" src="<?php   echo base_url();  ?>assets/boosstrap/media/js/jquery.dataTables.js"></script>
  	<script type="text/javascript" language="javascript" src="<?php   echo base_url();  ?>assets/boosstrap/resources/syntax/shCore.js"></script>
  	<script type="text/javascript" language="javascript" src="<?php   echo base_url();  ?>assets/boosstrap/resources/demo.js"></script>

<style>
.mygrid-wrapper-div {
  
    overflow: scroll;
}

  .alignRight { text-align: right; }



</style>

<script type="text/javascript" language="javascript" class="init">
   
   $(document).ready(function() {


  $("#facility").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax": "http://localhost/ateneo_mpao/assets/boosstrap/script/server_processing.php"

  } );

    $("#facility tbody").on('click', 'tr', function () {
    var name = $('td', this).eq(0).text();
    alert( 'You clicked on '+name+'\'s row' );

  } );


  $("#spaces").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax": "boosstrap/script/spaces.php"
  } );

    $("#spaces tbody").on('click', 'tr', function () {
    var name = $('td', this).eq(0).text();
    alert( 'You clicked on '+name+'\'s row' );

  } );

  $("#require").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax": "boosstrap/script/require.php"
       
  } );

    $("#require tbody").on('click', 'tr', function () {
    var name = $('td', this).eq(0).text();
    alert( 'You clicked on '+name+'\'s row' );

  } );




} );


$(function() {  
    var window_height = $(window).height(),
       content_height = window_height - 200;

    $('.mygrid-wrapper-div').height(content_height);
});

$( window ).resize(function() {
    var window_height = $(window).height(),
       content_height = window_height - 200;
    $('.mygrid-wrapper-div').height(content_height);
});

</script>

		</head>
		<body>
			<div class="container">
				<div class="row">
					<div class="span12">
						<div class="well">
							<center><h1>Ask Question . .</h1></center>
						</div>
					</div>
				</div>