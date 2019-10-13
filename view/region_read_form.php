<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$region_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select a.*, b.country from regions a, countries b where a.country_id = b.id and a.id = ?", $region_id); 
	$region = $data[0]["region"];
	$country_id = $data[0]["country_id"]; 
	$country = $data[0]["country"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select * from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
?>
<h2>Read about a Region</h2>
  <div class="container">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Record ID:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $region_id; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Region name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $region; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Country name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $country; ?></td>
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
      <a class="btn btn-success" href="../ctl/region.php">Back</a>
   </div>
  </div>
