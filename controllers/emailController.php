<?php

require_once 'C:\xampp\htdocs\iwp\user-verification\composer_lib\vendor\autoload.php';//used for including classes
require_once 'C:\xampp\htdocs\iwp\config\constants.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))//465 ssl
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD);

// Create the Mailer using your created Transport
//set swiftmailer in mailer object
$mailer = new Swift_Mailer($transport);


function sendVerificationEmail($userEmail, $token)
{
    global $mailer;//global mailer variable

    $body='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Verify email</title>
    </head>
    <body>
        <div class="wrapper">
            <p>
                Thank you for signing up on our website. Please click
                on the link below to verify your email.
            </p>
            <!--including token in link using concatenation for identifying the user-->
            <a href="http://localhost/iwp/user-verification/index.php?token=' . $token . '">
                Verify your email address
            </a>
        </div>
    </body>
    </html>';


    // Create a message
    $message = (new Swift_Message('Verify your email address'))
    //sender mail
    ->setFrom(EMAIL)
    //receiver mail
    ->setTo($userEmail)
    //html message
    ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

   
}

function sendPasswordResetLink($userEmail, $token){

    global $mailer;

    $body='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Verify email</title>
    </head>
    <body>
        <div class="wrapper">
            <p>
                Hello there,

                Please click on the link below to reset your password.
            </p>

            <a href="http://localhost/iwp/user-verification/index.php?password-token=' . $token . '">
                Reset your password
            </a>
        </div>
    </body>
    </html>';


    // Create a message
    $message = (new Swift_Message('Reset your password'))
    ->setFrom(EMAIL)
    ->setTo($userEmail)
    ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

}


function user_delete($userEmail)
{
    global $mailer;//global mailer variable

    $body='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Verify email</title>
    </head>
    <body>
        <div class="wrapper">
            <p>
                You have violated the norms and conditions of our forum. Thereby, your account stands deleted.
            </p>
        </div>
    </body>
    </html>';


    // Create a message
    $message = (new Swift_Message('Deleting user account'))
    //sender mail
    ->setFrom(EMAIL)
    //receiver mail
    ->setTo($userEmail)
    //html message
    ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

   
}

function user_contact($fname, $lname, $query_mail, $person_query)
{
    global $mailer;//global mailer variable

    $body='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Verify email</title>
    </head>
    <body>
        <div class="wrapper">
            First Name: '.$fname.'<br>
            Last Name: '.$lname.'<br>
            Email ID: '.$query_mail.'<br>
            Message<br><br>'.$person_query.'
        </div>
    </body>
    </html>';


    // Create a message
    $message = (new Swift_Message('Feedback'))
    //sender mail
    ->setFrom(EMAIL)
    //receiver mail
    ->setTo(EMAIL)
    //html message
    ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

   
}