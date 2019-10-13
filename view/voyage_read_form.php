<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$voyage_id = htmlspecialchars(strip_tags($form_id));
	$_SESSION["selected_voyage_id"] = $voyage_id;
	//$data = query("select a.*, b.%lookupName% from voyage a, %lookupTable% b where a.%lookupName%_id = b.id and a.id = ?", $voyage_id); 
	$data = query("SELECT a.*, d.ship_name, b.place origin, c.place dest, a.notes from voyage a, places b, places c, ship d where d.id = a.ship_id and a.origin_id = b.id and a.destination_id = c.id and a.id = ? order by ship_name, departure_date, arrival_date",
						$voyage_id); 
	$ship_name = $data[0]["ship_name"];
	$departure_date = $data[0]["departure_date"]; 
	$arrival_date = $data[0]["arrival_date"]; 
	$origin = $data[0]["origin"];
	$dest = $data[0]["dest"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	
	$data = query("select * from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
?>
<h2>Read about a Voyage</h2>
  <div class="container">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Record ID:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $voyage_id; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Ship:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $ship_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Port of origin:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $origin; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Departure date:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $departure_date; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Destination port:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $dest; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Arrival date:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $arrival_date; ?></td>
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
   <div class="form-actions">
      <a class="btn btn-success" href="../ctl/voyage.php">Back</a>
   </div>
  </div>
