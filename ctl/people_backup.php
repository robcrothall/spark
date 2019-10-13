<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
	 $title = "";
	 $first_name = "";
	 $surname = "";
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		  // Prepare to generate the SQL insert statement
		  $sql1 = "insert into `people` (";
		  $sql2 = ") values (";
        // validate submission
        if (empty($_POST["surname"]))
        {
            apologize("You must provide a surname.  Capitalize as necessary.");
        }
		  if (str_word_count($_POST["surname"]) > 1) 
		  {	  
				$surname = $_POST["surname"];
		  }
		  else 
		  {
		  		$surname = ucfirst($_POST["surname"]);
		  }
		  $sql1 = $sql1 . "`surname`";
		  $sql2 = $sql2 . "\"" . $surname . "\"";
		  if ($_POST["first_name"] != "")
		  {
		  	$first_name = ucfirst($_POST["first_name"]);
		  	$sql1 = $sql1 . ", first_name";
		  	$sql2 = $sql2 . ", \"" . $first_name . "\"";
		  }
		  if ($_POST["other_name"] != "")
		  {
		   $other_name = ucwords($_POST["other_name"]);
		  	$sql1 = $sql1 . ", other_name";
		  	$sql2 = $sql2 . ", \"" . $other_name . "\"";
		  }
		  if ($_POST["title"] != "")
		  {
		   $title = ucwords($_POST["title"]);
		  	$sql1 = $sql1 . ", title";
		  	$sql2 = $sql2 . ", \"" . $title . "\"";
		  }
		  if ($_POST["birth_year"] != "")
		  {
		   $birth_year = $_POST["birth_year"];
		  	$sql1 = $sql1 . ", birth_year";
		  	$sql2 = $sql2 . ", " . $birth_year;
		  }
		  if ($_POST["ref_no"] != "")
		  {
		  	$ref_no = $_POST["ref_no"];
		  	$sql1 = $sql1 . ", ref_no";
		  	$sql2 = $sql2 . ", \"" . $ref_no . "\"";
		  }
		  if ($_POST["occ"] != "unknown")
		  {
		   $occupation = $_POST["occ"];
		  	$sql1 = $sql1 . ", occupation";
		  	$sql2 = $sql2 . ", " . $occupation;
		  }
		  if ($_POST["par"] != "unknown")
		  {
		   $party = $_POST["par"];
		  	$sql1 = $sql1 . ", party";
		  	$sql2 = $sql2 . ", " . $party;
		  }
		  if ($_POST["voy"] != "unknown")
		  {
		   $voyage_id = $_POST["voy"];
		  	$sql1 = $sql1 . ", voyage_id";
		  	$sql2 = $sql2 . ", " . $voyage_id;
		  }
		  $sql1 = $sql1 . ", user_id";
		  $sql2 = $sql2 . ", " . $_SESSION["id"] . ")";
		  $sql_all = $sql1 . $sql2;
		  //print_r($sql_all);
        // insert this new person
        //$rows = query("insert into `people` (`surname`, `first_name`, `other_name`, `title`, `birth_year`, `ref_no`, `occupation`, `party`, `voyage_id`, `user_id`)
        //										values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $surname, $first_name, $other_name, $title, $birth_year, $refno, $occupation, $party, $voyage, $_SESSION["id"]);
        $rows = query($sql_all);
        if ($rows === false)
        {
            apologize("Unable to add this person - please contact Support");
        }
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        //print_r($rows);
        $record_id = $rows[0]["id"];
        //print_r($record_id);
        $message = "";
        if ($title != "")
        {
        	$message .= $title . " ";
        }
        if ($first_name != "")
        {
         $message .= $first_name . " ";
        }
        if ($surname != "")
        {
        	$message .= $surname . " ";
        }
        $message .= "has been added to the database as record " . $record_id . ".  Now add her/his history.";
        render("../view/people_form.php", ["title" => "Person confirmation",
                    "message" => $message]);
    }
    else
    {
        // else render form
        render("../view/people_form.php", ["title" => "People", "message" => " "]);
    }

?>
