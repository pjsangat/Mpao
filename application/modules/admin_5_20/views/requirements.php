<?php include_once('header.php'); ?>

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
   
   $(document).ready(function() {

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
  <div class="panel-heading">Requirements / Equipments </div>
  <div class="panel-body">

    <label>Add New Requirement:</label></br>

  <?php  echo form_open('admin/requirement/addrequirement') ; ?>

<div class="row">
   <div class="col-lg-2">
    <label>Requirement Name:</label>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control" style="min-width:200px" name="newrequire" placeholder="Requirement Name" required>
  </div>
  <div class="col-lg-1">
    <input type="submit" value="Add" class="btn btn-success btn-lg">
  </div>
  
  
</div>
<?php  echo form_close();  ?>
  </br></br>


   <?php
   
    echo form_open('requirement/addrequirement');
   ?>
 <div class="row">
  <div class="col-lg-2"><h5>Add Requirment Spaces (Per Activity) </h5>
  </div>
  

  <div class="col-lg-3">
     <label>Select Specific Requirement \ Equipment?</label></br>


                    <select class="combobox" name="require_name" style="max-Width:250px;" required>
                      <option value="">------------------------------</option>
                  <?php  var_dump($requirementsdata); ?>
                    </select>

  </div>


  <div class="col-lg-3">
     <label>Select Specific Activity to Apply </label></br>

                    <select class="combobox" name="activity" style="max-Width:200px;" required>
                      <option value="">------------------------------</option>
                      <?php
                      $select = mysqli_query($con,"Select facility_ID,Facility_Name from tfacility");
                     
                     while($getcat = mysqli_fetch_array($select))
                     {
                       echo "<option value=".$getcat[0].">".$getcat[1]."</option>";
                     }

                      ?>
                    </select>
  </div>


    <div class="col-lg-3">
     <label>Select Unit to Apply </label></br>

                    <select class="combobox" name="unit">
                      <option value="">------------------------------</option required>
                      <?php
                      $select = mysqli_query($con,"Select Unit_typeID,Unit_typename from tunit_type");
                     
                     while($getrequi = mysqli_fetch_array($select))
                     {
                       echo "<option value=".$getrequi[0].">".$getrequi[1]."</option>";
                     }

                      ?>
                    </select>
  
  </div></div>
  </br>

<div class="row">
     <div class="col-lg-2">

      <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
</div>



   <div class="col-lg-3">

    <label>Desired Price</label>

      <input type="number" class="form-control" placeholder="Desired Price" maxlength="11" name="price" {{ (Input::old('price')) ? 'value="'. e(Input::old('price')) .'"' : ''}} required>
  </div>

    <div class="col-lg-3">

    <label>No. Requirement Available</label>

      <input type="number" class="form-control" placeholder="No. Requirement Available" maxlength="11" name="requirement_available" {{ (Input::old('requirement_available')) ? 'value="'. e(Input::old('requirement_available')) .'"' : ''}} required>
  </div>



   <div class="col-lg-3">

      <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
</div>

   </br><div class="col-lg-3">
<div class="span6 pull-right" style="text-align:right">
            <input type="submit" value="Submit" class = "btn btn-success">
      </div>

  </div>
</div>

<?php form_close(); ?></br>
<div class="mygrid-wrapper-div" >



      <table id="require" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
          <th>Requirement Name</th>
           <th>Facility</th>
            <th>Unit Type</th>
             <th>Price</th>
              <th>Available Item</th>
          </tr>
        </thead>

        <tfoot>
        <tr>
             <th>Requirement Name</th>
           <th>Facility</th>
            <th>Unit Type</th>
             <th>Price</th>
              <th>Available Item</th>
          </tr>
          </tr>
        </tfoot>
      </table>

</div>

 
  </div>
</div>

<?php
include_once('myfooter.php');
?>