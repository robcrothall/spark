<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
         $rows = query("SELECT * from people where party_id = ? order by surname, first_name", $_SESSION["party_id"]);
         if (count($rows) > 0)
            {
					apologize("Change dependent people before deleting the party.");
            }
         else 
         	{
				$rows = query("DELETE from party where id = ?", $_SESSION["party_id"]);
         		$message = $_SESSION["party_name"] . " has been deleted.";
         	}
       render("../view/party_form.php", ["message" => $message]);
    }
    else
    {
    	$id = 0;
    	if ( !empty($_GET['id'])) {
      	$id = $_GET['id'];
    	}
     
		$_SESSION["party_id"] = $id;
        render("../view/party_delete_form.php", ["title" => "Delete a party",
            "form_id" => "$id"]);
    }
?>
