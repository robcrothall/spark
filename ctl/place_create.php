<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		// Validate fields
		$error = false;
		$message = "";
		$place = "";
		$region_id = 0;
		$notes = "";
		if (empty($_POST["name"])) {$message .= "You must provide a name.  "; $error = true;}
		else {$place = substr(htmlspecialchars(strip_tags($_POST['name'])),0,50);}
		$region_id = substr(htmlspecialchars(strip_tags($_POST["region_id"])),0,20);
		if (empty($_POST["notes"])) {$notes = ""; $message = "No notes on this place?  "; }
		else {$notes=substr(htmlspecialchars(strip_tags($_POST['notes'])),0,65534);}

		// Check for a duplicate place
		$rows = query("select count(*) rowCount from places where place=?", $place);
		$row = $rows[0];
		if($row["rowCount"] > 0) {$message .= "This place already exists in our records."; $error = true;}
		// If no errors have been detected, try to insert the row after noting some warnings
		if($error == false) 
		{
			$place = trim($place);
			$notes = trim($notes);
			$rowCount = query("insert into places (place, region_id, notes, user_id, changed) values (?,?,?,?,CURRENT_TIMESTAMP())",$place, $region_id,$notes,$_SESSION["id"]);
			if($rowCount == false) 
			{
				$message .= "Record inserted successfully.";
			}
			else {$message .= "Failed to add the record - please call support!";}
		}
		
      render("../view/place_form.php", ["title" => "List of Places", "message" => "$message"]);
    }
    else
    {
    	$_SESSION["region_select"] = 4; // Default to Ndlambe
      render("../view/place_create_form.php", ["title" => "Record Details of a new Place"]);
    }

?>
