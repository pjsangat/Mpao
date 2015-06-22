<?php if(empty($applicants)) { ?>
	No Applicant
<?php } else { ?>
<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Username</th>
      <th>Date Applied</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($applicants as $ap) { ?>
    <tr>
      <td><?php echo $ap->first_name; ?></td>
      <td><?php echo $ap->last_name; ?></td>
      <td><a href="<?php echo  base_url().''.$ap->username;?>" target="_blank">Profile</a></td>
      <td><?php echo $this->date_config->per_page($ap->date_applied) ?></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
<?php } ?>
