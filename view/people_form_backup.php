<form action="people.php" method="post">
<h1>Capture details of People</h1>
	    <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Surname</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=text name=surname size="50" autofocus placeholder="Use leading capital letters"></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">First name</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=text name=first_name size="50" placeholder="First name"></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Other names</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=text name=other_name size="50" placeholder="Other names"></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Title</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=text name=title size="50" placeholder="Title e.g. Mr, Mrs, Dr, etc."></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Birth year</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=number name=birth_year size="4" placeholder="Year"></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Reference No</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=text name=ref_no size="25" placeholder="Any reference number"> e.g. Morse Jones card number</td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Occupation</td>
				<td width="2%"></td>
				<td align="left" width="70%">
		  			<select name="occ">
		    			<option value="unknown">Unknown</option>-->
		  				<?php
		  					$rows = query("SELECT * FROM `occupation` order by occupation_name");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['occupation_name'] . "</option>";
		    				}
		 	 			?>
		  			</select>
		  			<!--<input type=text name=new_occupation size="50" placeholder="A new occupation?">-->
				</td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Party</td>
				<td width="2%"></td>
				<td align="left" width="68%">
		  			<select name="par">
		    			<option value="unknown">Unknown or no party</option>-->
		  				<?php
		  					$rows = query("SELECT * FROM `party` order by party_name");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['party_name'] . "</option>";
		    				}
		  				?>
		  			</select>  
		  			<!--<input type=text align="right" name=new_party size="50" placeholder="A new party?">-->
		  		</td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Ship</td>
				<td width="2%">&nbsp</td>
				<td align="left" width="70%">
		  			<select name="voy">
		    			<option value="unknown">Unknown or no ship</option>
		  				<?php
		  					$rows = query("SELECT `voyage`.`id` v_id, `ship_name`, `place`.`name` `placename`, voyage_date FROM `ship`,`voyage`, `place` where `ship`.`id` = `voyage`.`ship_id` and `origin` = `place`.`id` order by `ship_name`, `voyage_date`");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['v_id'] . ">" . $row['ship_name'] . " from " . $row['placename'] . " in " . $row['voyage_date'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	      </tr>
  		</table>
      <br>
		<a href="search.html" style="text-align: center;">Submit</a>
</form>

