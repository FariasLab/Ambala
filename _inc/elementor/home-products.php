<?php // Home Products Elementor Widget

namespace Elementor;

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
                    <p class="section-tagline">Browse Our Collection</p>
                    <h2 class="section-title">Our Products</h2>
                </header>
				<div class="products-archive">
					<ul class="archives-list side-list">
						<?php
						$abl_locations = array( 'collections', 'product_cat', 'brands' );
						$locations_data = get_nav_menu_locations();

						foreach ( $abl_locations as $location ) {
							abl_submenu_at( $location, $locations_data, false );
						}
						?>
					</ul>
					<div class="products-grid">
                        <div class="product-item empty-notice">
                            <p>No products found in this section at the moment.</p>
                        </div>
						<?php /* for ( $i = 0; $i < 9; $i++ ) { ?>
							<div class="product-item">
								<a href="#" class="img-link">
                                    <p class="img-hover">View Product</p>
                                </a>
								<div class="product-details">
                                    <a href="#" class="name-link">Product Name</a>
                                    <p class="product-price">$ 20.00 USD</p>
                                </div>
							</div>
						<?php } //*/ ?>
					</div>
				</div>
			</div>
		</section>

	<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new ABL_Home_Products() );