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

<?php 
 if (!empty($this->session->flashdata('approvedmsg')))
 {
?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('approvedmsg') ?></div>
<?php

  }

?>


      <div class="panel panel-primary">
        <div class="panel-heading">FOR APPROVAL</div>
        <div class="panel-body">

               


                            <?php
                               foreach ($facilityall as $row) {
                            ?>

                            <table width="100%" border="1" class="bg-warning">
                                <tr class="bg-danger">
                                  <td height="35" colspan="2" class=""> 
                                    <strong>
                                      <?php echo $row->Facility_name; 
                                       $counter = 1; ?>
                                    </strong>
                                  </td>
                                </tr>


                              <?php foreach ($worklist as $row1) { ?>

                                <?php

                                  if($row->facility_iD == $row1->id)
                                   { ?>

                                      <tr class="bg-danger">
                                        <td width="558" class="bg-info">
                                          <a href="<?php echo base_url(); ?>admin/reserved?reservationid=<?php echo $row1->reservationID; ?>&reservedcartid=<?php echo $row1->cartid; ?>&facility=<?php  echo $row->Facility_name;?>">
                                            
                                                 <?php echo $counter.' '.$row1->Approval; ?>
                                               
                                          </a>
                                        </td>
                                      </tr>
                            
                              <?php }
                                   $counter = $counter + 1;
                                } ?>
                    
                             </table> 
                              <p>&nbsp;</p>


                            <?php
        
                            }
                            ?>

                             
                 

          

            
        </div>
      </div>

   


<?php
include_once('myfooter.php');
?>