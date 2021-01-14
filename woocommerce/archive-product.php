<?php
/*
 * Product Archive Template
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="site-main site-section-inner">
    <header class="section-header page-header pattern-bg">
        <h2 class="section-title"><?php echo woocommerce_page_title(); ?></h2>
    </header>

    <?php
    global $wp_query;
    abl_products_archive( $wp_query );
    ?>
</main>

<?php get_footer(); ?>
