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

    table th{
        text-align: center;
    }

</style>




<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong></br>Reservation Form</div>
    <div class="panel-body">

        <?php
//        foreach ($reservationcartinfo as $row) {
            $name = $reservationcartinfo['name'];
            $nature = $reservationcartinfo['activity']->Activity;
            $organizer = $reservationcartinfo['organizer'];
            $person = $reservationcartinfo['authorized_Person'];
            $position = $reservationcartinfo['position'];
            $date = $reservationcartinfo['date_activity'];
            $mobile = $reservationcartinfo['mobile'];
            $email = $reservationcartinfo['email'];
            $landline = $reservationcartinfo['landline'];
            $address = $reservationcartinfo['st_brgy'];
//        }
        ?>
        <div class='alert alert-info'></br>


            <div class='row'>
                <div class = 'col-md-3'>
                    <label>Title of activity:</label>
                </div>
                <div class = 'col-md-4'>
                    <label><?php echo $name; ?></label>
                </div>

                <div class = 'col-md-2'>
                    <label>Date:</label>
                </div>
                <div class = 'col-md-2'>
                    <label><?php echo $date; ?></label>
                </div>

            </div></br>

            <div class='row'>
                <div class = 'col-md-3'>
                    <label>Nature of activity:</label>
                </div>
                <div class = 'col-md-4'>
                    <label><?php echo $nature; ?></label>
                </div>

                <div class = 'col-md-2'>
                    <label>Mobile Number:</label>
                </div>
                <div class = 'col-md-2'>
                    <label><?php echo $mobile; ?></label>
                </div>
            </div></br>

            <div class='row'>
                <div class = 'col-md-3'>
                    <label>Name of Organizer:</label>
                </div>
                <div class = 'col-md-4'>
                    <label><?php echo $organizer; ?></label>
                </div>
                <div class = 'col-md-2'>
                    <label>Email Address:</label>
                </div>
                <div class = 'col-md-2'>
                    <label><?php echo $email; ?></label>
                </div>
            </div></br>

            <div class='row'>
                <div class = 'col-md-3'>
                    <label>Authorized Representative:</label>
                </div>
                <div class = 'col-md-4'>
                    <label><?php echo $person; ?></label>
                </div>

                <div class = 'col-md-2'>
                    <label>Fax or Landline:</label>
                </div>
                <div class = 'col-md-2'>
                    <label><?php echo $landline; ?></label>
                </div>


            </div></br>

            <div class='row'>
                <div class = 'col-md-3'>
                    <label>Position</label>
                </div>
                <div class = 'col-md-4'>
                    <label><?php echo $position; ?></label>
                </div>

                <div class = 'col-md-2'>
                    <label>Address:</label>
                </div>
                <div class = 'col-md-2'>
                    <label><?php echo $address; ?></label>
                </div>
            </div></br>



        </div>
    </div>
</div></br>

