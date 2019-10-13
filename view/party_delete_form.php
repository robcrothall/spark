<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$party_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select a.*, b.surname, b.first_name from party a, people b where a.party_leader = b.id and a.id = ?", $party_id); 
	$_SESSION["party_id"] = $party_id;
	$party_name = $data[0]["party_name"]; 
	$_SESSION["party_name"] = $party_name;
	$voyage_id = $data[0]["voyage_id"];
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>This Settler Party is about to be deleted!</h2>
  <div class="container">
  <form action="../ctl/party_delete.php" method="post">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $party_name; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Changed by:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $username; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Changed on:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $changed; ?></td>
	      </tr>
	      <tr>
				<td align="right" width="25%">Notes:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $notes; ?></td>
	      </tr>
	</table> 
	<h3>This Settler Party is used by the following people - they need to be changed first!</h3>
   <table class="table table-striped table-bordered">         
   	<thead>
         <tr>
            <th>People</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $rows = query("SELECT * from people where party_id = ? order by surname, first_name limit 50", $party_id);
         if (count($rows) > 0)
            {
            foreach ($rows as $row)
              {
              echo '<tr>';
              echo '<td>' . $row['surname'] . ', ' . $row['first_name'] . '</td>';
              echo '</tr>';
              }
            }
         else 
         	{
         		echo '<tr><td>No dependent places</td></tr>';
         	}
            ?>
      </tbody>
   </table>

   <div class="form-actions">
   	<input type='submit' value='Delete' class='btn btn-danger' />
      <a class="btn btn-success" href="../ctl/party.php">Cancel</a>
   </div>
  </div>
</form>