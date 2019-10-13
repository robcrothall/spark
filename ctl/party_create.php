<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		// Validate fields
		$error = false;
		$message = "";
		$party_name = "";
		$party_leader_id = 0;
		$voyage_id = 0;
		$notes = "";
		if (empty($_POST["name"])) {$message .= "You must provide a name.  "; $error = true;}
		else {$party_name = substr(htmlspecialchars(strip_tags($_POST['name'])),0,50);}
		$party_leader = substr(htmlspecialchars(strip_tags($_POST["party_leader"])),0,20);
		if (empty($_POST["notes"])) {$notes = ""; $message = "No notes on this party_name?  "; }
		else {$notes=substr(htmlspecialchars(strip_tags($_POST['notes'])),0,65534);}
		if (empty($_POST["voyage_id"])) {$message .= "Invalid voyage selected.  ";}
		else {$voyage_id = substr(htmlspecialchars(strip_tags($_POST["voyage_id"])),0,20);}

		// Check for a duplicate party_name
		$rows = query("select count(*) rowCount from party where party_name=?", $party_name);
		$row = $rows[0];
		if($row["rowCount"] > 0) {$message .= "This party_name already exists in our records.";}
		// If no errors have been detected, try to insert the row after noting some warnings
		if($error == false) 
		{
			$party_name = trim($party_name);
			$voyage_id = trim(voyage_id);
			$notes = trim($notes);
			$rowCount = query("insert into party (party_name, party_leader, voyage_id, notes, user_id, changed) values (?,?,?,?,?,CURRENT_TIMESTAMP())",$party_name, $party_leader, $voyage_id, $notes,$_SESSION["id"]);
			if($rowCount == false) 
			{
				$message .= "Record inserted successfully.";
			}
			else {$message .= "Failed to add the record - please call support!";}
		}
		
      render("../view/party_form.php", ["title" => "List of Partys", "message" => "$message"]);
    }
    else
    {
    	$_SESSION["party_leader_select"] = 1; // Default to South Africa
      render("../view/party_create_form.php", ["title" => "Record Details of a new Party"]);
    }

?>
