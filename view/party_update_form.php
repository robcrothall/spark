<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$party_name_id = htmlspecialchars(strip_tags($_SESSION["rec_id"]));
	$data = query("select a.*, b.surname, b.first_name from party a, people b where a.party_leader = b.id and a.id = ?", $party_name_id); 
	$party_name = $data[0]["party_name"]; 
	$party_leader_id = $data[0]["party_leader"];
	$voyage_id = $data[0]["voyage_id"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];

	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
    if ($party_leader_id == 0)
        {
            $comma = '';
        }
        else
        {
            $comma = ', ';
        }
?>
<h2>Update details of a settler party</h2>

<form action="../ctl/party_update.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td> 
            <input type="hidden" id="rec_id" name="rec_id" value="<?php echo $party_name_id; ?>" /></td>
            <td><input type='text' name='name' class='form-control' value='<?php echo $party_name; ?>' /></td>
        </tr>
	    <tr>
			<td>Party Leader</td>
			<td>
				<select name="party_leader_id">
				<?php
					$rows = query("SELECT * FROM `people` order by surname, first_name");
					foreach ($rows as $row) {
						if ($party_leader_id == $row['id'])
						    {$selected = " selected";}
						else {$selected = "";}
						if (empty($row["first_name"]))
						{
						    $comma = "";
						}
						else
						{
						    $comma = ", ";
						}
						echo "<option value=" . $row['id'] . $selected . ">" . $row['surname'] . $comma . $row["first_name"] . "</option>";
					}
				?>
				</select>
			</td>
	    </tr>
	    <tr>
			<td>Voyage</td>
			<td>
				<select name="voyage_id">
				<?php
					$rows = query("SELECT a.*, b.ship_name FROM voyage a, ship b where a.ship_id = b.id order by ship_name, departure_date, arrival_date");
	
					foreach ($rows as $row) {
					    print_r($row);
						if ($voyage_id == $row['id'])
						{$selected = " selected";}
						else {$selected = "";}
                    	$ship_id = $row["ship_id"];
                    	$origin_id = $row["origin_id"];
                    	$destination_id = $row["destination_id"];
                    	$departure_date = $row["departure_date"];
                    	$arrival_date = $row["arrival_date"];
	                    $voyage_description = $row["ship_name"];
	
                        if ($origin_id != 0)
                        {
                            $data = query("select place from places where id = ?", $origin_id);
                            $voyage_description .= " from " . $data[0]["place"];
                            if (isset($departure_date) && !is_null($departure_date))
                            {
                                $voyage_description .= " (" . $departure_date . ")";
                            }
                        }
                        if ($destination_id != 0)
                        {
                            $data = query("select place from places where id = ?", $destination_id);
                            $voyage_description .= " to " . $data[0]["place"];
                            if (isset($arrival_date) && !is_null($arrival_date) && !ctype_space($arrival_date))
                            {
                                $voyage_description .= " (" . $arrival_date . ")";
                            }
                        }
						echo "<option value=" . $row['id'] . $selected . ">" . $voyage_description . "</option>";
					}
				?>
				</select>
			</td>
	    </tr>
        <tr>
            <td>Notes on this settler party</td>
            <td><textarea name='notes' class='form-control'><?php echo $notes; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='party.php' class='btn btn-primary'>Back to party list</a>
            </td>
        </tr>
    </table>
</form>


