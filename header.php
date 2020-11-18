<?php
/*
 * Header Template
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="author" content="Farias Maiquita">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<div class="site-wrap">
			<header class="site-header">
                <ul class="left-menu">
                    <li>
                        <button class="btn-side-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="feather-icon">
                                <path d="M2 8h12M6 4h8M2 12h8"/>
                            </svg>
                        </button>
                    </li>
                    <?php
                    wp_nav_menu( array(
                        'menu_class' => 'left-menu',
                        'container' => '',
                        'depth' => 1,
                        'theme_location' => 'collections',
                        'items_wrap' => '%3$s',
                    ) );
                    ?>
                </ul>

                <a href="<?php echo home_url(); ?>" class="logo-link">
                    <svg class="logo-ambala"><use xlink:href="#logo-ambala"></svg>
                </a>

                <ul class="right-menu">

                    <?php
                    get_template_part( '_inc/partials/header-lang-switcher' );
                    abl_currency_switcher( true );
                    ?>

                    <li>
                        <button class="btn-search">
                            <svg class="feather-icon"><use xlink:href="#icon-search"></svg>
                        </button>
                    </li>
                    <li>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </a>
                    </li>
                    <li class="btn-cart-wrap">
                        <button class="btn-cart">
                            <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon" viewBox="0 0 24 24">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
                            </svg>
                            <div class="cart-count">0</div>
                        </button>
                    </li>
                </ul>
			</header>