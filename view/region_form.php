<h2 align="center">List of Regions</h2>
    <div class="container">
        <p><a href="../ctl/region_create.php" class="btn btn-success">Create a new region</a></p>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Region</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rows = query("SELECT a.id, region, country from regions a, countries b where b.id = country_id order by region, country");
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            echo '<tr>';
                                echo '<td>' . $row['region'] . '</td>';
                                echo '<td>' . $row['country'] . '</td>';
                                echo '<td style="width:240px">';
                                    echo '<a class="btn btn-success" href="../ctl/region_read.php?id=' . $row['id'] . '">Read</a> &nbsp;';
												if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/region_update.php?id=' . $row['id'] . '">Update</a> &nbsp;';
                                    	echo '<a class="btn btn-danger" href="../ctl/region_delete.php?id=' . $row['id'] . '">Delete</a>';
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
