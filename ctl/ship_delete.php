<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
			$rows = query("DELETE from ship where id = ?", $_SESSION["selected_ship_id"]);
        	$message = $_SESSION["ship"] . " has been deleted.";
       	render("../view/ship_form.php", ["message" => $message]);
    }
    else
    {
      	$id = $_REQUEST['id'];
		$_SESSION["selected_ship_id"] = $id;
    	render("../view/ship_delete_form.php", ["title" => "Delete a ship entry",
            "form_id" => "$id"]);
    }

?>
