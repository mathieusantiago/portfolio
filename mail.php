<?php
$secret = "6Le1f6okAAAAADzbyWc0ZahrvxGs_GOVJcz6zam4";
$response = htmlspecialchars($_POST['g-recaptcha-response']);
$remoteip = $_SERVER['REMOTE_ADDR'];
$request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";

$get = file_get_contents($request);
$decode = json_decode($get, true);

if ($decode['success']) {
    if ($_POST) {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['text'])) {

            $recepient = "mathieusantiago21@gmail.com";
            $sitename = "santiagodevweb";

            $name = strip_tags(trim($_POST["name"]));
            $email = strip_tags(trim($_POST["email"]));
            $text = htmlspecialchars(trim($_POST["text"]));
            $message = "Name: $name \nEmail: $email \nText: $text";

            $pagetitle = "NEW!!! Message du site \"$sitename\"";
            mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
            header("Location: https://santiagodevweb.com/");
            exit()
        }
    } else {
        http_response_code(405);
        echo "méthode non autorisée";
    }
} 
