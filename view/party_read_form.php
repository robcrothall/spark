<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$party_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select a.*, b.surname, b.first_name from party a, people b where a.party_leader = b.id and a.id = ?", $party_id); 
	$party_name = $data[0]["party_name"];
	$party_leader_id = $data[0]["party_leader"];
    if ($party_leader_id == 0)
    {
        $comma = '';
    }
    else
    {
        $comma = ', ';
    }
	$party_leader = $data[0]["surname"] . $comma . $data[0]["first_name"]; 
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$voyage_id = $data[0]["voyage_id"];
    //print_r("$voyage_id");
	$data = query("select a.origin_id, a.destination_id, a.departure_date, a.arrival_date, b.ship_name from voyage a, ship b where a.ship_id = b.id and a.id = ?", $voyage_id);
	$ship_name = $data[0]["ship_name"];
	$origin_id = $data[0]["origin_id"];
	$destination_id = $data[0]["destination_id"];
	$departure_date = $data[0]["departure_date"];
	$arrival_date = $data[0]["arrival_date"];
	$data = query("select place from places where id = ?", $origin_id);
	$origin_port = $data[0]["place"];
	$data = query("select place from places where id = ?", $destination_id);
	$destination_port = $data[0]["place"];
	
	$data = query("select * from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
?>
<h2>Read about a Settler Party</h2>
  <div class="container">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Record ID:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_id; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Settler Party name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Party Leader name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_leader; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Ship:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $ship_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Port of origin:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $origin_port; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Departure date:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $departure_date; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Destination port:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $destination_port; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Arrival date:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $arrival_date; ?></td>
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