<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong></br>Airconditioned Bedrooms</div>
    <div class="panel-body">
        <table style="width: 100%;border: 1px solid #a8a8a8; border-collapse: collapse;" border="1">
            <thead style="background-color: #d9edf7; ">
                <tr>
                    <th rowspan="2">Room Number</th>
                    <th colspan="2">Inclusive Dates</th>
                    <th colspan="2">Inclusive Time</th>
                    <th colspan="2">Total Number of Persons</th>
                    <th rowspan="2">Amount</th>
                </tr>
                <tr>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>Male</th>
                    <th>Female</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $aircon_ctr = 0;
                foreach($reservationcartinfo['room_reserves'] as $index => $value){
                    if($value->rent_space->room_type_id == 1){
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $value->rent_space->Name; ?></td>
                            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($value->startdate)); ?></td>
                            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($value->enddate)); ?></td>
                            <td style="text-align: center;"><?php echo $value->stime.strtoupper($value->stime_type); ?></td>
                            <td style="text-align: center;"><?php echo $value->etime.strtoupper($value->etime_type); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                if($value->rent_space->gender_id == 1){ 
                                    echo $value->number_of_guest;
                                } 
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                if($value->rent_space->gender_id == 2){ 
                                    echo $value->number_of_guest;
                                } 
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                
                ?>
                <tr style="background-color: #d9edf7; ">
                    <td><strong>Sub-Total</strong></td>
                    <td colspan="6">&nbsp;</td>
                    <td style="text-align: right;"><strong>P <?php echo isset($reservationcartinfo['subtotal_amount']['1']) ? number_format($reservationcartinfo['subtotal_amount']['1'], 2, ".", ",") : "0.00"; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong></br>Non-Airconditioned Bedrooms</div>
    <div class="panel-body">
        <table style="width: 100%;border: 1px solid #a8a8a8; border-collapse: collapse;" border="1">
            <thead style="background-color: #d9edf7; ">
                <tr>
                    <th rowspan="2">Room Number</th>
                    <th colspan="2">Inclusive Dates</th>
                    <th colspan="2">Inclusive Time</th>
                    <th rowspan="2">Total Number of Persons</th>
                    <th rowspan="2">Amount</th>
                </tr>
                <tr>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>IN</th>
                    <th>OUT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $aircon_ctr = 0;
                foreach($reservationcartinfo['room_reserves'] as $index => $value){
                    if($value->rent_space->room_type_id == 2){
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $value->rent_space->Name; ?></td>
                            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($value->startdate)); ?></td>
                            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($value->enddate)); ?></td>
                            <td style="text-align: center;"><?php echo $value->stime.strtoupper($value->stime_type); ?></td>
                            <td style="text-align: center;"><?php echo $value->etime.strtoupper($value->etime_type); ?></td>
                            <td style="text-align: center;">
                                <?php echo $value->number_of_guest; ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                
                ?>
                <tr style="background-color: #d9edf7; ">
                    <td><strong>Sub-Total</strong></td>
                    <td colspan="5">&nbsp;</td>
                    <td style="text-align: right;"><strong>P <?php echo isset($reservationcartinfo['subtotal_amount']['2']) ? number_format( $reservationcartinfo['subtotal_amount']['2'], 2, ".", ",") : "0.00"; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong><br/>Other Facilities</div>
    <div class="panel-body">
        <table style="width: 100%;border: 1px solid #a8a8a8; border-collapse: collapse;" border="1">
            <thead style="background-color: #d9edf7; ">
                <tr>
                    <th rowspan="2">Room Number</th>
                    <th colspan="2">Inclusive Dates</th>
                    <th colspan="2">Inclusive Time</th>
                    <th rowspan="2">Amount</th>
                </tr>
                <tr>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>IN</th>
                    <th>OUT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $aircon_ctr = 0;
                foreach($reservationcartinfo['room_reserves'] as $index => $value){
                    if($value->rent_space->room_type_id == 3){
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $value->rent_space->Name; ?></td>
                            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($value->startdate)); ?></td>
                            <td style="text-align: center;"><?php echo date("d-M-Y", strtotime($value->enddate)); ?></td>
                            <td style="text-align: center;"><?php echo $value->stime.strtoupper($value->stime_type); ?></td>
                            <td style="text-align: center;"><?php echo $value->etime.strtoupper($value->etime_type); ?></td>
                            
                        </tr>
                        <?php
                    }
                }
                
                ?>
                <tr style="background-color: #d9edf7; ">
                    <td><strong>Sub-Total</strong></td>
                    <td colspan="4">&nbsp;</td>
                    <td style="text-align: right;"><strong>P <?php echo isset($reservationcartinfo['subtotal_amount']['3']) ? number_format($reservationcartinfo['subtotal_amount']['3'], 2, ".", ",") : "0.00"; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-body">
        <table style="width: 100%;">
            <tr>
                <td><strong>Grand Total :</strong></td>
                <td style="text-align: right;"><strong>P <?php echo isset($reservationcartinfo['total_amount']) ? number_format($reservationcartinfo['total_amount'], 2, ".", ",") : "0.00"; ?></strong></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?><br>
        </strong>Confirmation</div>
    <div class="panel-body">

        <div class='mygrid-wrapper-div'>


            <div class='responsive'>

                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#home-pills" data-toggle="tab">Approve</a></li>
                        <li><a href="#profile-pills" data-toggle="tab">Reject</a></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home-pills">
                            <h4>CONTROL NO.: <?php echo $reservationcartinfo['control_number']; ?></h4>
                            <p>Your reservation has been approved.</p>
                            <p>You may now process your payment through the following:</p>
                            <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Cash or Check Payable to Ateneo de Manila University</strong></p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Print the Statement of Account</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fill-up the Turn-Over Report below the Statement of Account</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Submit and pay to the cashier windows 7 or 8 at Xavier hall</p>
                            <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. Via Metrobank Bills Payments Facility</strong></p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Indicate the name of theOrganizer , and the Control Number ( Refer to the Statement of Account )</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Account Name: Ateneo de Manila University</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Subscriber No.: 906 JPRC</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Reference: Lodging</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kindly send us the copy of the deposit slip via e-mail or fax ( ecabanlit@ateneo.edu / Fax No.: 426-60-69 )</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Please wait for your Payment to be posted in 2-3 working days</p>
                            <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. Budget Transfer</strong> ( For those with Ateneo Budget Account only )</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Print  the statement of accont</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Accomplish the box below and fill up the budget transfer box</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Have it signed by the authorized signatory</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Submit to the MPAO Office</p>

                            <?php echo form_open('admin/approvereservation'); ?>

                            <input type="hidden" name="control" value="<?php echo $reservationcartinfo['control_number']; ?>" />
                            <input type="hidden" name="emailadd" value="<?php echo $reservationcartinfo['email']; ?>" />
                            <input type="hidden" name="typeemail" value="2" />
                            <input type="hidden" name="reservationid" value="<?php echo $reservationcartinfo['reservationID']; ?>" />
                            <label>
                                <textarea name="msgsend" cols="80" rows="3" id="textarea" style="width:100%;"></textarea>
                            </label>
                            <p>
                                <input  type="submit" class="btn-primary btn-lg" id="button2" value="Submit">
                            </p>
                            <?php echo form_close(); ?>

                        </div>



                        <!--   REJECT -->


                        <div class="tab-pane fade" id="profile-pills">
                            <h4></h4>
                            <p>Sorry, but the facility you are reserving is not available.Please choose another date.</p>
                            <p>

                                <?php echo form_open('admin/approvereservation'); ?>

                                <input type="hidden" name="control" value="<?php echo $reservationcartinfo['control_number']; ?>" />
                                <input type="hidden" name="emailadd" value="<?php echo $reservationcartinfo['email']; ?>" />
                                <input type="hidden" name="typeemail" value="3" />
                                <input type="hidden" name="reservationid" value="<?php echo $reservationcartinfo['reservationID']; ?>" />

                                <label>
                                    <textarea name="msgsend" cols="80" rows="3" id="textarea" class="form-control" style="width:100%;"></textarea>
                                </label>

                            <p>
                                <input type="submit" class="btn-primary btn-lg" id="button" value="Submit">
                            </p>

                            <?php echo form_close(); ?>

                            </p>




                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->

            </div></div>  
    </div>




    <!-- /.panel -->
</div>





<?php
include_once('myfooter.php');
?>