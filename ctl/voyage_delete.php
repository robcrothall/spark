<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $rows = query("SELECT id, party_name from party where voyage_id = ? order by party_name", $_SESSION["voyage_id"]);
        if (count($rows) > 0)
        {
            $message = "You must amend the depenent Settler Parties first!";
        }
        else
        {
        	$rows = query("DELETE from voyage where id = ?", $_SESSION["voyage_id"]);
            $message = $_SESSION["voyage_details"] . " has been deleted.";
        }
   	    render("../view/voyage_form.php", ["message" => $message]);
    }
    else
    {
      	$id = $_REQUEST['id'];
        render("../view/voyage_delete_form.php", ["title" => "Delete a voyage entry",
            "form_id" => "$id"]);
    }

?>
