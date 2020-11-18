<?php
/*
 * Theme Functions
 */

use Elementor\Plugin as EP;


// Elementor Widgets
function abl_elemetor_widgets() {
	require_once( get_template_directory() . '/_inc/elementor/home-products.php' );
}
add_action( 'elementor/widgets/widgets_registered', 'abl_elemetor_widgets' );


// Elementor Categories
function abl_elementor_categories() {
	EP::$instance->elements_manager->add_category(
        'abl_home_page',
        array( 'title' => __( 'ABL Home Page', 'abl' ) )
    );
}
add_action( 'elementor/init', 'abl_elementor_categories' );


// Icon CSS for Custom Elementor Widgets
function abl_widgets_icon() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style(
        'abl-widgets-icon',
        get_template_directory_uri() . '/_inc/assets/admin/widgets-icon.css',
        array(),
        $theme_version
    );
}
add_action( 'elementor/editor/before_enqueue_scripts', 'abl_widgets_icon' );


// Prevent Elementor from loading Google Fonts
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );


// Prevent Elementor form loading Font Awesome
add_action( 'elementor/frontend/after_register_styles', function() {
	foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
		wp_deregister_style( 'elementor-icons-fa-' . $style );
	}
}, 20 );


// Theme Support
function abl_theme_support() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'script', 'style' ) );

	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 290,
		'single_image_width'    => 550,
		//'gallery_thumbnail_image_width' => 100,

		'product_grid'          => array(
			'default_rows'    => 8,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 3,
			'min_columns'     => 2,
			'max_columns'     => 3,
		),
	) );

	add_theme_support( 'post-thumbnails' );
	abl_image_sizes();
}
add_action( 'after_setup_theme', 'abl_theme_support' );

function abl_image_sizes() {
	// Hero
	add_image_size( 'abl_hero_1', 550, 640, true );
	add_image_size( 'abl_hero_2', 430, 640, true );
	add_image_size( 'abl_hero_3', 380, 420, true );
	add_image_size( 'abl_hero_3', 380, 300, true );

	// Lookbook
	add_image_size( 'abl_lookbook_1', 500, 700, true );
	add_image_size( 'abl_lookbook_2', 300, 400, true );
	add_image_size( 'abl_lookbook_3', 620, 440, true );

	// About
	add_image_size( 'abl_about', 660, 660 );

	// Instagram
	add_image_size( 'abl_instagram', 290, 363, true );
}


// Enqueue Styles & Scripts
function abl_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'abl-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_script(
		'overlay-scrollbars',
		get_template_directory_uri() . '/_inc/assets/js/jquery.overlayScrollbars.min.js',
		array( 'jquery' ),
		$theme_version,
		true
	);
	wp_enqueue_script(
		'abl-script',
		get_template_directory_uri() . '/_inc/assets/js/script.js',
		array( 'jquery', 'overlay-scrollbars' ),
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'abl_enqueue_scripts' );


// Navigation Menus
function abl_nav_menus() {
	register_nav_menus( array(
		'collections' => __( 'Product Collections', 'abl' ),
		'product_cat' => __( 'Product Categories', 'abl' ),
		'brands' => __( 'Product Brands', 'abl' ),
		'languages' => __( 'Languages', 'abl' ),
		'account_logged_in' => __( 'Account When Logged In', 'abl' ),
		'account_logged_out' => __( 'Account When Logged Out', 'abl' ),
	) );
}
add_action( 'init', 'abl_nav_menus' );

function abl_reg_for_menus( $register, $name = '' ) {
	if ( in_array( $name, array( 'pa_brands', 'pa_collections' ) ) ) $register = true;
	return $register;
}
add_filter('woocommerce_attribute_show_in_nav_menus', 'abl_reg_for_menus', 1, 2);


// SVG Symbols
function abl_svg_symbols() {
	get_template_part( '_inc/partials/svg-symbols' );
}
add_action( 'wp_body_open', 'abl_svg_symbols' );


// Footer Partials
function abl_footer_parts() {
	get_template_part( '_inc/partials/side-menu' );
	get_template_part( '_inc/partials/top-search' );
	get_template_part( '_inc/partials/side-cart' );
}
add_action( 'wp_footer', 'abl_footer_parts' );


