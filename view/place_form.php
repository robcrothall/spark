<h2 align="center">List of Places</h2>
    <div class="container">
        <p><a href="../ctl/place_create.php" class="btn btn-success">Create a new place</a></p>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Place</th>
                        <th>Region</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query("SELECT a.id, place, region from places a, regions b where b.id = region_id order by place, region");
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            echo '<tr>';
                                echo '<td>' . $row['place'] . '</td>';
                                echo '<td>' . $row['region'] . '</td>';
                                echo '<td style="width:240px">';
                                    echo '<a class="btn btn-success" href="../ctl/place_read.php?id=' . $row['id'] . '">Read</a> &nbsp;';
												if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/place_update.php?id=' . $row['id'] . '">Update</a> &nbsp;';
                                    	echo '<a class="btn btn-danger" href="../ctl/place_delete.php?id=' . $row['id'] . '">Delete</a>';
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
