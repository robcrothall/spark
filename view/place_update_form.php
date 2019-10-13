<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$place_id = htmlspecialchars(strip_tags($_SESSION["rec_id"]));
	$data = query("select a.*, b.id, b.region from places a, regions b where a.region_id = b.id and a.id = ?", $place_id); 
	$place = $data[0]["place"]; 
	$region_id = $data[0]["region_id"];
	$region = $data[0]["region"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>Update a place</h2>

<form action="../ctl/place_update.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td> 
            <input type="hidden" id="rec_id" name="rec_id" value="<?php echo $place_id; ?>" /></td>
            <td><input type='text' name='name' class='form-control' value='<?php echo $place; ?>' /></td>
        </tr>
        <!--<tr>
        		<td>Region</td>
            <td><input type='text' name='region_id' class='form-control' value='<?php echo $region_id; ?>' /></td>
        </tr> -->
	     <tr>
				<td>Region</td>
				<td>
		  			<select name="region_id">
		    			<!--<option value="any">Any place</option> -->
		  				<?php
		  					$rows = query("SELECT * FROM `regions` order by region");
		  					foreach ($rows as $row) {
		  						if ($region_id == $row['id'])
		  						{$selected = " selected";}
		  						else {$selected = "";}
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['region'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
        <tr>
            <td>Notes on this place</td>
            <td><textarea name='notes' class='form-control'><?php echo $notes; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='place.php' class='btn btn-primary'>Back to places</a>
            </td>
        </tr>
    </table>
</form>


