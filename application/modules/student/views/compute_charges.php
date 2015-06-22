 <table class="table table-hover">
        
        <tbody>
        <?php
			//echo '<pre>';print_r($compute);echo '<pre>';
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
            <td class="col-md-4"><strong>Start Date / Start Time: </strong> <?php echo $cmp->startdate .' / '. $cmp->stime;?></td>
            <td class="col-md-4"><strong>End Date / End Time: </strong> <?php echo $cmp->enddate .' / '. $cmp->etime;?></td>
            <td class="col-md-1" style="text-align: center">
            	<?php if($cmp->gender == '2') { ?>
                	Female
                <?php } ?>
                <?php if($cmp->gender == '1') { ?>
                	Male
                <?php } ?>
            </td>
            <td class="col-md-1 text-center"><?php echo $cmp->number_of_guest;?></td>
            <td class="col-md-1 text-center">P<?php $aircon_charges = number_format(array_sum($charges),2); echo $aircon_charges?>
            	<?php 
					$total = array();
					$total[] = $aircon_charges; 
				?>
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