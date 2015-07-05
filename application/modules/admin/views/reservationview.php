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




<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong></br>Reservation Form</div>
    <div class="panel-body">

        <?php
        foreach ($reservationcartinfo as $row) {
            $name = $row->name;
            $nature = $row->activity;
            $organizer = $row->organizer;
            $person = $row->authorized_person;
            $position = $row->position;
            $date = $row->date_activity;
            $mobile = $row->mobile;
            $email = $row->email;
            $landline = $row->landline;
            $address = $row->Address;
        }
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
        
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong></br>Non-Airconditioned Bedrooms</div>
    <div class="panel-body">
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading"><strong><?php echo $facility; ?></strong><br/>Other Facilities</div>
    <div class="panel-body">
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
                            <h4>CONTROL NO.: <?php foreach ($controlnumber as $row) {
            $controlnum = $row->control_number;
            echo $controlnum;
        } ?></h4>
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

                            <input type="hidden" name="control" value="<?php echo $controlnum; ?>" />
                            <input type="hidden" name="emailadd" value="<?php echo $email; ?>" />
                            <input type="hidden" name="typeemail" value="2" />
                            <input type="hidden" name="reservationid" value="<?php echo $this->input->get('reservationid') ?>" />
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

                                <input type="hidden" name="control" value="<?php echo $controlnum; ?>" />
                                <input type="hidden" name="emailadd" value="<?php echo $email; ?>" />
                                <input type="hidden" name="typeemail" value="3" />
                                <input type="hidden" name="reservationid" value="<?php echo $this->input->get('reservationid') ?>" />

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