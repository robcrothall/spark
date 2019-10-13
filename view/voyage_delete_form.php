<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$voyage_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select * from voyage where id = ?", $voyage_id); 
	$_SESSION["voyage_id"] = $voyage_id;
	$ship_id = $data[0]["ship_id"]; 
	$_SESSION["ship_id"] = $ship_id;
	$origin_id = $data[0]["origin_id"];
	$destination_id = $data[0]["destination_id"];
	$departure_date = $data[0]["departure_date"];
	$arrival_date = $data[0]["arrival_date"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username, surname, first_name from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_given_name = $data[0]["surname"] . ', ' . $data[0]["first_name"];
	$data = query("select ship_name from ship where id = ?", $ship_id);
	$ship_name = $data[0]["ship_name"];
	$data = query("select place from places where id = ?", $origin_id);
	$origin = $data[0]["place"];
	$data = query("select place from places where id = ?", $destination_id);
	$destination = $data[0]["place"];
	$_SESSION["voyage_details"] = "($voyage_id) $ship_name" . ' - ' . $origin . " ($departure_date) - " . $destination . " ($arrival_date) ";
?>
<h2>This voyage is about to be deleted!</h2>
  <div class="container">
  <form action="../ctl/voyage_delete.php" method="post">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Ship name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $ship_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Origin:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $origin; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Destination:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $destination; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Departure:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $departure_date; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Arrival:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $arrival_date; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Changed by:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $username . ' - ' . $user_given_name; ?></td>
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
	<h3>This Voyage is used by the following Settler Parties - they need to be amended first!</h3>
   <table class="table table-striped table-bordered">         
   	<thead>
         <tr>
            <th>Party Name</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $rows = query("SELECT id, party_name from party where voyage_id = ? order by party_name", $voyage_id);
         if (count($rows) > 0)
            {
            foreach ($rows as $row)
              {
              echo '<tr>';
              echo '<td>' . $row['party_name'] . '</td>';
              echo '</tr>';
              }
            }
         else 
         	{
         		echo '<tr><td>No dependent settler parties</td></tr>';
         	}
            ?>
      </tbody>
   </table>

   <div class="form-actions">
   	<input type='submit' value='Delete' class='btn btn-danger' />
      <a class="btn btn-success" href="../ctl/voyage.php">Cancel</a>
   </div>
  </div>
</form>