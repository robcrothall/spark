<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$voyage_id = htmlspecialchars(strip_tags($_SESSION["rec_id"]));
	$data = query("select a.* from voyage a where a.id = ?", $voyage_id); 
	//$voyage_date = $data[0]["voyage_date"]; 
	$ship_id = $data[0]["ship_id"];
	$origin_id = $data[0]["origin_id"];
	$departure_date = $data[0]["departure_date"];
	$destination_id = $data[0]["destination_id"];
	$arrival_date = $data[0]["arrival_date"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>Update a voyage</h2>

<form action="../ctl/voyage_update.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	     <tr>
				<td>Ship
				    <input type="hidden" id="rec_id" name="rec_id" value="<?php echo $voyage_id; ?>" /></td>
				<td>
		  			<select name="ship_id">
		  				<?php
		  					$rows = query("SELECT * FROM `ship` order by ship_name");
		  					foreach ($rows as $row) {
		  						if ($ship_id == $row['id'])
		  						{$selected = " selected";}
		  						else {$selected = "";}
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['ship_name'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
	     <tr>
				<td>Port of origin</td>
				<td>
		  			<select name="origin_id">
		  				<?php
		  					$rows = query("SELECT * FROM `places` order by place");
		  					foreach ($rows as $row) {
		  						if ($origin_id == $row['id'])
		  						{$selected = " selected";}
		  						else {$selected = "";}
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['place'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
        <tr>
            <td>Departure date</td> 
            <td><input type='text' name='departure_date' class='form-control' value='<?php echo $departure_date; ?>' /></td>
        </tr>
	     <tr>
				<td>Destination port</td>
				<td>
		  			<select name="destination_id">
		  				<?php
		  					$rows = query("SELECT * FROM `places` order by place");
		  					foreach ($rows as $row) {
		  						if ($destination_id == $row['id'])
		  						{$selected = " selected";}
		  						else {$selected = "";}
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['place'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
        <tr>
            <td>Arrival date</td> 
            <td><input type='text' name='arrival_date' class='form-control' value='<?php echo $arrival_date; ?>' /></td>
        </tr>
        <tr>
            <td>Notes on this voyage</td>
            <td><textarea name='notes' class='form-control'><?php echo $notes; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='voyage.php' class='btn btn-primary'>Back to voyages</a>
            </td>
        </tr>
    </table>
</form>


