<?php

if (!$_POST) {
	echo 'NO ACCESS';
	die;
}

// If the request is a post from the "Contact Us" page contact form
if ($_POST['contact'] == 1) {

function sendEmail () {

	//Grab Variables
	$admin_email = $_POST['admin_email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$comment = $_POST['comment'];
	$certify = $_POST['certify'];

	if ($certify == 1) {
		$certified = "Yes, I certify that I am 18 years or older.";
	}
	
	//to email
	$sendTo = "dhenze@idahoan.com";
	$from = $email;
	$subject = "Idahoan Food Service : Contact Form";
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers.= "From: Idahoan Food Service <donotreply@idahoanfoodservice.com>";
	
	$message = "<h1>CONTACT FORM DETAILS</h1>";
	$message .= "<p><b>Name:</b> " . $first_name . ' ' . $last_name . "</p>";
	$message .= "<p><b>Email:</b> " . $email . "</p>";
	$message .= "<p><b>Phone:</b> " . $phone . "</p>";
	$message .= "<p><b>Comment:</b> " . $comment . "</p>";

	$message .= "<p><b>Certified:</b> " . $certified . "</p>";
	
	mail($sendTo, $subject, $message, $headers);
	
	header("location:http://dev.foerstel.com/idahoanfoodservice/thank-you");
}
sendEmail();

}

// If the request is a post from a "Broker" page contact form
if ($_POST['broker'] == 1) {

function sendEmail () {

	//Grab Variables	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$certify = $_POST['certify'];
	$contact_email = $_POST['contact_email'];
	$zipcode = $_POST['zipcode'];

	if ($certify == 1) {
		$certified = "Yes, I certify that I am 18 years or older.";
	}
	
	//to email
	$sendTo = $contact_email;
	$from = $email;
	$subject = "Idahoan Food Service : Broker Contact Form";
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers.= "From: Idahoan Food Service <donotreply@idahoanfoodservice.com>";
	
	$message = "<h3>" . $name . " has requested contact via the Idahoan Food Service Website for the zipcode: " . $zipcode . "</h3>";
	$message .= "<p><b>Name:</b> " . $name . "</p>";
	$message .= "<p><b>Email:</b> " . $email . "</p>";
	$message .= "<p><b>Phone:</b> " . $phone . "</p>";

	$message .= "<p><b>Certified:</b> " . $certified . "</p>";
	
	mail($sendTo, $subject, $message, $headers);
	
	header("location:http://dev.foerstel.com/idahoanfoodservice/thank-you");
}
sendEmail();

}

?>