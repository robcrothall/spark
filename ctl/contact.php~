<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
		if(isset( $_POST['name']))
		  $name = $_POST['name'];
		if(isset( $_POST['email']))
		  $email = $_POST['email'];
		if(isset( $_POST['message']))
		  $message = $_POST['message'];
		if(isset( $_POST['subject']))
		  $subject = $_POST['subject'];

		$content="From: $name \n Email: $email \n Message: $message";
		$recipient = "info@kowiemuseum.co.za";
		$mailheader = "From: $email \r\n";
		mail($recipient, $subject, $content, $mailheader) or die("Error!");
		echo "Email sent!";
        // redirect to the search page
      //redirect("search");
    }
    else
    {
      render("../templates/contact_form.php", ["title" => "Subscribe"]);
    } 
?>