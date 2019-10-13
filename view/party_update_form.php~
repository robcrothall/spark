<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$party_name_id = htmlspecialchars(strip_tags($_SESSION["rec_id"]));
	$data = query("select a.*, b.surname, b.first_name from party a, people b where a.party_leader = b.id and a.id = ?", $party_name_id); 
	$party_name = $data[0]["party_name"]; 
	$party_leader_id = $data[0]["party_leader"];
	//$party_leader = $data[0]["surname"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>Update a party_name</h2>

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
		    					echo "<option value=" . $row['id'] . $selected . ">" . $row['surname'] . ", " . $row["first_name"] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
        <tr>
            <td>Notes on this party</td>
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


