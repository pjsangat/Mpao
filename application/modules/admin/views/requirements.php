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


      $("#rate").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax": "<?php  echo base_url(); ?>" + "assets/boosstrap/script/rate.php"
  } );

    $("#rate tbody").on('click', 'tr', function () {
    var name = $('td', this).eq(0).text();
    alert( 'You clicked on '+name+'\'s row' );

  } );


  $("#unit").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax": "<?php  echo base_url(); ?>" + "assets/boosstrap/script/unit.php"
  } );

    $("#unit tbody").on('click', 'tr', function () {
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

  <?php echo form_open('admin/addrequirement'); ?>

<div class="row">
   <div class="col-lg-2">
    <label>Requirement Name:</label>
  </div>
  <div class="col-lg-3">
    <label>Requirement Name:</label>
    <input type="text" class="form-control"  name="newrequire" placeholder="Requirement Name" required>
  </div>

  <div class="col-lg-1">
    <div class="span6 pull-right" style="text-align:right"></br>
      <input type="submit" value="ADD" class="btn btn-success btn-lg">
    </div>
  </div>
  <div class="col-lg-3"></br>
    <?php if($this->session->flashdata('newrequirementname')) 
    {  ?>
    <label style="color:green">New Requirement Name Added.</label>
    <?php }?>
  </div>

</div>
<?php  echo form_close();  ?>
  </br></br>


   <?php
   
    echo form_open('admin/insertnewrequirementrate');
   ?>
 <div class="row">
  <div class="col-lg-2"><h5>Add Requirement Charges</br>(Per Facility) </h5>
  </div>
  

  <div class="col-lg-3">
              <label>Select Specific Requirement \ Equipment ?</label></br>


                    <select class="form-control" name="require_name" style="max-Width:150px;" required>
                      <option value="">------------------------------</option>
                     <?php 

                      foreach ($requirementsdata as $row) {
                 
                      ?>

                         <option value="<?php  echo $row->requirement_ID; ?>"><?php echo $row->requirement_name;?></option>
                      <?php

                      }

                       ?>
                    </select>

  </div>


  <div class="col-lg-3">
                   <label>Select Specific Facility to Apply </label></br>

                    <select class="form-control" name="facility" style="max-Width:200px;" required>

                      <option value="">------------------------------</option>
                            <?php 

                      foreach ($facilityall as $row) {
                 
                      ?>

                         <option value="<?php echo $row->facility_iD; ?>"><?php echo $row->Facility_name; ?></option>
                      <?php

                      }

                       ?>
  
                    </select>
  </div>


    <div class="col-lg-3">
     <label>Select Unit to Apply </label></br>

                    <select class="form-control" name="unit">
                      <option value="">------------------------------</option required>
                      <?php
                      foreach ($unittype as $row) {
                   
                      ?>
                       <option value="<?php echo $row->Unit_typeID; ?>"><?php  echo $row->Unit_typename; ?></option>
                      <?php


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

      <input type="number" class="form-control" placeholder="Desired Price" maxlength="11" name="price" required>
  </div>

    <div class="col-lg-3">

    <label>No. Requirement Available</label>

      <input type="number" class="form-control" placeholder="No. Requirement Available" maxlength="11" name="requirement_available"  required>
  </div>



   <div class="col-lg-3">

      <input type="hidden" class="form-control" placeholder="No. Person Maximum" >
</div>

   </br><div class="col-lg-3">
    <div class="span6 pull-right" style="text-align:right">
            <input type="submit" value="ADD" class = "btn btn-success">
      </div>

  </div>
</div>
<div class="row">
  <div class="col-lg-2">
  </div>
  <div class="col-lg-3"></br>

       <?php if($this->session->flashdata('newrequirementrate')) 
    {  ?>
       <label style="color:green;">New Requirement Rate Added.</label>
    <?php }?>
  </div>
</div>

<?php echo form_close(); ?></br>
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


<div class="panel panel-primary">


  <div class="panel-heading">Rate Type</div>
  <div class="panel-body">

<?php

   echo form_open('admin/insertratetype');

?>
                  

    <div class="row">
  <div class="col-lg-3"><h5>Add New Rate:</br>(ex. per head,per hour .. etc)</h5>
  </div>

  <div class="col-lg-3">
       <label>Rate Name:</label>
       <div class="input-group">
       <span class="input-group-addon" id="basic-addon2">per</span>
        <input type="text" class="form-control" placeholder="(ex. head,hours,group... etc)" name="Rate_name" {{ (Input::old('Rate_name')) ? 'value="'. e(Input::old('Rate_name')) .'"' : ''}}>
                     
                  </div>
  </div>
  <div class="col-lg-2">
      <label>Rate Referrence:</label>
    <select name="ratereferrence" class="form-control" required>
      <option value="">------------------</option>
      <?php
      foreach ($ratereferrence as $row) {       
      ?>
      <option value="<?php echo $row->ratereferrenceID; ?>"><?php  echo $row->referrenceName; ?></option>
      <?php
      }?>
    </select>
  </div>
 </br>
   <div class="col-lg-1">

  <input type="submit" value="ADD" class = "btn btn-success">

  </div>
  <div class="col-lg-2">
     <?php if($this->session->flashdata('newratetype')) 
    {  ?>
        <label style="color:green;">New Rate Added.</label>
    <?php }?>
  </div>
</div>
<?php

  echo form_close();
?>

</br>
<div class="mygrid-wrapper-div" >
   <table id="rate" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
          <th>Rate type</th>
          <th>Rate Referrence type</th>
          </tr>
        </thead>

        <tfoot>
        <tr>
           <th>Rate type</th>
           <th>Rate Referrence type</th>
  
          </tr>
        </tfoot>
      </table>

</div>
  </div>  
</div>



<div class="panel panel-primary">


  <div class="panel-heading">Requirement \ Equipment (Unit type)</div>
  <div class="panel-body">

  <?php
    echo form_open('admin/insertnewunitype');
  ?>
    
                  

    <div class="row">
  <div class="col-lg-3"><h5>Add New Unit Type:</br>(ex. per set,per pcs .. etc)</h5>
  </div>

  <div class="col-lg-3">
       <label>Unit Name:</label>
       <div class="input-group">
        <span class="input-group-addon" id="basic-addon2">per</span>
        <input type="text" class="form-control" placeholder="(ex. set,pcs,... etc)" name="Unit_name" {{ (Input::old('Unit_name')) ? 'value="'. e(Input::old('Unit_name')) .'"' : ''}}>
                     
                  </div>
  </div>
 </br>

   <div class="col-lg-3">

  <input type="submit" value="ADD" class = "btn btn-success">

  </div>
</div>
<?php
  
  echo form_close();

  

?>

<div class="mygrid-wrapper-div" >
   <table id="unit" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
          <th>Unit Type</th>
          </tr>
        </thead>

        <tfoot>
        <tr>
           <th>Unit Type</th>
  
          </tr>
        </tfoot>
      </table>

</div>


  </div>  
</div>


<?php
include_once('myfooter.php');
?>