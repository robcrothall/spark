<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            $rec_id = $_SESSION["rec_id"];
            $departure_date=trim(substr(htmlspecialchars(strip_tags($_POST['departure_date']), ENT_COMPAT),0,50));
            $arrival_date=trim(substr(htmlspecialchars(strip_tags($_POST['arrival_date']), ENT_COMPAT),0,50));
            $ship_id = substr(htmlspecialchars(strip_tags($_POST['ship_id']), ENT_COMPAT),0,20);
            $origin_id = substr(htmlspecialchars(strip_tags($_POST['origin_id']), ENT_COMPAT),0,20);
            $destination_id = substr(htmlspecialchars(strip_tags($_POST['destination_id']), ENT_COMPAT),0,20);
            $notes=trim(substr(htmlspecialchars(strip_tags($_POST['notes']), ENT_COMPAT),0,65534));
            $user_id=htmlspecialchars(strip_tags($_SESSION['id']));
            // Do some validation
            $errMsg = "";
            //if (empty($departure_date)) {$errMsg .= "The voyage date cannot be empty. ";}
            //if (!empty($errMsg)) {apologize($errMsg);}
            $departure_date = trim($departure_date);
            $arrival_date = trim($arrival_date);
            $ship_id = trim($ship_id);
            $origin_id = trim($origin_id);
            $destination_id = trim($destination_id);
            $notes = trim($notes);
            $rows = query("update voyage set departure_date=?, arrival_date = ?, ship_id=?, origin_id=?, destination_id=?, notes=?, user_id=?, changed=CURRENT_TIMESTAMP() where id=?",
                    $departure_date, $arrival_date, $ship_id, $origin_id, $destination_id, $notes, $user_id, $rec_id);
				If ($rows === false)
				{
					print_r($rec_id);
					print_r($voyage_date);
					print_r($ship_id);
					print_r($notes);
					print_r(strlen($notes));
					print_r($user_id);
					print_r($rows);
					apologize("Update failed.  Please call support.");
				}
				else 
				{
					render("../view/voyage_update_form.php", ["title" => "Update Voyages", "form_id" => "$rec_id", "message" => "Update was successful."]);        
        		}
    }
    else
    {
    	$id = null;
    	if (!empty($_GET['id'])) {
      	$id = htmlspecialchars(strip_tags($_GET['id']));
      }
		$_SESSION["rec_id"] = $id;
      render("../view/voyage_update_form.php", ["title" => "Update a Voyage",
            "form_id" => "$id", "message" => ""]);
    }

?>
