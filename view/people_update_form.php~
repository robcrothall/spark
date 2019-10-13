<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$people_id = htmlspecialchars(strip_tags($_SESSION["rec_id"]));
	$_SESSION["people_id"] = $people_id;
	//$data = query("select a.surname, a.first_name, a.title, a.birth_year, a.ref_no, a.notes, a.user_id, a.changed, b.occupation, c.party_name from people a, occupation b, party c where a.occupation_id = b.id and a.party_id = c.id and a.id = ?", $people_id); 
	$data = query("select * from people where id = ?", $people_id); 
    $_SESSION["search_name_start"] = $data[0]["surname"];
	$surname = $data[0]["surname"];
	$first_name = $data[0]["first_name"];
	$other_name = $data[0]["other_name"];
	$title = $data[0]["title"];
	$age = $data[0]["age"];
	$birth_year = $data[0]["birth_year"];
	$ref_no = $data[0]["ref_no"];
	$occupation_id = $data[0]["occupation_id"];
	$party_id = $data[0]["party_id"];
	$voyage_id = $data[0]["voyage_id"];
	$notes = $data[0]["notes"];
	$checked = $data[0]["checked"];
	print_r($checked);
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>Update Person details</h2>

<form action="../ctl/people_update.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Surname</td> 
            <input type="hidden" id="rec_id" name="rec_id" value="<?php echo $people_id; ?>" /></td>
            <td><input type='text' name='surname' class='form-control' value='<?php echo $surname; ?>' /></td>
        </tr>
        <tr>
        		<td>First name</td>
            <td><input type='text' name='first_name' class='form-control' value='<?php echo $first_name; ?>' /></td>
        </tr> 
        <tr>
        		<td>Other names</td>
            <td><input type='text' name='other_name' class='form-control' value='<?php echo $other_name; ?>' /></td>
        </tr> 
        <tr>
        		<td>Title</td>
            <td><input type='text' name='title' class='form-control' value='<?php echo $title; ?>' /></td>
        </tr> 
        <tr>
        		<td>Age</td>
            <td><input type='number' name='age' min="0" max="120" class='form-control' value='<?php echo $age; ?>' /></td>
        </tr> 
        <tr>
        		<td>Birth year</td>
            <td><input type='number' name='birth_year' min="0" max="2050" class='form-control' value='<?php echo $birth_year; ?>' /></td>
        </tr> 
        <tr>
        		<td>Reference number</td>
            <td><input type='text' name='ref_no' class='form-control' value='<?php echo $ref_no; ?>' /></td>
        </tr> 
	     <tr>
				<td>Occupation</td>
				<td>
		  			<select name="occupation_id">
		  				<?php
		  					$rows = query("SELECT * FROM `occupation` order by occupation");
		  					foreach ($rows as $row) {
		  						if ($occupation_id == $row['id'])
		  						{$selected = " selected";}
		  						else {$selected = "";}
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['occupation'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
	     <tr>
				<td>Settler party (if applicable)</td>
				<td>
		  			<select name="party_id">
		  				<?php
		  					$rows = query("SELECT * FROM `party` order by party_name");
		  					foreach ($rows as $row) {
		  						if ($party_id == $row['id'])
		  						{$selected = " selected";}
		  						else {$selected = "";}
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['party_name'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	    </tr>
	     <tr>
			<td>Voyage (if not with Settler Party)</td>
			<td>
		  		<select name="voyage_id">
			        <?php
		               	$rows = query("SELECT a.*, b.ship_name, c.place origin_name, d.place dest_name FROM voyage a, ship b, places c, places d where a.ship_id = b.id and origin_id = c.id and destination_id = d.id order by ship_name, departure_date, arrival_date");
		  	        	foreach ($rows as $row) 
		  	        	{
                            $row_id = trim($row["id"]);
                            if($row_id == $voyage_id)
                            {$selected = " selected";}
                            else {$selected = "";}
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
                            
		    		        echo "<option value=" . $row_id . $selected . ">" . $display_string . " - [$row_id]</option>";
		            	}
		  	        ?>
		  		</select>
			</td>
	     </tr>
        <tr>
        	<td>Checked</td>
            <td>
		  		<select name="checked">
	  				<?php
	  				    $checked_status = ["N","Y","Query"];
	  				    foreach ($checked_status as $status)
	  				    {
	  				        if ($checked == $status)
	  				        {
	  				            $selected = " selected";
	  				        }
	  				        else {$selected = "";}
	  				        echo "<option value=$status $selected>$status</option>";
	  				    }
	  				?>
		  		</select>
            </td>
        </tr> 
        <tr>
            <td>Notes on this person</td>
            <td><textarea name='notes' class='form-control'><?php echo $notes; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='people.php' class='btn btn-primary'>Back to people</a>
            </td>
        </tr>
    </table>
</form>


