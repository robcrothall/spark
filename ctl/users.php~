<?php

    // configuration
    require("../conf/config.php"); 
	 $_SESSION["module"] = $_SERVER["PHP_SELF"];
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide the UserName to be updated.");
        }
        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["old_pwd"], $row["hash"]) == $row["hash"])
            {
                // update the password in the users table
                $new_password = crypt($_POST["new_pwd1"], $row["username"]);
                $rows = query("UPDATE users SET hash = ?, time_stamp = CURRENT_TIMESTAMP() WHERE id = ?", $new_password, $row["id"]) ;
                if ($rows === false)
                {
                    apologize("Unable to change password - please contact support");
                }
                $message = "Password change was successful.";
                render("password_confirm_form.php", ["title" => "Password change confirmation",
                    "message" => $message]);
            }
            else
            {
                apologize("The value entered as current password is incorrect.");
            }
        }
        else
        {
            apologize("Username not found - call support!");
        } 
    }
    else
    {
        // else render form
        render("../view/user_form.php");
    }

?>
