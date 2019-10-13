<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       render("../view/construction_form.php");
    }
    else
    {
      	$id = $_REQUEST['id'];
      	$_SESSION["people_id"] = $id;
    	$_SESSION["selected_people_id"] = $id;
        render("../view/people_read_form.php", ["title" => "Display details about a Person",
            "form_id" => "$id"]);
    }

?>
