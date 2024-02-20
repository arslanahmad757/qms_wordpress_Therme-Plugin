<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <title><?php wp_title('HRNexa', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <header>
        <!-- header inner -->
        <div class="head_top">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <?php $hero_image = get_theme_mod('logo_image'); ?>
                                        <?php if ($hero_image) : ?>
                                            <img style="border-radius:10px;" src="<?php echo esc_url($hero_image); ?>" alt="">
                                        <?php else : ?>
                                            <a href=""><img style="border-radius:10px;" src="<?php echo get_template_directory_uri(); ?>/images/logo-old.png" alt="#" /></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark ">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#feature">Features</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#request">Contact us</a>
                                        </li>
                                    </ul>
                                    <?php
                                    if (current_user_can('administrator') || current_user_can('hr')) {
                                    ?><div class="sign_btn"><a href="https://localhost/qms/dashboard/">HR Dashboard</a></div><?php
                                    }                                                                                   ?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end header inner -->
            <!-- end header -->
            <!-- banner -->
            <section class="banner_main">
                <div class="container-fluid">
                    <div class="banner_bg">
                        <div class="row d_flex">
                            <div class="col-xl-6 col-lg-6 col-md-12 padding_right1">
                                <div class="text_box_color">
                                    <div class="text-bg">
                                        <h1><?php echo get_theme_mod('hero_heading') ?><br></h1>
                                        <strong><?php echo get_theme_mod('hero_para1') ?></strong>
                                        <span><?php echo get_theme_mod('hero_para2') ?></span>
                                        <a href="<?php echo get_theme_mod('hero_btn_link') ?>"><?php echo get_theme_mod('hero_btn_text') ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 padding_right1">
                                <div class="text-img">
                                    <figure><img style="width:100rem;" src="<?php echo get_template_directory_uri(); ?>/images/top_img1.png" alt="#" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </header>