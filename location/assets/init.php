<?php  
// +------------------------------------------------------------------------+
// | @author Ercan Agkaya (Themerig)
// | @author_url 1: https://www.themerig.com
// | @author_url 2: https://codecanyon.net/user/themerig
// | @author_email: ercanagkaya@gmail.com   
// +------------------------------------------------------------------------+
// | Locations CMS - Multipurpose CMS Directory Theme
// | Copyright (c) 2017 Locations CMS. All rights reserved.
// +------------------------------------------------------------------------+

if (!empty($_SERVER['REQUEST_URI'])) {
	$a = seo($_SERVER['REQUEST_URI']);
	$te = str_replace("php","", $a);
} else {
	$te = '';
}

if ($_SERVER['REQUEST_URI'] == '/') {
	$b = $settings['title_r'];
} else if ($_SERVER['REQUEST_URI']) {
	$b = '';
}

if ($_SERVER['REQUEST_URI'] == '/') {
	$d = $settings['home_desc'];
} else if ($_SERVER['REQUEST_URI']) {
	$d = '';
}

echo'<!DOCTYPE html>
<php lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/zabuto_calendar.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/trackpad-scroll-emulator.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title>'.$settings['title'].' '.$settings['sep'].' ' .$te = str_replace("_"," ", ucfirst($te)). ' '.$b.'</title>
	<meta name="description" content="'.$d.'">
</head>
<body class="homepage">
<div class="page-wrapper">';