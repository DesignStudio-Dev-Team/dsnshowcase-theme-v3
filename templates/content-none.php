<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dsShowcase Theme
 */

?>

<style>
	#searchform input[type="search"]::-webkit-search-decoration,
	#searchform input[type="search"]::-webkit-search-cancel-button,
	#searchform input[type="search"]::-webkit-search-results-button,
	#searchform input[type="search"]::-webkit-search-results-decoration {
		-webkit-appearance: none;
	}

	.error-search-content .searchform {
		width: 424px;
		max-width: 100%;
		font-size: 30px;
		border: 1px #ccc solid;
		padding: 4px;
		padding-left: 20px;
		margin: 5px;
	}

	.nav-links {
		height: 40px;
		text-align: center;
	}

	.nav-links .page-numbers {
		padding-left: 3px;
		padding-right: 3px;
	}

	.nav-links a {
		color: var(--dsw-main-dealer-color);
	}

	.nav-links a:hover {
		color: var(--dsw-main-dealer-hover);
	}

	.nav-links .nav-previous {
		float: right;
	}

	.nav-links .nav-next {
		float: left;
	}
</style>

<section class="no-results not-found">
	<header class="page-header">
		<h3 class="page-title text-center mt-8"><?php esc_html_e('Nothing Found', 'dsShowcase'); ?></h3>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if (is_home() && current_user_can('publish_posts')) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'dsShowcase'),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url(admin_url('post-new.php'))
				);
				?></p>

		<?php elseif (is_search()) : ?>

			<p class="text-xl md:text-2xl text-center mt-5"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dsShowcase'); ?></p>

			<div class="error-search-content grid place-items-center my-10">
				<div>
					<?php get_search_form(); ?>
				</div>
			</div>

		<?php

		else : ?>

			<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dsShowcase'); ?></p>
		<?php
			get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->