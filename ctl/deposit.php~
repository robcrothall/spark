<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["cash"]))
        {
            apologize("You must provide the value of cash deposited.");
        }
        $msg = "uninitialized";
        $req_cash = $_POST["cash"];
        if (! is_numeric($req_cash))
        {
            apologize("You must provide a numeric value for cash deposited.");
        }
        if ($req_cash < 0)
        {
            apologize("You must provide a positive value for cash deposited.");
        }
        $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        if (count($rows) == 1)
        {
            $available_funds = $rows[0]["cash"];
        }
        $rows = query("UPDATE users set cash = cash + ? WHERE id = ?", $req_cash, $_SESSION["id"]);
        if ($rows === false)
        {
            apologize("Unable to update user cash value!");
        }
        $values["action"] = "CASH";
        $values["value"] = $req_cash;
        $values["msg"] = "Success";
        write_history($values);
        $funds = number_format($available_funds + $req_cash, 2);
        $msg = "Deposit of $req_cash was successful.";
        render("deposit_form.php", ["title" => "Cash Response",
            "form_cash" => "$req_cash",
            "form_funds" => "$funds",
            "form_msg" => $msg]);
    }
    else
    {
        $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        $available_funds = 0.00;
        if (count($rows) == 1)
        {
            $available_funds = $rows[0]["cash"];
        }
        $funds = number_format($available_funds,2);
        
        render("deposit_form.php", ["title" => "Cash deposit",
            "form_cash" => "",
            "form_funds" => "$funds",
            "form_msg" => ""]);
    }

?>
