<?php
//echo '<pre>'; print_r($compute); echo '</pre>';
?>
<div class="panel panel-default" id="airondiv">
<div class="panel-heading">Jppollock<br>
  Airconditioned Bedrooms </div>
<!-- /.panel-heading -->
<div class="panel-body">
  <div class="table-responsive">
    <div class="row"></span>
    <?php if(empty($compute)) { ?>
    	No Reserve Placed
    <?php } else { ?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Room No</th>
            <th>Date Start/Time</th>
            <th>Date End/Time</th>
            <th class="text-center">Gender</th>
            <th class="text-center">Total No. of Persons</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
        <?php 
			foreach($compute as $cmp) {
			$rent = $this->db->query("select * from charges where rent_space_id = '".$cmp->rent_space_id."'  order by id asc LIMIT ".$cmp->number_of_guest."");
		$charge_result = $rent->result();
		$charges = array();
		
		foreach($charge_result as $chrg)
		{
			$charges[] = $chrg->amount;
			
		}
		//echo '<pre>';print_r($charges);echo '</pre>'; 
		?>
          <tr>
            <td class="col-md-4"><em><?php echo $cmp->Name;?></em></td>
            <td class="col-md-4"><?php echo $cmp->startdate .'-'. $cmp->stime;?></td>
            <td class="col-md-4"><?php echo $cmp->enddate .'-'. $cmp->etime;?></td>
            <td class="col-md-1" style="text-align: center">
            	<?php if($cmp->is_female == '1') { ?>
                	Female
                <?php } ?>
                <?php if($cmp->is_male == '1') { ?>
                	Male
                <?php } ?>
            </td>
            <td class="col-md-1 text-center"><?php echo $cmp->number_of_guest;?></td>
            <td class="col-md-1 text-center">P<?php echo array_sum($charges);?>
            	<?php 
					$total = array();
					$total[] = array_sum($charges); 
				?>
            </td>
          </tr>
       <?php } ?> 
          <tr>
            <td>   </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>   </td>
            <td class="text-right"><h4><strong><?php //print_r($total); ?> </strong></h4></td>
            <td class="text-center text-danger"><h4><strong>P31.53</strong></h4></td>
          </tr>
        </tbody>
      </table>
     <?php } ?>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->

<div class="panel panel-default">
<div class="panel-heading">Jppollock<br>
  Other Facility </div>
<!-- /.panel-heading -->
<div class="panel-body">
  <div class="table-responsive">
    <div class="row"></span>
     <?php if(empty($others)) { ?>
    	No Reserve Placed
    	<?php } else { ?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Room</th>
            <th>Date Start/Time</th>
            <th>Date End/Time</th>
            <th class="text-center">Total No. of Persons</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
        <?php 
			foreach($others as $oth) {
			
		?>
          <tr>
            <td class="col-md-4"><em><?php echo $oth->Name;?></em></td>
            <td class="col-md-4"><?php echo $oth->startdate .'-'. $oth->stime;?></td>
            <td class="col-md-4"><?php echo $oth->enddate .'-'. $oth->etime;?></td>
            <td class="col-md-1 text-center"><?php echo $oth->number_of_guest;?></td>
            <td class="col-md-1 text-center"><?php echo $oth->number_of_guest;?>
            	
            </td>
          </tr>
       <?php } ?> 
          <tr>
            <td>   </td>
            <td>   </td>
            <td>&nbsp;</td>
            <td class="text-right"><h4><strong><?php //print_r($total); ?> </strong></h4></td>
            <td class="text-center text-danger"><h4><strong>P31.53</strong></h4></td>
          </tr>
        </tbody>
      </table>
     <?php } ?>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->