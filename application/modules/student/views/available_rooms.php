<?php
//echo '<pre>';echo print_r($noaircon);echo '</pre>';
?>
<style type="text/css">
    .modal-dialog {
        width: 1000px;
    }
</style>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        grand_total(<?php echo $reservation_id; ?>);
    });


    function reserveaircontest(oForm, room_id, room_type_id)
    {
        var reservation_id = '<?php echo $reservation_id; ?>'
        gender = oForm.elements["gender"].value;
        date_time_in = oForm.elements["date_time_in"].value;
        date_time_out = oForm.elements["date_time_out"].value;
        gender_guest = oForm.elements["gender_guest"].value;
        if (date_time_in == null || date_time_in == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_in"].focus();
            oForm.elements["gender"].selectedIndex = 0;
            return false;
        }

        if (date_time_out == null || date_time_out == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_out"].focus();
            oForm.elements["gender"].selectedIndex = 0;
            return false;
        }
        waiteme('#aircon_grid');
        $.post('<?php echo base_url(); ?>student/reserve_rooms',
                {
                    date_time_in: date_time_in,
                    reservation_id: reservation_id,
                    gender: gender,
                    date_time_out: date_time_out,
                    room_id: room_id,
                    gender_guest: gender_guest
                },
        function(data) {
            $('#aircon_grid').waitMe('hide');
            if (data == '1')
            {
                myfunction(room_id, reservation_id);
                //document.getElementById(oForm.id).reset();
                grand_total(reservation_id);
                get_sub_total(room_type_id, reservation_id);
            }
        });
        return false;
        //alert(oForm.name);	
    }

    function otherfacility(oForm, room_id, room_type_id)
    {
        var reservation_id = '<?php echo $reservation_id; ?>'
        no_of_person = oForm.elements["no_of_person"].value;
        date_time_in = oForm.elements["date_time_in"].value;
        date_time_out = oForm.elements["date_time_out"].value;
        charge = oForm.elements["charge"].value;

        if (date_time_in == null || date_time_in == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_in"].focus();
            oForm.elements["no_of_person"].selectedIndex = 0;
            return false;
        }

        if (date_time_out == null || date_time_out == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_out"].focus();
            oForm.elements["no_of_person"].selectedIndex = 0;
            return false;
        }

        waiteme('#other_facility');
        $.post('<?php echo base_url(); ?>student/otherfacility',
                {
                    date_time_in: date_time_in,
                    reservation_id: reservation_id,
                    no_of_person: no_of_person,
                    date_time_out: date_time_out,
                    room_id: room_id,
                    charge: charge
                },
        function(data) {
            $('#other_facility').waitMe('hide');
            if (data == '1')
            {
                get_others(room_id, reservation_id);
                document.getElementById(oForm.id).reset();
                get_sub_total(room_type_id, reservation_id);
            }
        });
        return false;
    }

    function getcount_nonaircon(oForm)
    {
        room_id = oForm.elements["room_id"].value;

        $.post('<?php echo base_url(); ?>student/get_no_allowed',
                {
                    room_id: room_id
                },
        function(data) {
            $('#getcount_' + room_id).html(data);
        });
        return false;
    }

    function reserveaircon(oForm, room_id)
    {
        var reservation_id = '<?php echo $reservation_id; ?>'
        gender = oForm.elements["gender"].value;
        date_time_in = oForm.elements["date_time_in"].value;
        date_time_out = oForm.elements["date_time_out"].value;
        if (date_time_in == null || date_time_in == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_in"].focus();
            return false;
        }

        if (date_time_out == null || date_time_out == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_out"].focus();
            return false;
        }
        waiteme('#airondiv');
        $.post('<?php echo base_url(); ?>student/reserve_rooms',
                {
                    date_time_in: date_time_in,
                    reservation_id: reservation_id,
                    gender: gender,
                    date_time_out: date_time_out,
                    room_id: room_id
                },
        function(data) {
            $('#airondiv').waitMe('hide');
            if (data == '1')
            {
                compute_reservation(reservation_id, room_id);
                //document.getElementById(oForm.id).reset();
            }
        });
        return false;
        //alert(oForm.name);	
    }


    function reserve_requirments(oForm, requirment_id)
    {
        var reservation_id = '<?php echo $reservation_id; ?>';
        date_time_in = oForm.elements["date_time_in"].value;
        date_time_out = oForm.elements["date_time_out"].value;
        if (date_time_in == null || date_time_in == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_in"].focus();
            return false;
        }

        if (date_time_out == null || date_time_out == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_out"].focus();
            return false;
        }
        waiteme('#requirmentsdiv');
        $.post('<?php echo base_url(); ?>student/reserve_requirment',
                {
                    date_time_in: date_time_in,
                    date_time_out: date_time_out,
                    reservation_id: reservation_id,
                    requirment_id: requirment_id

                },
        function(data) {
            $('#requirmentsdiv').waitMe('hide');
            if (data == '1')
            {
                compute_reservation(reservation_id, null);
                //document.getElementById(oForm.id).reset();
            }
        });
        return false;
    }

    function reserverothers(oForm, room_id)
    {
        var reservation_id = '<?php echo $reservation_id; ?>';
        gender = oForm.elements["gender"].value;
        date_time_in = oForm.elements["date_time_in"].value;
        date_time_out = oForm.elements["date_time_out"].value;
        if (date_time_in == null || date_time_in == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_in"].focus();
            return false;
        }

        if (date_time_out == null || date_time_out == "") {
            //alert("Date must be filled out");
            oForm.elements["date_time_out"].focus();
            return false;
        }
        waiteme('#other_facility');
        $.post('<?php echo base_url(); ?>student/reserve_rooms',
                {
                    date_time_in: date_time_in,
                    date_time_out: date_time_out,
                    reservation_id: reservation_id,
                    room_id: room_id,
                    gender: gender

                },
        function(data) {
            $('#other_facility').waitMe('hide');
            if (data == '1')
            {
                compute_reservation(reservation_id, null);
                document.getElementById(oForm.id).reset();
            }
        });
        return false;
    }

    function nonaircon(oForm, room_type_id)
    {
        var reservation_id = '<?php echo $reservation_id; ?>';
        no_of_person = oForm.elements["number_of_person"].value;
        room_id = oForm.elements["room_id"].value;
        date_time_in = oForm.elements["date_time_in"].value;
        date_time_out = oForm.elements["date_time_out"].value;
        number_of_person = oForm.elements["number_of_person"].value;

        if (date_time_in == null || date_time_in == "") {
            oForm.elements["date_time_in"].focus();
            oForm.elements["number_of_person"].selectedIndex = 0;
            return false;
        }

        if (date_time_out == null || date_time_out == "") {
            oForm.elements["number_of_person"].selectedIndex = 0;
            oForm.elements["date_time_out"].focus();
            return false;
        }
        waiteme('#non_aircon_grid');
        $.post('<?php echo base_url(); ?>student/reserve_rooms',
                {
                    date_time_in: date_time_in,
                    reservation_id: reservation_id,
                    date_time_out: date_time_out,
                    room_id: room_id,
                    gender: no_of_person,
                    gender_guest: 2,
                },
                function(data) {
                    $('#non_aircon_grid').waitMe('hide');
                    if (data == '1')
                    {
                        get_nonac(room_id, reservation_id, room_type_id);
                        //document.getElementById(oForm.id).reset();
                        grand_total(reservation_id);
                        get_sub_total(room_type_id, reservation_id);
                    }
                });


        return false;
    }

    function compute_reservation(reservation_id, room_id)
    {
        $.post('<?php echo base_url(); ?>student/compute_reservation',
                {
                    reservation_id: reservation_id
                },
        function(data) {
            $('.modal-title').html('Computation');
            $('.modal-body').html(data);
            $('#add_propertie').modal('show');
        });
        return false;
    }

    function reserve()
    {
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var female = $('#female').val();
        alert(female);
        $.post('<?php echo base_url(); ?>student/compute_reservation',
                {
                    female: female
                },
        function(data) {
            alert(data);
        });
        return false;
    }

    function delete_pending(id, reserve_id, room_id, room_type_id)
    {
        waiteme('#aircon_grid');
        $.post('<?php echo base_url(); ?>student/delete',
                {
                    id: id
                },
        function(data) {
            if (data == '1')
            {
                myfunction(room_id, reserve_id);
                get_others(room_id, reserve_id);
                $('#aircon_grid').waitMe('hide');

                if (room_type_id !== undefined) {
                    get_sub_total(room_type_id, reserve_id);
                }

            }
        });
        return false;
    }

    function myfunction(rent_space_id, reservation_id, room_type_id)
    {
        //alert(rent_space_id);
        $.post('<?php echo base_url(); ?>student/get_compute',
                {
                    rent_space_id: rent_space_id,
                    reservation_id: reservation_id
                },
        function(data) {
            $('#computation_' + rent_space_id).html(data);
            if (room_type_id !== undefined) {
                get_sub_total(room_type_id, reservation_id);
            }

        });
        return false;
    }


    function get_nonac(rent_space_id, reservation_id, room_type_id)
    {
        //alert(rent_space_id);
        $.post('<?php echo base_url(); ?>student/get_compute_non_ac',
                {
                    rent_space_id: rent_space_id,
                    reservation_id: reservation_id
                },
        function(data) {
            $('#computation_' + rent_space_id).html(data);
            if (room_type_id !== undefined) {
                get_sub_total(room_type_id, reservation_id);
            }

        });
        return false;
    }

    function get_sub_total(room_type_id, reservation_id) {
        $.get('<?php echo base_url(); ?>student/get_sub_total/' + room_type_id + '/' + reservation_id, {},
                function(data) {
                    $('#sub-total-' + room_type_id).html(data);
                    grand_total(reservation_id);
                });
        return false;
    }

    function get_others(rent_space_id, reservation_id, room_type_id)
    {
        $.post('<?php echo base_url(); ?>student/get_compute_others',
                {
                    rent_space_id: rent_space_id,
                    reservation_id: reservation_id
                },
        function(data) {
            $('#computation_others_' + rent_space_id).html(data);

            if (room_type_id !== undefined) {
                get_sub_total(room_type_id, reservation_id);
            }
        });
        return false;
    }

    function grand_total(reservation_id)
    {
        $.post('<?php echo base_url(); ?>student/get_grand_total',
                {
                    reservation_id: reservation_id
                },
        function(data) {
            $('#grand_total').html(data);
        });
        return false;
    }

    function waiteme(containerid)
    {
        $(containerid).waitMe({
            effect: 'ios',
            text: 'Loading...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            sizeW: '',
            sizeH: ''
        });
    }

