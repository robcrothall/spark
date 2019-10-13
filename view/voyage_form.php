<h2 align="center">List of Voyages</h2>
    <div class="container">
        <p><a href="../ctl/voyage_create.php" class="btn btn-success">Create a new voyage</a></p>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Ship name</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Origin port</th>
                        <th>Destination port</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
         				$rows = query("SELECT a.id, d.ship_name, a.departure_date, a.arrival_date, b.place origin, c.place dest, a.notes from voyage a, places b, places c, ship d where d.id = a.ship_id and a.origin_id = b.id and a.destination_id = c.id order by ship_name, departure_date"); 
         				if (count($rows) > 0)
            			{
            				foreach ($rows as $row)
              				{
              					echo '<tr>';
              					echo '<td>' . $row['ship_name'] . '</td>';
              					echo '<td>' . $row['departure_date'] . '</td>';
              					echo '<td>' . $row['arrival_date'] . '</td>';
              					echo '<td>' . $row['origin'] . '</td>';
              					echo '<td>' . $row['dest'] . '</td>';
              					echo '<td>' . $row['notes'] . '</td>';
                           echo '<td valign="top" style="width:240px">';
                           echo '<a class="btn btn-success" href="../ctl/voyage_read.php?id=' . $row['id'] . '">Read</a>' . '&nbsp;';
									if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                           	echo '<a class="btn btn-success" href="../ctl/voyage_update.php?id=' . $row['id'] . '">Update</a>' . '&nbsp;';
                                if ($row['id'] > 0) {
                           	        echo '<a class="btn btn-danger" href="../ctl/voyage_delete.php?id=' . $row['id'] . '">Delete</a>';
                            	}
                           }
                           echo '</td>';
              					echo '</tr>';
              				}
            			}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
