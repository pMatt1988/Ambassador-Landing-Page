<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("phpmailer/PHPMailer.php");
require("phpmailer/SMTP.php");
require("phpmailer/Exception.php");

if(empty($_POST['email'])) {
    echo 'Email is a required field!';
    die();
}

$email = $_POST['email'];
$from = $_POST['from'];
$to = $_POST['to'];
$description = $_POST['description'];

$subject = "Estimate request from: $email";
$body =
    "Email: $email <br><br>
     Shipping From: $from <br><br>
     Shipping To: $to <br><br>
     Description: <br> $description";

$myemail = "contact-form@ambassadorcrating.com";

//Load Composer's autoloader                            // Passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    $mail->IsSMTP(); // enable SMTP
    $mail->isHTML();
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.ambassadorcrating.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "contact-form@ambassadorcrating.com";
    $mail->Password = "dude101@";
    $mail->SetFrom($myemail);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress("pmatt1988@gmail.com");
    $mail->AddAddress("ambassadorinstallations@gmail.com");

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header("Location: thankyou.html");
    }
} catch (Exception $e) {
    print_r($e);
}