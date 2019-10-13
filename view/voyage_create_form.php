<h2>Record a new Voyage</h2>

<form action="../ctl/voyage_create.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	     <tr>
				<td>Ship</td>
				<td>
		  			<select name="ship_id">
		  				<?php
		  					$rows = query("SELECT id, ship_name FROM `ship` order by ship_name");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['ship_name'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
         <tr>
            <td>Voyage departure date</td>
            <td><input type='text' name='departure_date' class='form-control'></td>
        </tr>
         <tr>
            <td>Voyage arrival date</td>
            <td><input type='text' name='arrival_date' class='form-control'></td>
        </tr>
	     <tr>
				<td>Port of origin</td>
				<td>
		  			<select name="origin_id">
		  				<?php
		  					$rows = query("SELECT * FROM `places` order by place");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['place'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
	     <tr>
				<td>Destination port</td>
				<td>
		  			<select name="destination_id">
		  				<?php
		  					$rows = query("SELECT * FROM `places` order by place");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['place'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	     </tr>
		  <tr>
            <td>Notes on this voyage</td>
            <td><textarea name='notes' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='../ctl/voyage.php' class='btn btn-primary'>Back to Voyages</a>
            </td>
        </tr>
    </table>
</form>


