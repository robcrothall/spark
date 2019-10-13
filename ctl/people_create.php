<?php
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		$error = false;
		$message = "";
		if (empty($_POST["surname"])) {$message .= "You must provide a surname.  "; $error = true;}
        else {$surname=trim(substr(htmlspecialchars($_POST['surname'], ENT_COMPAT),0,50));}
        $first_name=trim(substr(htmlspecialchars(strip_tags($_POST['first_name']), ENT_COMPAT),0,50));
        $other_name=trim(substr(htmlspecialchars(strip_tags($_POST['other_name']), ENT_COMPAT),0,50));
        $title=trim(substr(htmlspecialchars(strip_tags($_POST['title']), ENT_COMPAT),0,50));
        $birth_year=trim(substr(htmlspecialchars(strip_tags($_POST['birth_year']), ENT_COMPAT),0,10));
		If (!is_numeric($birth_year))
      	    {$birth_year = 0;}
  		$party_id=trim(substr(htmlspecialchars(strip_tags($_POST['party_id']), ENT_COMPAT),0,50));
        $age=trim(substr(htmlspecialchars(strip_tags($_POST['age']), ENT_COMPAT),0,10));
		If (!is_numeric($age))
      	    {$age = 0;}
  		$party_id=trim(substr(htmlspecialchars(strip_tags($_POST['party_id']), ENT_COMPAT),0,50));
        $ref_no=trim(substr(htmlspecialchars(strip_tags($_POST['ref_no']), ENT_COMPAT),0,50));
        $occupation_id = substr(htmlspecialchars(strip_tags($_POST['occupation_id']), ENT_COMPAT),0,20);
        $voyage_id = substr(htmlspecialchars(strip_tags($_POST['voyage_id']), ENT_COMPAT),0,20);
        $notes=trim(substr(htmlspecialchars(strip_tags($_POST['notes']), ENT_COMPAT),0,65534));
        $user_id=htmlspecialchars(strip_tags($_SESSION['id']));
		$rows = query("select count(*) rowCount from people where surname=? and first_name=? and other_name=?", $surname, $first_name, $other_name);
		$row = $rows[0];
		if($row["rowCount"] > 0) {$message .= "Warning: This name already exists in our records.";}
        if ($error == true) {apologize($message);}
        $rows = query("insert into people (surname, first_name, other_name, title, birth_year, age, occupation_id, party_id, voyage_id, ref_no, notes, user_id, changed) values (?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP())",
      					$surname, $first_name, $other_name, $title, $birth_year, $age, $occupation_id, $party_id, $voyage_id, $ref_no, $notes, $user_id);
		if($rows !== false) 
			{
				 $message .= "Record inserted successfully.";
			}
			else {$message .= "Failed to add the record - please call support!";}
			
      render("../view/people_form.php", ["title" => "List of Peoples", "message" => "$message"]);
    }
    else
    {
    	$_SESSION["party_id_select"] = 0;
    	$_SESSION["occupation_id_select"] = 0;
    	$_SESSION["voyage_id_select"] = 0;
      render("../view/people_create_form.php", ["title" => "Record details of a new Person"]);
    }

?>
