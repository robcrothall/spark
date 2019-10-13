<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$party_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select a.*, b.surname, b.first_name from party a, people b where a.party_leader = b.id and a.id = ?", $party_id); 
	$party_name = $data[0]["party_name"];
	$party_leader = $data[0]["surname"] . ", " . $data[0]["first_name"]; 
	$party_leader_id = $data[0]["party_leader"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select * from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
?>
<h2>Read about a Party</h2>
  <div class="container">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Record ID:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_id; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Party name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Party Leader name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_leader; ?></td>
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
      <a class="btn btn-success" href="../ctl/party.php">Back</a>
   </div>
  </div>
