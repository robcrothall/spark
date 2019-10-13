<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		// Validate fields
		$error = false;
		$message = "";
		$ship_id = 0;
		$departure_date = "";
		$arrival_date = "";
		$origin_id = 0;
		$dest_id = 0;
		$notes = "";
		if (empty($_POST["departure_date"])) {$departure_date = " ";}
		else {$departure_date = substr(htmlspecialchars(strip_tags($_POST['departure_date'])),0,20);}
		if (empty($_POST["arrival_date"])) {$arrival_date = " ";}
		else {$arrival_date = substr(htmlspecialchars(strip_tags($_POST['arrival_date'])),0,20);}
		$ship_id = substr(htmlspecialchars(strip_tags($_POST["ship_id"])),0,20);
		$origin_id = substr(htmlspecialchars(strip_tags($_POST["origin_id"])),0,20);
		$destination_id = substr(htmlspecialchars(strip_tags($_POST["destination_id"])),0,20);
		if (empty($_POST["notes"])) {$notes = ""; $message = "No notes on this voyage?  "; }
		else {$notes=substr(htmlspecialchars(strip_tags($_POST['notes'])),0,65534);}

		// Check for a duplicate voyage
		//$rows = query("select count(*) rowCount from voyage where voyage=?", $voyage);
		//$row = $rows[0];
		//if($row["rowCount"] > 0) {$message .= "This voyage already exists in our records."; $error = true;}
		// If no errors have been detected, try to insert the row after noting some warnings
		if($error == false) 
		{
			$ship_id = trim($ship_id);
			$departure_date = trim($departure_date);
			$arrival_date = trim($arrival_date);
			$origin_id = trim($origin_id);
			$destination_id = trim($destination_id);
			$notes = trim($notes);
			$rowCount = query("insert into voyage (departure_date, arrival_date, ship_id, origin_id, destination_id, notes, user_id, changed) values (?,?,?,?,?,?,?,CURRENT_TIMESTAMP())",
								$departure_date, $arrival_date, $ship_id, $origin_id, $destination_id, $notes, $_SESSION["id"]);
			if($rowCount == false) 
			{
				$message .= "Record inserted successfully.";
			}
			else {$message .= "Failed to add the record - please call support!";}
		}
		
      render("../view/voyage_form.php", ["title" => "List of Voyages", "message" => "$message"]);
    }
    else
    {
      render("../view/voyage_create_form.php", ["title" => "Record Details of a new Voyage"]);
    }

?>
