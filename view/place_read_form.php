<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$place_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select a.*, b.region from places a, regions b where a.region_id = b.id and a.id = ?", $place_id); 
	$place = $data[0]["place"];
	$region_id = $data[0]["region_id"]; 
	$region = $data[0]["region"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select * from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
?>
<h2>Read about a Place</h2>
  <div class="container">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Record ID:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $place_id; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Place name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $place; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Region name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $region; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Changed by:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $username . ' - ' . $user_name_given; ?></td>
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
      <a class="btn btn-success" href="../ctl/place.php">Back</a>
   </div>
  </div>
