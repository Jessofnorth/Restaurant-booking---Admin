<?php 
/* @author Jessica Ejelöv - jeej2100@student.miun.se */
// autoinclude classes
spl_autoload_register(function ($class_name){
    include 'classes/' . $class_name . '.class.php';
});

// true = activates error messages, false = deactivates
$devmode = false;
if ($devmode) {
    error_reporting(-1);
    ini_set("display_errors", 1);}

    //session start
session_start();

// site title/pagetitle
$site_title = "Johans Kök";
$divider = " | ";