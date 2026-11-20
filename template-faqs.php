<?php
/**
 * Template Name: FAQs
 *
 * The FAQ landing page as a page, so its texts are edited in the page editor:
 * the main editor is the intro under the heading, and the "FAQ page" box has
 * the heading, section texts and layout (inc/faq.php). Blank fields keep the
 * layout's own text. The questions themselves come from FAQs in the admin
 * menu. Markup: templates/faq/landing-concierge.php or landing-explorer.php;
 * /faqs/ redirects here (inc/faq.php).
 *
 * With FAQs switched off (Theme Settings → FAQs) the page shows as a normal
 * page.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'dsn_faq_landing_layout' ) ) {
	require get_template_directory() . '/page.php';
	return;
}

get_header();
get_template_part( 'templates/faq/landing', dsn_faq_landing_layout() );
get_footer();
