 <table class="table table-hover">
        
        <tbody>
        <?php
			//echo '<pre>';print_r($compute);echo '<pre>';
			foreach($compute as $cmp) {
			$rent = $this->db->query("select * from other_charges where id = '".$cmp->other_charge_id."'");
			$charge_result = $rent->row_array();
			$charges = $charge_result['cost'] * $cmp->number_of_guest;
		?>
          <tr>
            <td class="col-md-4"><strong>Start Date / Start Time: </strong> <?php echo $cmp->startdate .' / '. $cmp->stime;?></td>
            <td class="col-md-4"><strong>End Date / End Time: </strong> <?php echo $cmp->enddate .' / '. $cmp->etime;?></td>
            
            <td class="col-md-1 text-center"><?php echo $cmp->number_of_guest;?></td>
            <td class="col-md-1 text-center">P<?php $others_charges = number_format($charges,2); echo $others_charges?>
            	
            </td>
            <td class="col-md-1 text-center">
            	<button type="button" class="btn btn-xs btn-danger" onclick="delete_pending('<?php echo $cmp->ID;?>','<?php echo $cmp->reservationID;?>','<?php echo $cmp->rent_space_id;?>');return false;">
  					<span class="glyphicon glyphicon-trash"></span>&nbsp;
				</button>
            </td>
          </tr>
       <?php } ?>
        </tbody>
      </table>
      <?php //echo '<pre>'; print_r($total); echo ''; ?>