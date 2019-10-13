<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		// Validate fields
		$error = false;
		$message = "";
		$ship = "";
		$notes = "";
		if (empty($_POST["name"])) {$message .= "You must provide a name.  "; $error = true;}
		else {$ship = substr(htmlspecialchars(strip_tags($_POST['name'])),0,50);}
		if (empty($_POST["notes"])) {$notes = ""; $message = "No notes on this ship?  "; }
		else {$notes=substr(htmlspecialchars(strip_tags($_POST['notes'])),0,65534);}

		// Check for a duplicate ship
		$rows = query("select count(*) rowCount from ship where ship_name=?", $ship);
		$row = $rows[0];
		if($row["rowCount"] > 0) {$message .= "This ship already exists in our records."; $error = true;}
		// If no errors have been detected, try to insert the row after noting some warnings
		if($error == false) 
		{
			$ship = trim($ship);
			$notes = trim($notes);
			$rowCount = query("insert into ship (ship_name, notes, user_id, changed) values (?,?,?,CURRENT_TIMESTAMP())",$ship, $notes,$_SESSION["id"]);
			if($rowCount == false) 
			{
				$message .= "Record inserted successfully.";
			}
			else {$message .= "Failed to add the record - please call support!";}
		}
		
      render("../view/ship_form.php", ["title" => "List of Ships", "message" => "$message"]);
    }
    else
    {
      render("../view/ship_create_form.php", ["title" => "Record Details of a new Ship"]);
    }

?>
