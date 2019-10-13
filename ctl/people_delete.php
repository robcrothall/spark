<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
         $rows = query("SELECT * from history where people_id = ?", $_SESSION["people_id"]);
         if (count($rows) > 0)
            {
					apologize("Delete dependent references before deleting the person.");
            }
         else 
         	{
				$rows = query("DELETE from people where id = ?", $_SESSION["people_id"]);
         		$message = $_SESSION["surname"] . ", " . $_SESSION["first_name"] . " " . $_SESSION["other_name"] . " has been deleted.";
         	}
       render("../view/people_form.php", ["message" => $message]);
    }
    else
    {
      	$id = $_REQUEST['id'];
        render("../view/people_delete_form.php", ["title" => "Delete a person",
            "form_id" => "$id"]);
    }

?>
