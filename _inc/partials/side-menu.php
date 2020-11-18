<?php
/*
 * Side Menu
 */
?>

<section class="side-menu-wrap full-overlay">
	<div class="side-menu overlay-main">
		<button class="btn-close-overlay">
			<svg class="icon-x feather-icon"><use xlink:href="#icon-x"></svg>
		</button>
		<div class="inner-wrap vertical-scrollbar">
            <?php get_search_form(); ?>
            <ul class="accordion-menu side-list">
                <?php
                $abl_locations = array( 'collections', 'product_cat', 'brands' );
                $locations_data = get_nav_menu_locations();
                $show_submenu = true;

                foreach ( $abl_locations as $location ) {
                    abl_submenu_at( $location, $locations_data, true, $show_submenu );
                    $show_submenu = false;
                }
                ?>

                <li class="hr"></li>

                <?php
                abl_submenu_at( 'languages', $locations_data );
                abl_currency_switcher( false );

                $account_location = is_user_logged_in() ? 'account_logged_in' : 'account_logged_out';
                abl_submenu_at( $account_location, $locations_data );
                ?>

            </ul>
        </div>
	</div>
</section>

