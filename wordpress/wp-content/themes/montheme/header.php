<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passion+One&family=Shippori+Antique+B1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
</head>

<body>
    <?php
    $role = get_userdata(get_current_user_id())->roles[0];
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                if ($role == 'administrator') {
                    wp_nav_menu([
                        'menu' => 'nav-admin',
                        'theme_location' => 'header',
                        'container' => false,
                        'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
                    ]);
                } else {
                    wp_nav_menu([
                        'menu' => 'nav-header',
                        'theme_location' => 'header',
                        'container' => false,
                        'menu_class' => "navbar-nav me-auto mb-2 mb-lg-0"
                    ]);
                }
                get_search_form(); ?>

            </div>
        </div>
    </nav>





    <div class="container">