<?php
/*
 * Search Form
 */
?>

<form class="search-form" role="search" method="get" action="<?php echo home_url(); ?>">
    <input class="search-input" type="text" value="<?php echo get_search_query(); ?>" placeholder="Search" name="s" autocomplete="off">
    <button type="submit" class="btn-submit-search">
        <svg class="feather-icon"><use xlink:href="#icon-search"></svg>
    </button>
</form>
