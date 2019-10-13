<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$rec_limit = 10;
	//print_r("old = ");
	//print_r($search_name_start);
	//$_SESSION["search_name_start"] = htmlspecialchars(strip_tags($search_name_start));
	//print_r(" new = ");
	//print_r($_SESSION["search_name_start"]);
?>
<h2 align="center">List of People</h2>
    <div class="container">
        <form action="../ctl/people.php">
        <a href="../ctl/people_create.php" class="btn btn-success">Create a new person</a>
        		&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Surnames from:"><input type="search" name="search_string" autofocus="true" value="<?php echo $_SESSION["search_name_start"]; ?>">
        </form>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>People</th>
                        <th>Occupation</th>
                        <th>Settler Party</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //print_r(" Session = ");
                    //print_r($_SESSION["search_name_start"]);
                    //print_r(" Variable ");
                    //print_r($search_name_start);
                    $cmd0 = "SELECT count(*) row_count";
                    $cmd1 = "SELECT a.id, a.surname, a.first_name, a.occupation_id, a.Party_id, b.occupation, c.party_name"; 
                    $cmd2 = " from people a, occupation b, party c";
                    $cmd3 = " where b.id = occupation_id and c.id = a.party_id and surname >= '" . $_SESSION["search_name_start"] . "' ";
                    $cmd4 = " order by surname, first_name ";
                    $cmd = $cmd0 . $cmd2;
                    $_SESSION["search_name_start"] = "";
                    print_r($cmd);
                    $rows = query($cmd);
                    $row_count = $rows[0]["row_count"]; 
                    print_r($row_count);
                    if(isset($_GET{'page'}))
                    {
							$page = $_GET{'page'} + 1;
							$offset = $rec_limit * $page;                    
                    }
                    else 
                    {
                    	$page = 0;
                    	$offset = 0;
                    }
                    $left_rec = $row_count - ($page * $rec_limit);
                    $cmd = $cmd1 . $cmd2 . $cmd3 . $cmd4 . "LIMIT $offset, $rec_limit";
                    print_r($cmd);
						  $rows = query($cmd);
                    if (count($rows) > 0)
                    {
                        foreach ($rows as $row)
                        {
                            echo '<tr>';
                                echo '<td>' . $row['surname'];
                                $_SESSION['search_name_start'] = $row['surname'];
                                if (!empty($row['first_name'])) {echo ", " . $row['first_name'];}
                                echo '</td>';
                                echo '<td>' . $row['occupation'] . '</td>';
                                echo '<td>' . $row['party_name'] . '</td>';
                                echo '<td style="width:240px">';
                                    echo '<a class="btn btn-success" href="../ctl/people_read.php?id=' . $row['id'] . '">Read</a>' . '&nbsp;';
									if ($_SESSION["user_role"] == "STAFF" | $_SESSION["user_role"] == "ADMIN" ) {
                                    	echo '<a class="btn btn-success" href="../ctl/people_update.php?id=' . $row['id'] . '">Update</a>' . '&nbsp;';
                                    	if ($row['id'] > 0) {
                                    	    echo '<a class="btn btn-danger" href="../ctl/people_delete.php?id=' . $row['id'] . '">Delete</a>';
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
