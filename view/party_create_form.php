<h2>Record a new Settler Party</h2>

<form action="../ctl/party_create.php" method="post" width="100%">
    <table class='table table-hover table-bordered' width="100%">
        <tr width="100%">
            <td>Name</td>
            <td><input type='text' name='name' class='form-control'></td>
        </tr>
	    <tr width="100%">
			<td>Party Leader</td>
			<td>
				<select name="party_leader">
				<?php
		    		$rows = query("SELECT * FROM `people` order by surname, first_name");
		  			foreach ($rows as $row) 
		  			{
		  				if ($_SESSION["party_leader_select"] == $row['id'])
		  				{$selected = " selected";}
		  				else {$selected = "";}
                        if ($row['id'] == 0)
                        {
                            $comma = '';
                        }
                        else
                        {
                            $comma = ', ';
                        }
		    			echo "<option value=" . $row['id'] . $selected . ">" . $row['surname'] . $comma . $row["first_name"] . "</option>";
		    		}
		  		?>
		  	    </select>
			</td>
	     </tr>
        <tr width="100%">
            <td>Voyage</td>
			<td>
				<select name="voyage_id">
				<?php
		    		$rows = query("SELECT a.id, d.ship_name, a.departure_date, a.arrival_date, b.place origin, c.place dest, a.notes from voyage a, places b, places c, ship d where d.id = a.ship_id and a.origin_id = b.id and a.destination_id = c.id order by ship_name, departure_date");
		  			foreach ($rows as $row) 
		  			{
		    			echo "<option value=" . $row['id'] . ">" . $row['ship_name'] . ' ' . $row["departure_date"] . " " . $row["origin"] . ' ' . $row["arrival_date"] . " " . $row["dest"] . "</option>";
		    		}
		  	    ?>
		  		</select>
			</td>
        </tr>
        <tr width="100%">
            <td>Notes on this party</td>
            <td><textarea name='notes' class='form-control'></textarea></td>
        </tr>
        <tr width="100%">
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='../ctl/party.php' class='btn btn-primary'>Back to Party</a>
            </td>
        </tr>
    </table>
</form>


