<h2 align="center">List of Settler Parties</h2>
    <div class="container">
        <p><a href="../ctl/party_create.php" class="btn btn-success">Create a new settler party</a></p>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Leader</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query("SELECT a.id, a.party_name, a.party_leader, b.surname, b.first_name from party a, people b where a.party_leader = b.id order by party_name");
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            if ($row['party_leader'] == 0)
                            {
                                $comma = '';
                            }
                            else
                            {
                                $comma = ', ';
                            }
                            echo '<tr>';
                                echo '<td>' . $row['party_name'] . '</td>';
                                echo '<td>' . $row['surname'] . $comma . $row['first_name'] . '</td>';
                                echo '<td valign="top" style="width:240px">';
                                    echo '<a class="btn btn-success" href="../ctl/party_read.php?id=' . $row['id'] . '">Read</a>' . '&nbsp;';
												if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/party_update.php?id=' . $row['id'] . '">Update</a>' . '&nbsp;';
                                    	if ($row['id'] > 0) {
                                    	    echo '<a class="btn btn-danger" href="../ctl/party_delete.php?id=' . $row['id'] . '">Delete</a>';
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
