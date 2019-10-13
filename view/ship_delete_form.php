<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$ship_id = htmlspecialchars(strip_tags($form_id));
	$data = query("select * from ship where id = ?", $ship_id); 
	$_SESSION["ship_id"] = $ship_id;
	$ship = $data[0]["ship_name"]; 
	$_SESSION["ship"] = $ship;
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>This ship is about to be deleted!</h2>
  <div class="container">
  <form action="../ctl/ship_delete.php" method="post">
   <table border="0" cellpadding="0" cellspacing="10" width="100%">
	      <tr>
				<td align="right" width="30%">Name:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $ship; ?></td>
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
				<td align="right" valign="top" width="25%">Notes:</td>
				<td width="2%"></td>
				<td align="left" width="70%"><?php echo $notes; ?></td>
	      </tr>
	</table> 
	<h3>This Ship is used by the following Voyages - they need to be changed or deleted first!</h3>
   <table class="table table-striped table-bordered">         
   	<thead>
         <tr>
            <th>Voyage date</th>
            <th>Origin port</th>
            <th>Destination port</th>
            <th>Notes</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $rows = query("SELECT a.voyage_date, b.place origin, c.place dest, a.notes from voyage a, places b, places c where a.ship_id = ? and a.origin = b.place and a.destination = c.place order by voyage_date", 
         					$ship_id);
         if (count($rows) > 0)
            {
            foreach ($rows as $row)
              {
              echo '<tr>';
              echo '<td>' . $row['voyage_date'] . '</td>';
              echo '<td>' . $row['origin'] . '</td>';
              echo '<td>' . $row['dest'] . '</td>';
              echo '<td>' . $row['notes'] . '</td>';
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
      <a class="btn btn-success" href="../ctl/ship.php">Cancel</a>
   </div>
  </div>
</form>