// Side Menu Submenu Helper
function abl_submenu_at( $location, $locations_data, $show_toggle_btn = true, $show_submenu = false ) {
	$menu_id = $locations_data[ $location ] ;
	$menu_obj = wp_get_nav_menu_object( $menu_id );
	$menu_name = $menu_obj->name;
	$li_class = $show_toggle_btn ? 'submenu-wrap ' . ( $show_submenu ? 'show-submenu' : '' ) : '';
	?>

	<li class="<?php echo $li_class; ?>">
        <?php if ( $show_toggle_btn ) { ?>
            <button class="btn-toggle-submenu submenu-title">
                <span><?php echo $menu_name ?></span>
                <svg class="icon feather-icon"><use xlink:href="#icon-chevron-down"></svg>
            </button>
        <?php } else { ?>
            <p class="submenu-title"><?php echo $menu_name ?></p>
            <?php
        }

        wp_nav_menu( array(
			'menu_class' => 'sublist' . ( $show_toggle_btn ? ' submenu' : '' ),
			'container' => '',
			'depth' => 1,
			'theme_location' => $location
		) );
		?>
	</li>

    <?php
}


// Current Language Code Helper
function get_current_lang() {
	if ( class_exists( 'TRP_Translate_Press' ) ) {
		$trp = TRP_Translate_Press::get_trp_instance();
		$trp_url_converter = $trp->get_component('url_converter');
		$trp_language_switcher = $trp->get_component('language_switcher');
		$lang_from_url = $trp_url_converter->get_lang_from_url_string();

		return $trp_language_switcher->determine_needed_language( $lang_from_url, $trp );
	}
	return null;
}


// Language Slug From Language Code Helper
function the_lang_slug( $lang_code ) {
	$lang_slug = '';
	$underscore_pos = strpos( $lang_code, '_' );
	if ( $underscore_pos !== false ) {
		$lang_slug = strtoupper( substr( $lang_code, 0, $underscore_pos ) );
	}
	echo $lang_slug;
}


// URL for Specified Language Helper
function the_url_for_lang( $lang ) {
	$url = '';
	if ( class_exists( 'TRP_Translate_Press' ) ) {
		$trp = TRP_Translate_Press::get_trp_instance();
		$trp_url_converter = $trp->get_component( 'url_converter' );
		$url = $trp_url_converter->get_url_for_language( $lang );
	}
	echo $url;
}


// Currency Switcher
function abl_currency_switcher( $in_header ) {
	if ( class_exists( 'APBDWooComMultiCurrency' ) ) {
		$active_currency_code = $in_header ? get_active_currency_code() : null;
		$currencies = $in_header ? null : get_woocommerce_currencies();
		?>

        <li class="currency-switcher submenu-wrap">
            <button class="btn-toggle-submenu submenu-title">
                <span><?php echo $in_header ? $active_currency_code : __( 'Currency', 'abl' ); ?></span>
                <svg class="icon feather-icon"><use xlink:href="#icon-chevron-down"></svg>
            </button>
            <ul class="submenu">
				<?php
				foreach ( get_currency_codes() as $code ) {
					if ( ( $in_header && $active_currency_code !== $code ) || ! $in_header ) {
						?>
                        <li>
                            <a href="<?php the_url_for_currency( $code ); ?>">
                                <?php echo $in_header ? $code : $currencies[ $code ] . ' (' . $code . ')'; ?>
                            </a>
                        </li>
						<?php
					}
				}
				?>
            </ul>
        </li>

	<?php }
}


// Currency Codes Helper
function get_currency_codes() {
	if ( class_exists( 'APBDWooComMultiCurrency' ) ) {
		$active_currencies = APBDWooComMultiCurrency::GetInstance()->moduleList[0]->getActiveCurrencies();

		$map_codes = function ( $value ) {
			return $value->code;
		};

		return array_map( $map_codes, $active_currencies );
	}
	return null;
}


// Active Currency Codes Helper
function get_active_currency_code() {
	if ( class_exists( 'APBDWooComMultiCurrency' ) ) {
		return APBDWooComMultiCurrency::GetInstance()->moduleList[0]->active_currency->code;
	}
	return null;
}


// URL for Specified Currency Helper
function the_url_for_currency( $currency ) {
	echo merge_querystring( $_SERVER['REQUEST_URI'], "?_amc-currency=$currency" );
}


// Merge URL Query String Helper
function merge_querystring( $url = null, $query = null, $recursive = false ) {
	if ( $url == null ) return false;
	if ( $query == null ) return $url;

	$url_components = parse_url( $url );

	if ( empty( $url_components[ 'query' ] ) ) return $url.'?'.ltrim($query,'?');

	parse_str($url_components['query'],$original_query_string);
	parse_str(parse_url($query,PHP_URL_QUERY),$merged_query_string);

	if ( $recursive == true )
		$merged_result = array_merge_recursive( $original_query_string, $merged_query_string );
	else
		$merged_result = array_merge( $original_query_string, $merged_query_string );

	return str_replace( $url_components[ 'query' ], http_build_query( $merged_result ), $url );
}


// Temp attempt at solving 503 error issue on woocommerce admin areas
//add_action( 'init', 'stop_heartbeat', 1 );
//function stop_heartbeat() {
//	wp_deregister_script('heartbeat');
//}
