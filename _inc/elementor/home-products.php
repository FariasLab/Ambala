<?php // Home Products Elementor Widget

namespace Elementor;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class ABL_Home_Products extends Widget_Base
{

	public function get_name() {
		return 'abl_home_products';
	}

	public function get_title() {
		return __('Home Products', 'abl');
	}

	public function get_icon() {
		return 'abl-widget-icon';
	}

	public function get_categories() {
		return ['abl_home_page'];
	}

	protected function _register_controls() {
		// some controls here later
	}

	protected function render() {
		?>

		<section class="abl-home-products">
			<div class="site-section-inner">
				<header class="section-header">
                    <p class="section-tagline">Browse Our Collections</p>
                    <h2 class="section-title">Our Products</h2>
                </header>

				<?php
				//$meta_query  = WC()->query->get_meta_query();
				//$tax_query   = WC()->query->get_tax_query();
                $products_query = new WP_Query( array(
					'post_type' => 'product',
					'posts_per_page' => 9,
					'order' => 'ASC',
                    'orderby' => 'name',
					//'meta_query' => $meta_query,
					//'tax_query' => $tax_query,
				) );
				abl_products_archive( $products_query );
				?>
			</div>
		</section>

	<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new ABL_Home_Products() );