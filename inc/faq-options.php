<?php
/**
 * FAQs on/off switch (Theme Settings → FAQs → Enable FAQs, inc/acfs.php).
 *
 * Always loaded. While the switch is on it loads the FAQ module
 * (inc/faq.php: the FAQs post type, FAQ pages, shortcode and starter
 * content). While it is off nothing is registered: FAQs leave the admin menu,
 * the FAQ addresses return "not found" and the FAQs page template is hidden.
 * Saved FAQs are kept, so turning the switch back on restores them.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

define( 'DSN_FAQ_PAGE_TEMPLATE', 'template-faqs.php' );
define( 'DSN_FAQ_VERSION', '1.1.0' );

/**
 * Is the FAQ module switched on? Read from the options table, so it is known
 * before ACF loads (post types register on `init`).
 *
 * @return bool
 */
function dsn_faq_enabled() {
	return (bool) get_option( 'options_enable_faqs' );
}

// Rewrite rules change with the switch (and with module updates): flush once
// after each change, once the post type has (or hasn't) registered.
add_action(
	'init',
	function () {
		$flag = dsn_faq_enabled() ? DSN_FAQ_VERSION : 'off';
		if ( get_option( 'dsn_faq_rewrite' ) !== $flag ) {
			flush_rewrite_rules( false );
			update_option( 'dsn_faq_rewrite', $flag );
		}
	},
	99
);

// Contact band form: list the site's Gravity Forms in the setting.
add_filter(
	'acf/load_field/name=faq_form',
	function ( $field ) {
		$field['choices'] = array();
		if ( class_exists( 'GFAPI' ) ) {
			foreach ( GFAPI::get_forms() as $form ) {
				$field['choices'][ (int) $form['id'] ] = $form['title'];
			}
		}
		return $field;
	}
);

// The FAQs page template is only offered while FAQs are on.
add_filter(
	'theme_page_templates',
	function ( $templates ) {
		if ( ! dsn_faq_enabled() ) {
			unset( $templates[ DSN_FAQ_PAGE_TEMPLATE ] );
		}
		return $templates;
	}
);

if ( dsn_faq_enabled() ) {
	require DSN_THEME_DIR . '/inc/faq.php';
}
