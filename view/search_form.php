<h2>Search for people</h2>
<form action="../ctl/search.php" method="post">
	    <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Surname</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=search name=surname size="50" autofocus placeholder="Any surname"></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">First name</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=search name=first_name size="50" placeholder="Any first name"></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Other name</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=search name=other_name size="50" placeholder="Any other name"></td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Title</td>
				<td width="2%"></td>
			<!--	<td align="left" width="70%"><input type=search name=title size="50" placeholder="Any title"></td> -->
				<td align="left" width="70%">
		  			<select name="title">
		    			<option value="any">Any title</option>
		  				<?php
		  					$rows = query("SELECT distinct title FROM `people` order by title");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['title'] . ">" . $row['title'] . "</option>";
		    				}
		 	 			?>
		  			</select>
				</td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Reference No</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=search name=ref_no size="25" placeholder="Any reference number"> e.g. Morse Jones card number</td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Occupation</td>
				<td width="2%"></td>
				<td align="left" width="70%">
		  			<select name="occupation_id">
		    			<option value="any">Any occupation</option>
		  				<?php
		  					$rows = query("SELECT * FROM `occupation` order by occupation");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['occupation'] . "</option>";
		    				}
		 	 			?>
		  			</select>
				</td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Party</td>
				<td width="2%"></td>
				<td align="left" width="70%">
		  			<select name="party_id">
		    			<option value="any">Any party</option>
		  				<?php
		  					$rows = query("SELECT * FROM `party` order by party_name");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['id'] . ">" . $row['party_name'] . "</option>";
		    				}
		  				?>
		  			</select>  
				</td>
	      </tr>
	      <tr>
				<td align="right" width="30%">Places</td>
				<td width="2%">&nbsp</td>
				<td align="left" width="70%">
		  			<select name="place_id">
		    			<option value="any">Any place</option>
		  				<?php
		  					$rows = query("SELECT distinct a.place_id, b.place FROM history a, places b where a.place_id = b.id order by b.place");
		  					foreach ($rows as $row) {
		    					echo "<option value=" . $row['place_id'] . ">" . $row['place'] . "</option>";
		    				}
		  				?>
		  			</select>
				</td>
	      </tr>
	      <?php
            if($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN") {
                echo "<tr>";
                echo '<td align="right" width="30%">Checked status</td>';
                echo '<td width="2%">&nbsp</td>';
                echo '<td align="left" width="70%">';
                echo '<select name="checked">';
                echo '<option value="any" selected>Any status</option>';
	  		    $checked_status = ["N","Y","Query"];
	  		    foreach ($checked_status as $status)
	  		    {
	  		        echo "<option value=$status>$status</option>";
	  		    }
                echo "</tr>";
            }
	      ?>
 <!--  		<tr>
				<td align="right" width="30%">Keywords (or)</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=search name=keywords_or size="50" placeholder="Find at least ONE in a history record"></td>
   		</tr>
   		<tr>
				<td align="right" width="30%">Keywords (and)</td>
				<td width="2%"></td>
				<td align="left" width="70%"><input type=search name=keywords_and size="50" placeholder="Find ALL in a history record"></td>
   		</tr>   -->
  		</table>
      <br>
		<input type='submit' value='Search' class='btn btn-primary' />
</form>
		<br><br>
		Note that a maximum of 10 names will be returned by this search. If you want more, please speak to Museum staff.
