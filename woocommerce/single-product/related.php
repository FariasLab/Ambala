<?php
/*
 * Related Products Template
 */

defined( 'ABSPATH' ) || exit;

if ( $related_products ) {
	?>
	<section class="related-products products-carousel-wrap">
		<h2 class="product-section-title"><?php _e( 'Related Products', 'abl' ); ?></h2>
		<div class="products-carousel swiper-container">
            <div class="swiper-wrapper">
	            <?php foreach ( $related_products as $product ) { ?>
                    <div class="swiper-slide">
                        <?php abl_content_product( $product, 'div' ); ?>
                    </div>
                <?php } ?>
            </div>
		</div>
	</section>
	<?php
}

wp_reset_postdata();
