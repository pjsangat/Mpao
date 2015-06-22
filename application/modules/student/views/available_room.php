<?php
//echo $this->input->post('reserve_id');
//echo $this->input->post('facityid');
?>

<div class="panel panel-default">
  <div class="panel-heading">Jppollock<br>
    Airconditioned Bedrooms </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr class="bg-success">
            <td rowspan="2"><div align="center"><strong>Room Number</strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Dates</strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Time</strong></div></td>
            <td colspan="3"><div align="center"><strong>Total Number of Persons</strong></div></td>
            <td rowspan="2"><div align="center"><strong>Add<br>
                Reservation</strong></div></td>
          </tr>
          <tr class="bg-success">
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
            <td><div align="center">Male</div></td>
            <td><div align="center">Female</div></td>
            <td><div align="center">Bothdenger</div></td>
          </tr>
        <form method="post" action="http://localhost/ateneo/public/Reservation-Cart" class="form-horizontal" role="form">
        </form>
        <tr>
          <td class=""><div align="left"><strong>
              <label style="Margin-left:1em;">Room 202</label>
              </strong></div></td>
          <td rowspan="3" ><div align="center">
              <input name="datefrom@1@1" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="dateto11" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timefrom11" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timeto11" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="male11" class="form-control" required="">
                <option selected="selected" value="0">0</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="female11" class="form-control" required="">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="both11" class="form-control" disabled="disabled">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <input value="0" name="both11" type="hidden">
          <td rowspan="3" ><center>
              <button type="submit" class="btn btn-success bg-lg"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </center></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Regular Price :₱350.00 / head</label></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Succeding Price : ₱250.00 / head</label></td>
        </tr>
        <form method="post" action="http://localhost/ateneo/public/Reservation-Cart" class="form-horizontal" role="form">
        </form>
        <tr>
          <td class=""><div align="left"><strong>
              <label style="Margin-left:1em;">Room204</label>
              </strong></div></td>
          <td rowspan="3" ><div align="center">
              <input name="datefrom@1@2" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="dateto12" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timefrom12" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timeto12" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="male12" class="form-control" required="">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="female12" class="form-control" required="">
                <option selected="selected" value="0">0</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="both12" class="form-control" disabled="disabled">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <input value="0" name="both12" type="hidden">
          <td rowspan="3"><center>
              <button type="submit" class="btn btn-success bg-lg"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </center></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Regular Price :₱350.00 / head</label></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Succeding Price : ₱250.00 / head</label></td>
        </tr>
        <form method="post" action="http://localhost/ateneo/public/Reservation-Cart" class="form-horizontal" role="form">
        </form>
        <tr>
          <td class=""><div align="left"><strong>
              <label style="Margin-left:1em;">Room201</label>
              </strong></div></td>
          <td rowspan="3" ><div align="center">
              <input name="datefrom@1@3" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="dateto13" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timefrom13" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timeto13" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="male13" class="form-control" required="">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="female13" class="form-control" required="">
                <option selected="selected" value="0">0</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="both13" class="form-control" disabled="disabled">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <input value="0" name="both13" type="hidden">
          <td rowspan="3"><center>
              <button type="submit" class="btn btn-success bg-lg"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </center></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Regular Price :₱350.00 / head</label></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Succeding Price : ₱250.00 / head</label></td>
        </tr>
          </tbody>
      </table>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel -->

<div class="panel panel-default">
  <div class="panel-heading">Jppollock<br>
    No Airconditioned Bedrooms </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr class="bg-success">
            <td rowspan="2"><div align="center"><strong>Room Number</strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Dates</strong></div></td>
            <td colspan="2"><div align="center"><strong>Inclusive Time</strong></div></td>
            <td colspan="3"><div align="center"><strong>Total Number of Persons</strong></div></td>
            <td rowspan="2"><div align="center"><strong>Add<br>
                Reservation</strong></div></td>
          </tr>
          <tr class="bg-success">
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
            <td><div align="center">IN</div></td>
            <td><div align="center">OUT</div></td>
            <td><div align="center">Male</div></td>
            <td><div align="center">Female</div></td>
            <td><div align="center">Bothdenger</div></td>
          </tr>
        <form method="post" action="http://localhost/ateneo/public/Reservation-Cart" class="form-horizontal" role="form">
        </form>
        <tr>
          <td class=""><div align="left"><strong>
              <label style="Margin-left:1em;">Room 203</label>
              </strong></div></td>
          <td rowspan="3" ><div align="center">
              <input name="datefrom@1@1" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="dateto11" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timefrom11" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timeto11" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="male11" class="form-control" required="">
                <option selected="selected" value="0">0</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="female11" class="form-control" required="">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="both11" class="form-control" disabled="disabled">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <input value="0" name="both11" type="hidden">
          <td rowspan="3" ><center>
              <button type="submit" class="btn btn-success bg-lg"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </center></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Regular Price :₱250.00 / head</label></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Succeding Price : ₱100.00 / head</label></td>
        </tr>
        <form method="post" action="http://localhost/ateneo/public/Reservation-Cart" class="form-horizontal" role="form">
        </form>
        <tr>
          <td class=""><div align="left"><strong>
              <label style="Margin-left:1em;">Room205</label>
              </strong></div></td>
          <td rowspan="3" ><div align="center">
              <input name="datefrom@1@2" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="dateto12" required="" type="date">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timefrom12" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <input name="timeto12" required="" type="time">
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="male12" class="form-control" required="">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="female12" class="form-control" required="">
                <option selected="selected" value="0">0</option>
              </select>
            </div></td>
          <td rowspan="3" ><div align="center">
              <select name="both12" class="form-control" disabled="disabled">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div></td>
          <input value="0" name="both12" type="hidden">
          <td rowspan="3"><center>
              <button type="submit" class="btn btn-success bg-lg"><span class="glyphicon glyphicon-plus"></span> Add</button>
            </center></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Regular Price :₱250.00 / head</label></td>
        </tr>
        <tr>
          <td><label style="Margin-left:1em;">Succeding Price : ₱150.00 / head</label></td>
        </tr>
        <form method="post" action="http://localhost/ateneo/public/Reservation-Cart" class="form-horizontal" role="form">
        </form>
          </tbody>
      </table>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>
<!-- /.panel --> 
