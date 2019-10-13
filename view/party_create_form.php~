<h2>Record a new Party</h2>

<form action="../ctl/party_create.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control'></td>
        </tr>
	     <tr>
				<td>Party Leader</td>
				<td>
		  			<select name="party_leader">
		  				<?php
		  					$rows = query("SELECT * FROM `people` order by surname, first_name");
		  					foreach ($rows as $row) {
		  						if ($_SESSION["party_leader_select"] == $row['id'])
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
            <td><textarea name='notes' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='../ctl/party.php' class='btn btn-primary'>Back to Party</a>
            </td>
        </tr>
    </table>
</form>


