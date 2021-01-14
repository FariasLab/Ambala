<?php
/*
 * Up-sells Products Template
 */

defined( 'ABSPATH' ) || exit;

if ( $upsells ) {
	?>
	<section class="up-sells products-carousel-wrap">
		<h2 class="product-section-title"><?php _e( 'You may also like&hellip;', 'abl' ); ?></h2>
		<div class="products-carousel swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ( $upsells as $product ) { ?>
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
