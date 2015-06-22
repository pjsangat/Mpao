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

  $("#chargesevent").dataTable( {
  
       "processing": true,
        "serverSide": true,
        "ajax":"<?php  echo base_url(); ?>" + "assets/boosstrap/script/chargesevent.php"
       
  } );

    $("#chargesevent tbody").on('click', 'tr', function () {
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



<?php echo form_open('admin/'); ?>
<div class="panel panel-primary">
  <div class="panel-heading">Room Type Charges</div>
  <div class="panel-body">
   <h4>Airconditioned Bedrooms</h4></br>
    <div class="row">
      <div class="col-lg-2"><label>Choose Rent Space ( Both Gender )</label></div>
      <div class="col-lg-2">
        <select class="form-control" name="rentspace" style="min-Width:150px;" required>
          <?php   foreach ($rentspaceroomtypeaircon as $row) {   ?>  
          <option value="<?php echo $row->rentspace_ID;  ?>"><?php  echo $row->Name; ?></option>
          <?php
          }  ?>
        </select>  
      </div>
    </div>
    <hr size="10"/>
    <h4>Non-Airconditioned Bedrooms</h4></br>
    <div class="row">
      <div class="col-lg-2"><label>Choose Rent Space </br> ( Female Rooms )</label></div>
      <div class="col-lg-2">
        <select class="form-control" name="rentspace" style="min-Width:150px;" required>
            <?php   foreach ($rentspaceroomtypefemale as $row) {   ?>  
            <option value="<?php echo $row->rentspace_ID;  ?>"><?php  echo $row->Name; ?></option>
            <?php
            }  ?>
        </select>  
      </div>
      <div class="col-lg-2">
        <input type="number" name="femalecharges" class="form-control" placeholder="Specified Charges" required>
      </div>
    </div></br>
    <div class="row">
      <div class="col-lg-2"><label>Choose Rent Space </br> ( Male Rooms )</label></div>
      <div class="col-lg-2">
        <select class="form-control" name="rentspace" style="min-Width:150px;" required>
            <?php   foreach ($rentspaceroomtypemale as $row) {   ?>  
            <option value="<?php echo $row->rentspace_ID;  ?>"><?php  echo $row->Name; ?></option>
            <?php
            }  ?>
        </select>  
      </div>
    </div>
  </div>
</div>
<?php  echo form_close();  ?>

<div class="panel panel-primary">
  <div class="panel-heading">Event Type Charges</div>
  <div class="panel-body">
    <div class="row">
      <?php echo form_open('admin/addnatureactivity');?>
      <div class="col-lg-2"><label>Add Nature of Activity</label></div>
      <div class = "col-lg-2">
        <label>Nature of Activity:</label>
        <input type="text" class="form-control" placeholder="Nature of Activity" name="activity" required>
      </div>
       <div class = "col-lg-2">
        <label>Description:</label>
        <textarea  class="form-control" placeholder="Description" name="description" required></textarea>
      </div>
      <div class="col-lg-1">
          <div class="span6 pull-right" style="text-align:right"> 
            </br>
           <input type="submit" value="ADD" class = "btn btn-success">
        </div>
      </div>
      <div class="col-lg-3">
        <?php
        if(!empty($this->session->flashdata('addactivity')))
            {
        ?>    </br>
              <font color="green"><label>New Nature of Activity Added.</label></font>
        <?php
            }
        ?>
      </div>
      <?php echo form_close(); ?>
    </div></br><hr/>
    <?php  echo form_open('admin/insertchargesactivityevent');   ?>
    <div class="row">
      <div class="col-lg-2">
        <label>New Charges</label>
      </div>
      <div class="col-lg-2">
          <label>Choose Nature of Activity</label>
         <select class="form-control" name="activity" required>
             <option value="">-------------------</option>
          <?php   foreach ($natureofactivity as $row) {   ?>  
            <option value="<?php echo $row->natureactivity_id;  ?>"><?php  echo $row->natureactivity_name; ?></option>
            <?php
            }  ?>
         <select>
      </div>
      <div class="col-lg-2">
        <label>Choose Rent Spaces</label>
        <select class="form-control" name="rentspace" required>
            <option value="">-------------------</option>
             <?php   foreach ($rentspaceventtype as $row) {   ?>  
            <option value="<?php echo $row->rentspace_ID;  ?>"><?php  echo $row->Name; ?></option>
            <?php
            }  ?>
        </select>
      </div>
       <div class="col-lg-2">
        <label>Choose Rate Type</label>
        <select class="form-control" name="renttype" required>
            <option value="">-------------------</option>
            <?php   foreach ($ratetype as $row) {   ?>  
            <option value="<?php echo $row->rate_typeid;  ?>"><?php  echo $row->rate_name; ?></option>
            <?php
            }  ?>
        </select>
      </div>
      <div class="col-lg-3"></br>
        <?php

        if(!empty($this->session->flashdata('chargesexist')))
        {
          
          if($this->session->flashdata('chargesexist') == 'true' )
          {
              
        ?>
             <label style="color:red;">Rent space chosen has charges.Use update instead of add.</label>
        <?php 
          }
          else if ($this->session->flashdata('chargesexist') == 'false')
          {
              ?>

              <label style="color:green;">New Charges saved.</label>
          <?php
          }

        }?>
      </div>
    </div></br>
    <div class="row">
        <div class="col-lg-2">
        </div> 
         <div class="col-lg-2">
          <label>Regular Number Per Rate</label>
          <input type="text" class="form-control" name="regularnumber" placeholder="Regular Number" required>
        </div>
        <div class="col-lg-2">
          <label>Regular Price Per Rate</label>
          <input type="text" class="form-control" name="regularprice" placeholder="Regular Price" required>
        </div> 
        <div class="col-lg-3">
          <label>Succeeding Number Per Rate</label>
          <input type="text" class="form-control" name="succeedingnumber" placeholder="Succeeding Number" required>
        </div> 
        <div class="col-lg-2">
          <label>Succeeding Price Per Rate</label>
          <input type="text" class="form-control" name="succeedingprice" placeholder="Succeeding Price" required>
        </div> 
    </div>
    <div class="row"></br>
        <div class="col-lg-2">
        </div>
         <div class="col-lg-2">
           <label>Aircon ?</label></br>
           <label><input type="checkbox" class="form-control" name = "aircon" value="true" >Yes</label>
        </div> 
         <div class="col-lg-3">
        </div>
         <div class="col-lg-2">
        </div>
        <div class="col-lg-2">
          <div class="span6 pull-right" style="text-align:right"></br>
            <input type="submit" class="btn btn-success" value="ADD" style="width:100px;" />
          </div>
        </div>
    </div></br>
    <?php echo form_close();
      ?>
   <div class="mygrid-wrapper-div" >

      <table id="chargesevent" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
              <th>Nature of Activity</th>
              <th>Rent space</th>
              <th>Rate Type</th>
              <th>Regular Number/Rate</th>
              <th>Regular Price</th>
              <th>Succeeding Number/Rate</th>
              <th>Succeeding Price</th>
              <th>Aircon Type</th>
              <th>Date_Created</th>
          </tr>
        </thead>

        <tfoot>
        <tr>
             <th>Nature of Activity</th>
              <th>Rent space</th>
              <th>Rate Type</th>
              <th>Regular Number/Rate</th>
              <th>Regular Price</th>
              <th>Succeeding Number/Rate</th>
              <th>Succeeding Price</th>
              <th>Aircon Type</th>
              <th>Date_Created</th>
       
          </tr>
        </tfoot>
      </table>

</div></br>



  </div>
</div>

<?php
include_once('myfooter.php');
?>