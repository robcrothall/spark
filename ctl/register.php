<?php

    // configuration
    require("../conf/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your User Name.");
        }
        if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        if (empty($_POST["confirmation"]))
        {
            apologize("You must provide your confirmation password.");
        }
        if ($_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Your password and confirmation password are not identical.");
        }
        if (empty($_POST["surname"]))
        {
            apologize("You must provide your Surname.");
        }
        if (empty($_POST["first_name"]))
        {
            apologize("You must provide your first name(s).");
        }
        if (empty($_POST["phone"])) 
        {
        		if (empty($_POST["mobile"]))
        		{
            	apologize("You must provide at least one phone number.");
        		}
        }
        if (empty($_POST["email"]))
        {
            apologize("You must provide your email address. We will not abuse it.");
        }
        // query database for username
        $username = trim(substr(htmlspecialchars($_POST['username'], ENT_COMPAT),0,50));
        $rows = query("SELECT * FROM users WHERE username = ?", $username);

        // if we found user, tell him he is already registered
        if (count($rows) > 0)
        {
            apologize("Your username has already been registered - please choose another, or log on.  If you don't remember your password, contact the Kowie Museum.");
        }
        // query database for email address
        $email = trim(substr(htmlspecialchars($_POST['email'], ENT_COMPAT),0,50));
        $rows = query("SELECT * FROM users WHERE email = ?", $email);

        // if we found user, tell him he is already registered
        if (count($rows) > 0)
        {
            apologize("Your email has already been registered by User Name = $username - please log on.  If you don't remember your password, contact the Kowie Museum.");
        }
        // insert the new user into the users table
        $username = trim(substr(htmlspecialchars($_POST['username'], ENT_COMPAT),0,50));
        $surname = trim(substr(htmlspecialchars($_POST['surname'], ENT_COMPAT),0,50));
        $first_name = trim(substr(htmlspecialchars($_POST['first_name'], ENT_COMPAT),0,50));
        $phone = trim(substr(htmlspecialchars($_POST['phone'], ENT_COMPAT),0,50));
        $mobile = trim(substr(htmlspecialchars($_POST['mobile'], ENT_COMPAT),0,50));
        $email = trim(substr(htmlspecialchars($_POST['email'], ENT_COMPAT),0,50));
		$mydate = date("Y-m-d");
		$expdate = date("Y-m-d",strtotime("+1 week"));
        $rows = query("INSERT INTO users (username, hash, surname, first_name, phone, mobile, email, member_exp, search_count, search_date, user_role, user_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
            $username, crypt($_POST["password"],$username), $surname, $first_name, $phone, $mobile, $email, $expdate, 1, $mydate, "VISITOR", "1");
        if ($rows === false)
        {
            apologize("Unable to register your user name - please contact support");
        }
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        $rows = query("SELECT * FROM users WHERE id = ?", $id);
        $row = $rows[0];

        // remember that user's now logged in by storing user's ID in session
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $row["username"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["surname"] = $row["surname"];
        $_SESSION["member_exp"] = $row["member_exp"];
        $_SESSION["search_count"] = $row["search_count"];
        $_SESSION["user_role"] = $row["user_role"];

        // redirect to the search page
        redirect("search.php");
    }
    else
    {
      render("../view/register_form.php", ["title" => "Register"]);
    } 
?>
