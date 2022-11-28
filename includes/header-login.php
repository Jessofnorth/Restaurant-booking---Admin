<?php 
/* @author Jessica Ejelöv - jeej2100@student.miun.se */
include('config.php');
// logout function
$user = new User();
if (isset($_GET['logout'])) {
    $user->logoutUser();
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="images/png" href="img/favicon.png">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="sass/main.css">
    <title><?= $site_title . $divider . $page_title; ?></title>
</head>

<body>
    <header>
        <!-- desktop nav -->
        <nav class="desktop-nav">
            <a href="index.php"><img src="img/logo.png" alt="Johans Kök logotyp"></a>    
        </nav>
    </header>