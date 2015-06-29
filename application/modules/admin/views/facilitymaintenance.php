<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/css/admin/jquery.dataTables.css'>
<script type="text/javascript" language="javascript" src='<?php echo base_url(); ?>assets/js/admin/jquery.dataTables.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo base_url(); ?>assets/js/admin/shCore.js'></script>
<script type="text/javascript" language="javascript" src='<?php echo base_url(); ?>assets/js/admin/demo.js'></script>

<style>
.mygrid-wrapper-div {
  
    overflow: scroll;
}

  .alignRight { text-align: right; }



</style>

<script type="text/javascript" language="javascript" class="init">


window.onload = function() {
document.getElementById('femaleradio').onchange = disablefield;
document.getElementById('maleradio').onchange = disablefield;
document.getElementById('bothradio').onchange = disablefield;
}

function disablefield()
{
if ( document.getElementById('femaleradio').checked == true ){
  document.getElementById('malemax').value = 0;
  document.getElementById('malemax').disabled = true;
  document.getElementById('femalemax').disabled = false;}

else if (document.getElementById('maleradio').checked == true ){
       document.getElementById('femalemax').value = 0;
        document.getElementById('malemax').value = 0;
      document.getElementById('femalemax').disabled = true;
      document.getElementById('malemax').disabled = false;}

else if (document.getElementById('bothradio').checked == true ){
   document.getElementById('malemax').value = 0;
    document.getElementById('femalemax').value = 0;
document.getElementById('malemax').disabled = false;
document.getElementById('femalemax').disabled = false;}

}

   
   $(document).ready(function() {

  $("#facility").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax":  "<?php  echo base_url(); ?>" + "assets/boosstrap/script/server_processing.php"

  } );

    $("#facility tbody").on('click', 'tr', function () {
    var name = $('td', this).eq(0).text();
    alert( 'You clicked on '+name+'\'s row' );

  } );





  $("#spaces").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax": "<?php  echo base_url(); ?>" + "assets/boosstrap/script/spaces.php"
  } );

    $("#spaces tbody").on('click', 'tr', function () {
    var name = $('td', this).eq(0).text();
    alert( 'You clicked on '+name+'\'s row' );

  } );






  $("#require").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax":"<?php  echo base_url(); ?>" + "assets/boosstrap/script/require.php"
       
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




<div class="panel panel-primary">

  <div class="panel-heading">Facility</div>
    <div class="panel-body">



  	           <?php
                  $uploadmsg = $this->session->flashdata('uploadmsg');
                  if(!empty($uploadmsg))
                  {
                      ?>
                  
                       <font color="green"><?php echo $uploadmsg; } ?></font>

                  <?php 
                  $uploaderror = $this->session->flashdata('uploaderror');
                  if(!empty($uploaderror))
                  {
                  ?>
                      <font color="red"><?php echo $uploaderror; } ?></font>

                    <?php
                  
                  echo form_open('admin/facilitymaintenance');
                 ?>
                 
    <div class="row">
      <div class="col-lg-2"><h5>Add new Facility:</h5>
      </div>
      <div class="col-lg-2">
          <label>Facility Name:</label>
                <input type="text" class="form-control" placeholder="Facility Name" name="facility"  required>
      </div>
      <div class="col-lg-2">    <label>Facility Description:</label></br>
         <textarea class="form-control" rows="3" placeholder="Facility Description" name="description" required></textarea>
    </div>
    <div class="col-lg-2"><label>Control Number Header Format:</label></br>
        <input type="text" class="form-control" placeholder="Control Number Header" name="control"  required>
      </div>

    <div class="col-lg-2">    <label>Facility Type:</label></br>
      <select name="typefacility" style="max-Width:250px;" required>
          <option value="1">Event type</option>
          <option value="2">Room type</option>
      </select>
    </div></br>

      <div class="col-lg-1"></br>
        <div class="span6 pull-right" style="text-align:right">
        <input type="submit" value="ADD" class = "btn btn-success">
        </div>
      </div>
    </div>

   <?php
      echo form_close();
     ?>

  <hr size="30"/>

  <?php echo form_open_multipart('admin/uploadfile');?>

  <div class="row">
    <div class="col-lg-3"><h5>Add PDF FILE Facility:</h5>
      </div>

        <div class="col-lg-3"><h5>Choose Facility to Apply:</h5>

          <select class="form_control" name="facility" required>

             
               <?php foreach ( $facilityall as $row ) {  ?>
                     <option value="<?php  echo $row->facility_iD;?>"><?php echo $row->Facility_name; ?></option>   
                <?php  } ?>

          </select>

      </div>
        <div class="col-lg-3"><h5>Tearms and Conditions</h5>

        <input  type="file" name="userfile"  required>

      </div>
       <div class="col-lg-2"></br>
        <div class="span6 pull-right" style="text-align:right">
        <input type="submit" value="UPDATE" class = "btn btn-success">
        </div>
      </div>


  </div></br>

