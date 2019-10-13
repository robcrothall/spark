<h2 align="center">List of Parties</h2>
    <div class="container">
        <p><a href="../ctl/party_create.php" class="btn btn-success">Create a new party</a></p>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query("SELECT * from party order by party_name");
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            echo '<tr>';
                                echo '<td>' . $row['party_name'] . '</td>';
                                echo '<td>';
                                    echo '<a class="btn btn-success" href="../ctl/party_read.php?id=' . $row['id'] . '">Read</a>';
												if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/party_update.php?id=' . $row['id'] . '">Update</a>';
                                    	echo '<a class="btn btn-danger" href="../ctl/party_delete.php?id=' . $row['id'] . '">Delete</a>';
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
