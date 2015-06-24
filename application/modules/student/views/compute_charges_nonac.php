<table class="table table-hover">

    <tbody>
        <?php
        foreach ($compute as $cmp) {
            $rent = $this->db->query("select * from charges where rent_space_id = '" . $cmp->rent_space_id . "'");
            $charge_result = $rent->row();
            $charges = array();
            for($ctr = 0; $ctr < $cmp->number_of_guest ; $ctr++) {
                $charges[] = $charge_result->amount;
            }
            
            //echo '<pre>';print_r($charges);echo '</pre>'; 
            ?>
            <tr>
                <td class="col-md-3"><strong><?php echo ($cmp->gender_id == 1 ? "Male" : "Female").' '.$cmp->Name; ?></strong></td>
                <td class="col-md-3"><strong>Start Date / Time: </strong> <?php echo $cmp->startdate . ' / ' . $cmp->stime; ?></td>
                <td class="col-md-3"><strong>End Date / Time: </strong> <?php echo $cmp->enddate . ' / ' . $cmp->etime; ?></td>
                <td class="col-md-1 text-center"><?php echo $cmp->number_of_guest; ?></td>
                <td class="col-md-1 text-center">P<?php $aircon_charges = number_format(array_sum($charges), 2);
                    echo $aircon_charges ?>
                    <?php
                    $total = array();
                    $total[] = $aircon_charges;
                    ?>
                </td>
                <td class="col-md-1 text-center">
                    <button type="button" class="btn btn-xs btn-danger" onclick="delete_pending('<?php echo $cmp->ID; ?>', '<?php echo $cmp->reservationID; ?>', '<?php echo $cmp->rent_space_id; ?>', '<?php echo $cmp->room_type_id; ?>');
                            return false;">
                        <span class="glyphicon glyphicon-trash"></span>&nbsp;
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
//echo '<pre>'; print_r($total); echo ''; ?>