<?php
  echo form_close();
?>


<div class="mygrid-wrapper-div" >

      <table id="facility" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
          <th>Facility_name</th>
            <th>Facility_Description</th>
             <th>Control_Number_Header</th>
            <th>Date_created</th>
            <th>PDF_File</th>
            
          </tr>
        </thead>

        <tfoot>
        <tr>
          <th>Facility_name</th>
            <th>Facility_Description</th>
            <th>Control_Number_Header</th>
            <th>Date_created</th>
            <th>PDF_File</th>
          </tr>
        </tfoot>
      </table>

</div>

  </div>  
</div>


  <div class="panel panel-primary">
      <div class="panel-heading">Rent Spaces</div>
      <div class="panel-body">

                   <?php
                    echo form_open('admin/insertrentspace');
                   ?>
               
      <div class="row">
          <div class="col-lg-2"><h5>Add New Rent Spaces</h5></div>
            <div class="col-lg-3">
              <label>Rent Space Name</label>
              <input type="text" class="form-control" placeholder="Rent Space Name" name="Rent_Space_Name"  required>
            </div>

         <div class="col-lg-3">
            <label>belong to what Facility ?</label></br>
              <select class="combobox" name="facility_category" required>
                <option value="">------------------------------</option>

                <?php foreach ( $facilityall as $row ) {  ?>
                     <option value="<?php  echo $row->facility_iD;?>"><?php echo $row->Facility_name; ?></option>   
                <?php  } ?>

              </select>
         </div>

     <div class="col-lg-3">
        <label>No. person Maximum</label>
        <input type="number" class="form-control" placeholder="No. Person Maximum" maxlength="15" name="maximum_person" value="0" required>
    </div>
    <div class="col-lg-2">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>
    <div class="col-lg-3"></br>

    <label>Gender type</label></br>
          <label class="radio-inline">
              <input type="radio" name="Gender" value="female" id="femaleradio">Female?
          </label>
          <label class="radio-inline">
             <input type="radio" name="Gender" value="male" id="maleradio">Male?
          </label>
          <label class="radio-inline">
              <input type="radio" name="Gender" value="both" id="bothradio">Both
          </label>
    </div>

    <div class="col-lg-1">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>
    <div class="col-lg-2"></br>
        <label>Other Facility?</label></br><label><input type="checkbox" class="form-control" name = "otherfac" value="true" >Yes</label>
    </div>

    <div class="col-lg-1">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>
  <div class="col-lg-2"></br>
       <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
  </div>

    <div class="col-lg-1">
      <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>
    <div class="col-lg-2">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>

    <div class="col-lg-3">
        <label>Max Number of Female</label></br><input type="number" id="femalemax" class="form-control" placeholder="Max Number of Female" maxlength="11" name="Max_female_person" value="0" required/>
        </br></div>
        <div class="col-lg-3">
          <label>Max Number of Male</label><input type="number" id="malemax" class="form-control" placeholder="Max Number of Male" maxlength="11" name="Max_male_person" value="0" required/>
        </div>
        <div class="col-lg-1">
          <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
        </div>
    <div class="col-lg-2">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>
    <div class="col-lg-2">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>

    <div class="col-lg-2">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div>
    <div class="col-lg-2">
        <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
    </div></br>
     <div class="col-lg-3"></br>
        <div class="span6 pull-right" style="text-align:right">
          <input type="submit" value="ADD" class = "btn btn-success">
        </div>
    </div>
    </div>
  <?php  form_close(); 
  ?></br>

<div class="mygrid-wrapper-div" >

      <table id="spaces" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
          <th>Rent Space Name</th>
            <th>Facility Belong</th>
            <th>Number Person Maximum</th>
                 <th>Number Male Person</th>
               <th>Number Female Person</th>
                <th>For Female</th>
              <th> For Male</th>
               <th>Bothe Gender</th>
                <th>Other Facility</th>
                <th>Date Created</th>
          </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Rent Space Name</th>
            <th>Facility Belong</th>
            <th>Number Person Maximum</th>
             <th>Number Male Person</th>
               <th>Number Female Person</th>

             <th>For Female</th>
              <th> For Male</th>
               <th>Bothe Gender</th>
                <th>Other Facility</th>
                  <th>Date Created</th>

          </tr>
        </tfoot>
      </table>

</div>
 
  </div>
</div>






