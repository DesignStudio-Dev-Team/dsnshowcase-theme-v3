<?php
/**
 * FAQ landing page (/faqs/), in the layout chosen under Theme Settings →
 * FAQs: Concierge (templates/faq/landing-concierge.php) or Explorer
 * (landing-explorer.php). When a page uses the FAQs template, /faqs/
 * redirects to it (see inc/faq.php).
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;
get_header();
get_template_part( 'templates/faq/landing', dsn_faq_landing_layout() );
get_footer();
