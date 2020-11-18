<?php
/*
 * Default Template
 */

get_header();
?>

<main class="site-main site-section-inner">
    <?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            the_content();
        }
    }
    ?>
</main>

<?php get_footer();