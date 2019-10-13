<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$people_id = htmlspecialchars(strip_tags($form_id));
	$_SESSION["people_id"] = $people_id;
	$data = query("select a.surname, a.first_name, a.other_name, a.title, a.age, a.birth_year, a.ref_no, a.voyage_id, a.notes, a.user_id, a.changed, b.occupation, c.party_name from people a, occupation b, party c where a.occupation_id = b.id and a.party_id = c.id and a.id = ?", 
						$people_id); 
	$surname = $data[0]["surname"];
	$_SESSION["surname"] = $surname;
	$first_name = $data[0]["first_name"];
	$_SESSION["first_name"] = $first_name;
	$other_name = $data[0]["other_name"];
	$_SESSION["other_name"] = $other_name;
	$title = $data[0]["title"];
	$age = $data[0]["age"];
	$birth_year = $data[0]["birth_year"];
	$ref_no = $data[0]["ref_no"];
	$party_name = $data[0]["party_name"]; 
	$occupation = $data[0]["occupation"];
	$voyage_id = $data[0]["voyage_id"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select * from users where id = ?", $user_id);
	$username = $data[0]["username"];
	$user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
	
	$rows = query("SELECT a.*, b.ship_name, c.place origin_name, d.place dest_name FROM voyage a, ship b, places c, places d where a.ship_id = b.id and origin_id = c.id and destination_id = d.id and a.id = ?",$voyage_id);
	foreach ($rows as $row) 
	{
        $row_id = trim($row["id"]);
        $departure_date = trim($row["departure_date"]);
        $arrival_date = trim($row["arrival_date"]);
        $ship_name = trim($row["ship_name"]);
        $display_string = $ship_name;
        $origin_id = trim($row["origin_id"]);
        $destination_id = trim($row["destination_id"]);
        $origin_name = trim($row["origin_name"]);
        $destination_name = trim($row["dest_name"]);
        if(!empty($origin_name) && strlen($origin_name) > 0)
        {
            $display_string .= " from $origin_name";
        }
        if (!empty($departure_date) && strlen($departure_date) > 0)
        {
            $display_string .= " ($departure_date)";
        }
        if (!empty($destination_name) && strlen($destination_name) > 0)
        {
            $display_string .= " to $destination_name";
        }
        if (!empty($arrival_date) && strlen($arrival_date) > 0)
        {
            $display_string .= " ($arrival_date)";
        }
        $display_string .= "[$row_id]";
	}
?>
<h2>This person is about to be deleted!</h2>
  <div class="container">
  <form action="../ctl/people_delete.php" method="post">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Person name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $surname . ", " . $first_name . " " . $other_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Title:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $title; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Age:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $age; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Birth year:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $birth_year; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Reference No:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $ref_no; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Occupation name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $occupation; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Settler party name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Voyage:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $display_string; ?></td>
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
	<h3>This person is referenced by the following events in history - they need to be amended first!</h3>
   <table class="table table-striped table-bordered">         
   	<thead>
         <tr>
            <th>Events in history</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $rows = query("SELECT a.event_date, a.notes from history a where a.people_id = ? order by a.event_date", $people_id);
         if (count($rows) > 0)
            {
            foreach ($rows as $row)
              {
              echo '<tr>';
              echo '<td>' . $row['event_date'] . ' - ' . $row['notes'] . '</td>';
              echo '</tr>';
              }
            }
         else 
         	{
         		echo '<tr><td>No dependent places</td></tr>';
         	}
            ?>
      </tbody>
   </table>

   <div class="form-actions">
   	<input type='submit' value='Delete' class='btn btn-danger' />
      <a class="btn btn-success" href="../ctl/people.php">Cancel</a>
   </div>
  </div>
</form>