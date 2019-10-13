<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$place_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select * from places where id = ?", $place_id); 
	$_SESSION["place_id"] = $place_id;
	$place = $data[0]["place"]; 
	$_SESSION["place"] = $place;
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>This place is about to be deleted!</h2>
  <div class="container">
  <form action="../ctl/place_delete.php" method="post">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $place; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Changed by:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $username; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Changed on:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $changed; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Notes:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $notes; ?></td>
	      </tr>
	</table> 
	<h3>This Place is used by the following historic events - they need to be deleted first!</h3>
   <table class="table table-striped table-bordered">         
   	<thead>
         <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Notes</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $rows = query("SELECT b.surname, b.first_name, a.event_date, a.notes from history a, people b where a.people_id = b.id and a.place_id =? order by b.surname, b.first_name, a.event_date", $place_id);
         if (count($rows) > 0)
            {
            foreach ($rows as $row)
              {
              echo '<tr>';
              echo '<td>' . $row['surname'] . ", " . $row["first_name"] . '</td>';
              echo '<td>' . $row['event_date'] . '</td>';
              echo '<td>' . $row['notes'] . '</td>';
              echo '</tr>';
              }
            }
         else 
         	{
         		echo '<tr><td>No dependent historic events</td></tr>';
         	}
            ?>
      </tbody>
   </table>

   <div class="form-actions">
   	<input type='submit' value='Delete' class='btn btn-danger' />
      <a class="btn btn-success" href="../ctl/place.php">Cancel</a>
   </div>
  </div>
</form>