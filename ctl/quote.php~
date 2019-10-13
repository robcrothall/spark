<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide the symbol of the stock.");
        }
        $stock = lookup($_POST["symbol"]);
        if (empty($stock["symbol"]))
        {
            apologize("Stock symbol '" . $_POST["symbol"] . "' was not found.  Please try again.");
        }
        $name = $stock["name"];
        $price = number_format($stock["price"],4);
        $symbol = $stock["symbol"];
        render("quote_req_form.php", ["title" => "Quote Response",
            "form_symbol" => "$symbol",
            "form_name" => "$name",
            "form_price" => "$price"]);
    }
    else
    {
        // else render form
        render("quote_req_form.php", ["title" => "Quote Request",
            "form_symbol" => "",
            "form_name" => "",
            "form_price" => ""]);
    }

?>
