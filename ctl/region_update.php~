<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            $rec_id = $_SESSION["rec_id"];
            $region=trim(substr(htmlspecialchars(strip_tags($_POST['name']), ENT_COMPAT),0,50));
            $country_id = 1; //***************************************************************************************************
            $notes=trim(substr(htmlspecialchars(strip_tags($_POST['notes']), ENT_COMPAT),0,65534));
            $user_id=htmlspecialchars(strip_tags($_SESSION['id']));
            // Do some validation
            $errMsg = "";
            if (empty($region)) {$errMsg .= "The region name cannot be empty. ";}
            if (!empty($errMsg)) {apologize($errMsg);}
            $rows = query("update regions set region=?, country_id=?, notes=?, user_id=?, changed=CURRENT_TIMESTAMP() where id=?",
                    $region, $country_id, $notes, $user_id, $rec_id);
				If ($rows === false)
				{
					print_r($rec_id);
					print_r($region);
					print_r($country_id);
					print_r($notes);
					print_r(strlen($notes));
					print_r($user_id);
					print_r($rows);
					apologize("Update failed.  Please call support.");
				}
				else 
				{
					render("../view/region_update_form.php", ["title" => "Update Regions", "form_id" => "$rec_id", "message" => "Update was successful."]);        
        		}
    }
    else
    {
    	$id = null;
    	if (!empty($_GET['id'])) {
      	$id = htmlspecialchars(strip_tags($_GET['id']));
      }
		$_SESSION["rec_id"] = $id;
      render("../view/region_update_form.php", ["title" => "Update a Region",
            "form_id" => "$id", "message" => ""]);
    }

?>
