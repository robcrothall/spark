<h2 align="center">List of events in history</h2>
    <div class="container">
        <p><a href="../ctl/history_create.php" class="btn btn-success">Create a new event</a></p>
			<div class="row">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>
						<td>Event associated with:</td>
						<td>
		  				<?php
		  					$rows = query("SELECT * FROM `people` where id = ?", $_SESSION["selected_people_id"]);
		  					$row = $rows[0];
		    				echo $row['surname'] . ", " . $row["first_name"] . " " . $row["other_name"];
		  				?>
						</td>
						</tr>
					</tbody>
				</table>
			</div>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Place</th>
                        <th>Event</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query("SELECT a.id, a.event_date, b.place, a.notes from history a, places b where a.place_id = b.id and a.people_id = ? order by a.event_date", $_SESSION["selected_people_id"]);
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            echo '<tr>';
                                echo '<td>' . $row['event_date'] . '</td>';
                                echo '<td>' . $row['place'] . '</td>';
                                echo '<td>' . $row['notes'] . '</td>';
                                echo '<td valign="top" style="width:240px">';
                                    echo '<a class="btn btn-success" href="../ctl/history_read.php?id=' . $row['id'] . '">Read</a> &nbsp;'; 
												if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/history_update.php?id=' . $row['id'] . '">Update</a> &nbsp;'; 
                                    	echo '<a class="btn btn-danger" href="../ctl/history_delete.php?id=' . $row['id'] . '">Delete</a>';
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
