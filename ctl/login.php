<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    $_SESSION["id"] = "0";
    $_SESSION["username"] = "Unknown";
    $_SESSION["user_first_name"] = "";
    $_SESSION["user_surname"] = "Unknown";
    $_SESSION["member_exp"] = "Unknown";
    $_SESSION["search_count"] = "0";
    $_SESSION["search_date"] = "";
    $_SESSION["user_role"] = "Visitor";
    $_SESSION["selected_people_id"] = 0;
  	 $_SESSION["search_name_start"] = "";

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
		  $user_name_given = $_POST["username"];
		  $password_given = $_POST["password"];
        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $user_name_given);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["user_first_name"] = $row["first_name"];
                $_SESSION["user_surname"] = $row["surname"];
                $_SESSION["member_exp"] = $row["member_exp"];
                $_SESSION["search_count"] = $row["search_count"];
                $_SESSION["search_date"] = $row["search_date"];
                $_SESSION["user_role"] = $row["user_role"];
					 // log it
					 $success = TRUE;
					 login_log($user_name_given, $password_given, $success);
					 $today = date("Y-m-d");
					 //print_r($today);
					 //print_r($_SESSION["search_date"]);
					 if ($_SESSION["search_date"] != $today)
						{
							$_SESSION["search_date"] = $today;
							$_SESSION["search_count"] += 1;
							$rows = query("update users set search_count = ?, search_date = ? where id = ?", $_SESSION["search_count"], $_SESSION["search_date"], $_SESSION["id"]);
						}
                // redirect to search
                redirect("../ctl/search.php");
            }
        }
		  // log it
		  $success = FALSE;
		  login_log($user_name_given, $password_given, $success);
        // else apologize
        apologize("Invalid username and/or password.");
    }
    else
    {
        // else render form
        render("../view/login_form.php", ["title" => "Log In"]);
    }

?>