</script>

<div class="panel panel-primary" id="airondiv">
    <div class="panel-heading">Reservation Details</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <div class="col-md-6">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td>Title Of Activity:</td>
                            <td><?php echo $details['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Nature Of Activity</td>
                            <td><?php echo $details['Activity']; ?></td>
                        </tr>
                        <tr>
                            <td>Name Of user/organizer</td>
                            <td><?php echo $details['organizer']; ?></td>
                        </tr>
                        <tr>
                            <td>Authorized Representative</td>
                            <td><?php echo $details['authorized_Person']; ?></td>
                        </tr>
                        <tr>
                            <td>Postion</td>
                            <td><?php echo $details['position']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!--<button type="submit" class="btn btn-success bg-lg" onclick="compute_reservation('<?php echo $this->uri->segment(4); ?>',null);return false;"> Show Computation</button>-->
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td>Date</td>
                            <td><?php echo $details['date_activity']; ?></td>
                        </tr>
                        <tr>
                            <td>Mobile Number</td>
                            <td><?php echo $details['mobile']; ?></td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td><?php echo $details['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Fax or Landline</td>
                            <td><?php echo $details['landline']; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $details['st_brgy']; ?></td>
                        </tr>
                    </tbody>
                </table> 
            </div>
            <?php //print_r($details); ?> 
        </div>
        <!-- /.table-responsive --> 
    </div>
    <!-- /.panel-body --> 
</div>
<!-- /.panel -->    


<div id="aircon_grid"> 
    <div class="panel panel-primary" id="airondiv">
        <div class="panel-heading">Jppollock<br>
            Airconditioned Bedrooms </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table  table-bordered ">
                    <tbody>
                        <tr class="bg-success">
                            <td rowspan="2"><div align="center"><strong>Room Number</strong></div></td>
                            <td colspan="2"><div align="center"><strong>Inclusive Dates/Inclusive Time</strong></div></td>
                            <td colspan="2"><div align="center"><strong>Total Number of Persons</strong></div></td>
                        </tr>
                        <tr class="bg-success">
                            <td><div align="center">IN</div></td>
                            <td><div align="center">OUT</div></td>
                            <td align="center">Male</td>
                            <td align="center">Female</td>
                        </tr>
                        <?php
                        foreach ($aircon as $ai) {
                            $charges_query = $this->db->query("select * from charges where rent_space_id = '" . $ai->rentspace_ID . "'");
                            $charges_result = $charges_query->result();
                            $count = $charges_query->num_rows();
                            ?>
                        <form method="post" id="aircon_<?php echo $ai->rentspace_ID; ?>" name="aircon_<?php echo $ai->rentspace_ID; ?>">
                            <tr>

                                <td class=""><div align="left"><strong>
                                            <label style="Margin-left:1em;"><?php echo $ai->Name; ?></label></strong>
                                        <div>
                                            <?php
                                            foreach ($charges_result as $chresult) {
                                                ?>
                                                P<?php echo $chresult->amount; ?> / Head<br />	
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div></td>
                                <td ><div class="input-group date form_datetime_in col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:255px;" id="startdate_<?php echo $ai->rentspace_ID; ?>">
                                        <input class="form-control date_time_in"  type="text" value="" name="date_time_in" id="date_time_in" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
                                <td ><div class="input-group date form_datetime_out col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:255px;" id="enddate_<?php echo $ai->rentspace_ID; ?>" >
                                        <input class="form-control date_time_out"  type="text" value="" name="date_time_out" id="date_time_out" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
                                <td >
                                    <input type="hidden" name="gender_guest" id="gender_guest" value="<?php echo $ai->gender_id; ?>" />
                                    <?php if ($ai->gender_id == '1') { ?>
                                        <select name="gender" class="form-control" id="gender" onchange="reserveaircontest(this.form, '<?php echo $ai->rentspace_ID; ?>', '<?php echo $ai->room_type_id; ?>');
                                                return false;">
                                            <option selected="selected">Select</option>
                                            <?php
                                            for ($x = 1; $x <= $count; $x++) {
                                                ?>
                                                <option value="<?php echo $x; ?>"><?php echo $x; ?></option>	
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    <?php } else { ?>
                                        <select disabled="disabled" class="form-control">
                                            <option value="0">0</option>
                                        </select>
                                    <?php } ?>
                                </td>
                                <td >
                                    <?php if ($ai->gender_id == '2') { ?>
                                        <select name="gender" class="form-control" id="gender" onchange="reserveaircontest(this.form, '<?php echo $ai->rentspace_ID; ?>', '<?php echo $ai->room_type_id; ?>');
                                                return false;">
                                            <option selected="selected">Select</option>
                                            <?php
                                            for ($x = 1; $x <= $count; $x++) {
                                                ?>
                                                <option value="<?php echo $x; ?>"><?php echo $x; ?></option>	
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    <?php } else { ?>
                                        <select disabled="disabled" class="form-control">
                                            <option value="0">0</option>
                                        </select>
                            <?php } ?>            <center>
                            </center></td>
                            </tr>
                            <tr>
                                <td colspan="5" class=""><div id="computation_<?php echo $ai->rentspace_ID; ?>"></div><script>myfunction('<?php echo $ai->rentspace_ID; ?>', '<?php echo $reservation_id; ?>', '<?php echo $ai->room_type_id; ?>');</script></td>
                            </tr>
                        </form> 
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive --> 
        </div>
        <!-- /.panel-body -->

        <div class="panel-body">
            <div class="table-responsive" id="sub-total-1">

            </div>
        </div>
    </div>
</div>
<!-- /.panel -->


<div id="non_aircon_grid"> 
    <div class="panel panel-primary">
        <div class="panel-heading">Jppollock<br>
            Non Aircon Bedrooms </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr class="bg-success">
                            <td rowspan="2"><div align="center"><strong>Room Number</strong></div></td>
                            <td colspan="2"><div align="center"><strong>Inclusive Dates/Inclusive Time</strong></div></td>
                            <td rowspan="2"><div align="center"><strong>Total Number of Persons</strong></div></td>
                        </tr>
                        <tr class="bg-success">
                            <td><div align="center">IN</div></td>
                            <td><div align="center">OUT</div></td>
                        </tr>
                        <?php
                        foreach ($noaircon as $nonai) {
                            $room_query = $this->db->query("select * from trentspace where room_type_id = '2' and gender_id = '" . $nonai->id . "' and Facility_ID = '" . $facility_id . "'");
                            $get_room = $room_query->result();
                            ?>
                        <form method="post" id="nonaircon_<?php echo $nonai->id; ?>" name="nonaircon_<?php echo $nonai->id; ?>">
                            <tr>
                                <td class="">
                                    <?php echo $nonai->gender_name; ?><br />
                                    <select class="form-control" name="room_id" id="room_id">

                                        <?php
                                        foreach ($get_room as $room) {
                                            ?>
                                            <option value="<?php echo $room->rentspace_ID; ?>"><?php echo $room->Name; ?></option>
                                        <?php } ?>
                                    </select>
                                </td> 
                                <td ><div class="input-group date form_datetime_in col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;" id="startdate_na_<?php echo $nonai->id; ?>">
                                        <input class="form-control"  type="text" value="" name="date_time_in" id="date_time_in" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
                                <td ><div class="input-group date form_datetime_out col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;" id="enddate_na_<?php echo $nonai->id; ?>">
                                        <input class="form-control"  type="text" value="" name="date_time_out" id="date_time_out" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
                                <td ><div align="center">
                                        <?php
                                        //foreach($get_room as $room) {
                                        ?>
                                    <!--<div id="getcount_<?php echo $room->rentspace_ID; ?>"></div>-->
                                        <?php
                                        //}
                                        ?>
                                        <select id="number_of_person" name="number_of_person" class="form-control" onchange="nonaircon(this.form, 2);
                                                return false;">
                                            <option selected="selected">Select</option>
                                            <?php for ($x = 0; $x <= 20; $x++) { ?>
                                                <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div></td>
                            <input value="0" name="both11" type="hidden">
                            </tr>
                            <?php foreach ($get_room as $room) { ?>
                                <tr>
                                    <td colspan="5" class=""><div id="computation_<?php echo $room->rentspace_ID; ?>"></div><script>get_nonac('<?php echo $room->rentspace_ID; ?>', '<?php echo $reservation_id; ?>', '<?php echo $room->room_type_id; ?>');</script></td>
                                </tr>
                            <?php } ?>
                        </form>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive --> 
        </div>
        <!-- /.panel-body --> 

        <div class="panel-body">
            <div class="table-responsive" id="sub-total-2">

            </div>
        </div>

    </div>
    <!-- /.panel -->
</div>


<div id="other_facility">
    <div class="panel panel-primary" id="other_facility">
        <div class="panel-heading">Jppollock<br>
            Other Facility </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">

                <table class="table table-bordered">
                    <tr>
                        <td colspan="2">Multi-Purpose halls - Minimum 10 persons</td>
                    </tr>
                    <?php foreach ($other_charges as $other) { ?>
                        <tr>
                            <td style=" width:20%"><?php echo $other->title; ?></td>
                            <td>P<?php echo number_format($other->cost, 2) . ' / ' . $other->Unit_typename; ?></td>
                        </tr>
                    <?php } ?>	
                </table>

                <table class="table table-bordered">
                    <tbody>
                        <tr class="bg-success">
                            <td rowspan="2"><div align="center"><strong>Room </strong></div></td>
                            <td colspan="2"><div align="center"><strong>Inclusive Dates/Inclusive Time</strong></div></td>
                            <td rowspan="2" align="center">Type</td>
                            <td rowspan="2" align="center">Total Number of Persons</td>
                        </tr>
                        <tr class="bg-success">
                            <td><div align="center">IN</div></td>
                            <td><div align="center">OUT</div></td>
                        </tr>
                        <?php
                        foreach ($others as $otherf) {
                            ?>
                        <form method="post" id="otherfacility_<?php echo $otherf->rentspace_ID; ?>" name="otherfacility_<?php echo $otherf->rentspace_ID; ?>">
                            <tr>

                                <td class=""><div align="left"><strong>
                                            <label style="Margin-left:1em;"><?php echo $otherf->Name; ?></label></strong>
                                    </div></td>
                                <td ><div class="input-group date form_datetime_in col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;" id="startdate_<?php echo $otherf->rentspace_ID; ?>">
                                        <input class="form-control"  type="text" value="" name="date_time_in" id="date_time_in" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
                                <td ><div class="input-group date form_datetime_out col-md-9" data-date="" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" style=" width:250px;" id="enddate_<?php echo $otherf->rentspace_ID; ?>" >
                                        <input class="form-control"  type="text" value="" name="date_time_out" id="date_time_out" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> </div></td>
                                <td >
                                    <select id="charge" name="charge" class="form-control">
                                        <?php foreach ($other_charges as $oc) { ?>
                                            <option value="<?php echo $oc->id; ?>"><?php echo $oc->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td >

                                    <select id="no_of_person" name="no_of_person" class="form-control" onchange="otherfacility(this.form, '<?php echo $otherf->rentspace_ID; ?>', '<?php echo $otherf->room_type_id; ?>');
                                            return false;">
                                        <option selected="selected">Select No of Person</option>
                                        <?php for ($x = 1; $x <= $otherf->No_person_Max; $x++) { ?>
                                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="">
                                    <div id="computation_others_<?php echo $otherf->rentspace_ID; ?>"></div><script>get_others('<?php echo $otherf->rentspace_ID; ?>', '<?php echo $reservation_id; ?>', '<?php echo $otherf->room_type_id; ?>');</script>
                                </td>
                            </tr>
                        </form> 
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive --> 
        </div>
        <!-- /.panel-body --> 


        <div class="panel-body">
            <div class="table-responsive" id="sub-total-3">

            </div>
        </div>

        <div class="panel-body">
            <div class="table-responsive" id="grand-total">
                <table class="table">
                    <tr class="bg-success">
                        <td class="col-md-4"><strong>Grand Total</strong></td>
                        <td class="col-md-4"></td>
                        <td class="col-md-1" style="text-align: center">
                        </td>
                        <td class="col-md-1 text-center"></td>
                        <td class="col-md-1 text-center">
                            <strong>P<span id="grand_total"></span></strong>
                        </td>
                        <td class="col-md-1 text-center">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- /.panel -->
</div>


<div id="others_">
    <div class="panel panel-primary" id="others" style="text-align: center; padding: 10px;">
        <input type="checkbox" name="haveread" value="1" id="haveread" style="width: 20px;height: 20px;"/> 
        <label for="haveread" style="margin: 0px;margin-top: 5px;  vertical-align: top;">I have read and accept <a href='javascript:;'>Terms and Conditions</a></label>

        <div style="text-align: right;">
            <button type="submit" id="submit_reservation" class="btn btn-primary">Submit</button>
        </div>
    </div>


</div>


<script type="text/javascript">

    $(document).ready(function() {
        $("#submit_reservation").click(function() {
            if ($("#haveread").prop('checked') == false) {
                $('.modal-title').html('Reservation');
                $('.modal-body').html('<div>Please read and accept our Terms and Conditions.</div><div style="text-align:right;"><button type="submit" id="will_read_toc" class="btn btn-primary">Ok</button></div>');
                $("#add_propertie").modal('show');
            } else {
                $.post('<?php echo base_url(); ?>student/update_status',
                {
                    reservation_id: <?php echo $reservation_id; ?>,
                    facility_id: <?php echo $facility_id; ?>,
                    status: 1
                },
                function(data) {
                    $('.modal-title').html('Reservation');
                    $('.modal-body').html('<div>Successfully Booked.</div><div style="text-align:right;"><button type="submit" id="booking_success" class="btn btn-primary">Ok</button></div>');
                    $("#add_propertie").modal('show');
                });
            }
        });

        $("#add_propertie").on('click', '#booking_success', function() {
            window.location = '<?php echo base_url('student/calendar/'.$facility_id); ?>';
        });

        $("#add_propertie").on('click', '#will_read_toc', function() {
            $("#add_propertie").modal('hide');
        });
        //other facility calendar
        $('#other_facility').find('.form_datetime_in').each(function() {
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $('#enddate_' + res[1]).datetimepicker('setStartDate', startDate);
            });
        });

        $('#other_facility').find('.form_datetime_out').each(function() {
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var endDate = new Date(selected.date.valueOf());
                $('#startdate_' + res[1]).datetimepicker('setEndDate', endDate);
            });
        });
        //end other facility calendar

        //aircon calendar		
        $('#aircon_grid').find('.form_datetime_in').each(function() {
            // alert("Changed: " + this.id);
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                //language:  'fr',
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                var plusOne = moment().add(4, 'h');
                //alert(plusOne);
                $('#enddate_' + res[1]).datetimepicker('setStartDate', startDate);
                $('#enddate_' + res[1]).val(moment(plusOne, ["HH:mm"]).format("hh:mm A"));
            });
        });


        $('#aircon_grid').find('.form_datetime_out').each(function() {
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var endDate = new Date(selected.date.valueOf());
                $('#startdate_' + res[1]).datetimepicker('setEndDate', endDate);
            });

        });
        //end aircon calendar

        //non aircon calendar
        $('#non_aircon_grid').find('.form_datetime_in').each(function() {
            //alert("Changed: " + this.id);
            var res = this.id.split("_");

            $('#' + this.id).datetimepicker({
                //language:  'fr',
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                var plusOne = moment().add(4, 'h');
                //alert(plusOne);
                $('#enddate_na_' + res[1]).datetimepicker('setStartDate', startDate);
                $('#enddate_' + res[1]).val(moment(plusOne, ["HH:mm"]).format("hh:mm A"));
            });
        });

        $('#non_aircon_grid').find('.form_datetime_out').each(function() {
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var endDate = new Date(selected.date.valueOf());
                $('#startdate_na_' + res[1]).datetimepicker('setEndDate', endDate);
            });

        });
        //end non aircon calendar


        //requirment calendar		
        $('#calendar_requirments').find('.form_datetime_in').each(function() {
            //alert("Changed: " + this.id);
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                //language:  'fr',
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $('#enddate_' + res[1]).datetimepicker('setStartDate', startDate);
            });
        });


        $('#calendar_requirments').find('.form_datetime_out').each(function() {
            var res = this.id.split("_");
            $('#' + this.id).datetimepicker({
                format: "yyyy-mm-dd HH:ii p",
                weekStart: 1,
                todayBtn: false,
                autoclose: true,
                todayHighlight: 1,
                startView: 2,
                minuteStep: 30,
                forceParse: 0,
                showMeridian: true,
                startDate: new Date(),
                pickerPosition: "top",
                pickTime: false
            }).on('changeDate', function(selected) {
                var endDate = new Date(selected.date.valueOf());
                $('#startdate_' + res[1]).datetimepicker('setEndDate', endDate);
            });

        });
        //end requirment calendar

    });
</script>
<div id="add_propertie" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"></div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
