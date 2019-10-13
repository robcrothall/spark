<h2>Record a new Event</h2>

<form action="../ctl/history_create.php" method="post">
    <table class='table table-hover table-bordered'>
	     <tr>
				<td>Person selected</td>
				<td>
		  				<?php
		  					$rows = query("SELECT * FROM `people` where id = ?", $_SESSION["selected_people_id"]);
		  					$row = $rows[0];
		    				echo $row['surname'] . ", " . $row["first_name"] . " " . $row["other_name"];
		  				?>
				</td>
	     </tr>
        <tr>
            <td>Date (YYYY[-MM[-DD]])</td>
            <td><input type='text' name='event_date' class='form-control'></td>
        </tr>
		  <tr>
		  		<td>Place</td>
		  		<td>
	  			<select name="place_id">
		  				<?php
		  					$rows = query("SELECT distinct * FROM places order by place");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['place'] . "</option>";
		    				}
		  				?>
	  			</select>
	  			</td>
		  </tr>
        <tr>
            <td>Notes on this event</td>
            <td><textarea name='notes' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='../ctl/history.php' class='btn btn-primary'>Back to History</a>
            </td>
        </tr>
    </table>
</form>


