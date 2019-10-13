<h2 align="center">List of Occupations</h2>
    <div class="container">
        <p><a href="../ctl/occupation_create.php" class="btn btn-success">Create a new occupation</a></p>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Occupations</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query("SELECT id, occupation from occupation order by occupation");
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            echo '<tr>';
                                echo '<td>' . $row['occupation'] . '</td>';
                                echo '<td style="width:240px">';
                                    echo '<a class="btn btn-success" href="../ctl/occupation_read.php?id=' . $row['id'] . '">Read</a>' . '&nbsp;';
												if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/occupation_update.php?id=' . $row['id'] . '">Update</a>' . '&nbsp;';
                                    	if ($row['id'] > 0) {
                                    	    echo '<a class="btn btn-danger" href="../ctl/occupation_delete.php?id=' . $row['id'] . '">Delete</a>';
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
