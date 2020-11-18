<?php
/*
 * Header Custom Language Switcher
 */

if ( class_exists( 'TRP_Translate_Press' ) ) {

	$active_langs = trp_get_languages();
	$current_lang = get_current_lang();
	?>

	<li class="lang-switcher submenu-wrap uppercase-text">
		<button class="btn-toggle-submenu">
			<span><?php the_lang_slug( $current_lang ); ?></span>
			<svg class="icon feather-icon"><use xlink:href="#icon-chevron-down"></svg>
		</button>
		<ul class="submenu">
			<?php
			foreach ($active_langs as $code => $name) {
				if ( $code !== $current_lang ) {
					?>
					<li>
						<a href="<?php the_url_for_lang( $code ); ?>">
							<?php the_lang_slug( $code ); ?>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
	</li>

<?php }