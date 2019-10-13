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
      render("../view/occupation_read_form.php", ["title" => "Display details about an Occupation",
            "form_id" => "$id"]);
    }

?>
