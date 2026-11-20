<?php
/**
 * Helpers for the FAQ module (inc/faq.php): the parts of the DesignStudio v4
 * theme the FAQ templates rely on, rebuilt for this theme — settings, icons,
 * section headings, the "Ask our team" button, the contact band form, the
 * Sections list for a single FAQ and the author structured data.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

// ── Settings ──────────────────────────────────────────────────────────────────

/**
 * Landing page layouts (Theme Settings → FAQs → Landing page layout).
 *
 * @return array Key => label.
 */
function dsn_faq_layouts() {
	return array(
		'concierge' => __( 'Concierge: guided answer finder', 'dsnshowcase' ),
		'explorer'  => __( 'Explorer: instant search', 'dsnshowcase' ),
	);
}

/**
 * A setting from Theme Settings → FAQs (ACF option `faq_<key>`).
 *
 * Read straight from the options table (ACF saves options page fields as
 * `options_<name>`), so it also works before ACF has loaded.
 *
 * @param string $key     Setting key without the `faq_` prefix: layout,
 *                        phone, hours, address, form, contact, show_author.
 * @param mixed  $default Value when the setting has never been saved.
 * @return mixed
 */
function dsn_faq_opt( $key, $default = '' ) {
	$value = get_option( 'options_faq_' . $key, null );
	if ( 'contact' === $key && function_exists( 'get_field' ) ) {
		$value = get_field( 'faq_contact', 'option' ); // Link field: array( url, title, target ).
	}
	return null === $value || false === $value ? $default : $value;
}

/**
 * Phone link for tel: hrefs.
 *
 * @param string|null $phone Phone (defaults to the FAQ phone setting).
 * @return string
 */
function dsn_faq_tel( $phone = null ) {
	$phone = null === $phone ? dsn_faq_opt( 'phone' ) : $phone;
	return 'tel:' . preg_replace( '/[^0-9+]/', '', (string) $phone );
}

/**
 * Google Maps link for the showroom address (Explorer layout).
 *
 * @return string
 */
function dsn_faq_map_url() {
	$addr = trim( (string) dsn_faq_opt( 'address' ) );
	return $addr ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $addr ) : '#';
}

// ── Terms (WPML-safe) ─────────────────────────────────────────────────────────

/**
 * A FAQ category by its default-language slug, in the current language.
 * Without WPML the filters return their first argument.
 *
 * @param string $slug     Default-language slug.
 * @param string $taxonomy Taxonomy.
 * @return WP_Term|null
 */
function dsn_faq_term( $slug, $taxonomy ) {
	static $cache = array();
	$key = $taxonomy . '|' . $slug . '|' . apply_filters( 'wpml_current_language', '' );
	if ( ! array_key_exists( $key, $cache ) ) {
		$term = get_term_by( 'slug', $slug, $taxonomy );
		if ( $term && ! is_wp_error( $term ) ) {
			$id   = (int) apply_filters( 'wpml_object_id', $term->term_id, $taxonomy, true );
			$term = $id === (int) $term->term_id ? $term : get_term( $id, $taxonomy );
		}
		$cache[ $key ] = ( $term && ! is_wp_error( $term ) ) ? $term : null;
	}
	return $cache[ $key ];
}

/**
 * Default-language slug of a term (icons are picked by it in every language).
 *
 * @param WP_Term $term Term.
 * @return string
 */
function dsn_faq_term_slug( $term ) {
	$default = apply_filters( 'wpml_default_language', '' );
	if ( ! $default ) {
		return $term->slug;
	}
	$id = (int) apply_filters( 'wpml_object_id', $term->term_id, $term->taxonomy, true, $default );
	if ( $id === (int) $term->term_id ) {
		return $term->slug;
	}
	$orig = get_term( $id, $term->taxonomy );
	return $orig && ! is_wp_error( $orig ) ? $orig->slug : $term->slug;
}

// ── Icons ─────────────────────────────────────────────────────────────────────

/**
 * Inline SVG icon (24×24 stroke icons, the same set as the v4 theme).
 *
 * @param string $name  Icon name.
 * @param string $class CSS classes.
 * @param float  $width Stroke width.
 * @return string SVG markup ('' for an unknown icon).
 */
function dsn_faq_svg( $name, $class = 'dsn:h-5 dsn:w-5', $width = 1.75 ) {
	$paths = array(
		'arrow'      => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'arrow-down' => '<path d="M12 5v14M19 12l-7 7-7-7"/>',
		'arrow-l'    => '<path d="M19 12H5M11 18l-6-6 6-6"/>',
		'arrow-up'   => '<path d="M12 19V5M5 12l7-7 7 7"/>',
		'clock'      => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
		'grid'       => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
		'link'       => '<path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.7"/><path d="M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.7"/>',
		'mail'       => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
		'phone'      => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/>',
		'plus'       => '<path d="M12 5v14M5 12h14"/>',
		'search'     => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
		'share'      => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/>',
		'sparkle'    => '<path d="M12 3 13.9 8.1 19 10l-5.1 1.9L12 17l-1.9-5.1L5 10l5.1-1.9Z"/><path d="M5 3v4M3 5h4M19 17v4M17 19h4"/>',
		'users'      => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/>',
		'droplet'    => '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5S5 13 5 15a7 7 0 0 0 7 7Z"/>',
		'waves'      => '<path d="M2 7c1.7 0 1.7-1.5 3.3-1.5S7 7 8.7 7s1.6-1.5 3.3-1.5S13.7 7 15.3 7 17 5.5 18.7 5.5 20.3 7 22 7"/><path d="M2 12.5c1.7 0 1.7-1.5 3.3-1.5S7 12.5 8.7 12.5s1.6-1.5 3.3-1.5 1.7 1.5 3.3 1.5S17 11 18.7 11s1.6 1.5 3.3 1.5"/><path d="M2 18c1.7 0 1.7-1.5 3.3-1.5S7 18 8.7 18s1.6-1.5 3.3-1.5S13.7 18 15.3 18 17 16.5 18.7 16.5 20.3 18 22 18"/>',
		'flame'      => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.4-.5-2-1-3-1.1-2.1-.2-4 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.2.4-2.3 1-3.3.4 1.4 1.3 2.5 2.5 2.8Z"/>',
		'snow'       => '<path d="M2 12h20M12 2v20M20 16l-4-4 4-4M4 8l4 4-4 4M16 4l-4 4-4-4M8 20l4-4 4 4"/>',
		'dollar'     => '<path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
		'truck'      => '<path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.6a1 1 0 0 0-.2-.6l-3.5-4.4A1 1 0 0 0 17.5 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>',
		'shield'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/>',
		'leaf'       => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10Z"/><path d="M2 21c0-3 1.9-5.4 5.1-6"/>',
		'wrench'     => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.8-3.8a6 6 0 0 1-7.9 7.9l-6.9 6.9a2.1 2.1 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.9-7.9Z"/>',
		'pin'        => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="' . esc_attr( $class ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . esc_attr( $width ) . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}

/**
 * Echo an inline SVG icon.
 *
 * @param string $name  Icon name.
 * @param string $class CSS classes.
 * @param float  $width Stroke width.
 */
function dsn_faq_the_icon( $name, $class = 'dsn:h-5 dsn:w-5', $width = 1.75 ) {
	echo dsn_faq_svg( $name, $class, $width ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

// ── Markup helpers ────────────────────────────────────────────────────────────

/**
 * Section heading block.
 *
 * @param string $eyebrow Eyebrow.
 * @param string $title   Title.
 * @param string $text    Intro.
 * @param string $align   'center' | 'left'.
 * @param bool   $dark    Dark background.
 */
function dsn_faq_section_heading( $eyebrow, $title, $text = '', $align = 'center', $dark = false ) {
	$wrap = 'center' === $align ? 'dsn:mx-auto dsn:max-w-2xl dsn:text-center' : 'dsn:max-w-2xl';
	echo '<div class="' . esc_attr( $wrap ) . '">';
	if ( $eyebrow ) {
		echo '<p class="faq-eyebrow ' . ( $dark ? 'dsn:text-faq-accent' : 'dsn:text-faq-primary' ) . '">' . esc_html( $eyebrow ) . '</p>';
	}
	echo '<h2 class="dsn:mt-3 dsn:font-faq-display dsn:text-3xl dsn:leading-tight dsn:tracking-tight dsn:sm:text-4xl dsn:lg:text-5xl ' . ( $dark ? 'dsn:text-white' : 'dsn:text-faq-ink' ) . '">' . esc_html( $title ) . '</h2>';
	if ( $text ) {
		echo '<p class="dsn:mt-4 dsn:text-lg dsn:leading-relaxed ' . ( $dark ? 'dsn:text-white/70' : 'dsn:text-faq-ink/65' ) . '">' . esc_html( $text ) . '</p>';
	}
	echo '</div>';
}

/**
 * Where "Ask our team" goes: the contact band (#faq-ask) on FAQ pages, which
 * holds the form; elsewhere (the [dsn_faqs] shortcode) the contact page set
 * under Theme Settings → FAQs, else the FAQ page's contact band.
 *
 * @return string URL.
 */
function dsn_faq_ask_url() {
	if ( dsn_is_faq_page() ) {
		return '#faq-ask';
	}
	$contact = dsn_faq_opt( 'contact' );
	if ( is_array( $contact ) && ! empty( $contact['url'] ) ) {
		return $contact['url'];
	}
	return get_post_type_archive_link( DSN_FAQ_CPT ) . '#faq-ask';
}

/**
 * "Ask our team" button (the v4 theme's quote button opened a drawer; here
 * it links to the contact band).
 *
 * @param string $label   Button text.
 * @param string $classes CSS classes.
 * @param array  $data    Unused here (kept for parity with the v4 templates).
 * @return string Escaped HTML.
 */
function dsn_faq_ask_button( $label, $classes = 'faq-btn faq-btn-accent', $data = array() ) {
	unset( $data );
	return '<a href="' . esc_url( dsn_faq_ask_url() ) . '" class="' . esc_attr( $classes ) . '" data-faq-ask>' . esc_html( $label ) . '</a>';
}

/**
 * The form in the contact band: the Gravity Form chosen under Theme Settings
 * → FAQs; without one, a button to the contact page (or nothing).
 *
 * @param array $args Unused (kept for parity with the v4 templates).
 */
function dsn_faq_form( $args = array() ) {
	unset( $args );
	$form = (int) dsn_faq_opt( 'form' );
	if ( $form && function_exists( 'gravity_form' ) ) {
		gravity_form( $form, false, false, false, null, true );
		return;
	}
	$contact = dsn_faq_opt( 'contact' );
	if ( is_array( $contact ) && ! empty( $contact['url'] ) ) {
		echo '<p class="dsn:text-lg dsn:text-faq-ink/70">' . esc_html__( 'Send us your question and we’ll get right back to you.', 'dsnshowcase' ) . '</p>';
		echo '<p class="dsn:mt-5"><a class="faq-btn faq-btn-accent" href="' . esc_url( $contact['url'] ) . '"' . ( ! empty( $contact['target'] ) ? ' target="_blank" rel="noopener"' : '' ) . '>' . esc_html( ! empty( $contact['title'] ) ? $contact['title'] : __( 'Contact us', 'dsnshowcase' ) ) . '</a></p>';
		return;
	}
	if ( current_user_can( 'manage_options' ) ) {
		echo '<p class="dsn:text-faq-ink/70">' . esc_html__( 'Choose a contact form under Theme Settings → FAQs to show it here (only admins see this note).', 'dsnshowcase' ) . '</p>';
	}
}

// ── Single FAQ ────────────────────────────────────────────────────────────────

/**
 * Give every H2 in the rendered content an ID and collect them, for the
 * Sections list on a single FAQ (links work without JavaScript).
 *
 * @param string $html Rendered content.
 * @return array{html:string,items:array[]} Content with IDs, and items (id, text).
 */
function dsn_faq_toc_build( $html ) {
	$items = array();
	$used  = array();
	$html  = preg_replace_callback(
		'/<h2(\s[^>]*)?>(.*?)<\/h2>/is',
		function ( $m ) use ( &$items, &$used ) {
			$attrs = isset( $m[1] ) ? $m[1] : '';
			$text  = trim( html_entity_decode( wp_strip_all_tags( $m[2] ), ENT_QUOTES, 'UTF-8' ) );
			if ( '' === $text ) {
				return $m[0];
			}
			if ( preg_match( '/\sid=(["\'])(.*?)\1/i', $attrs, $idm ) ) {
				$id = $idm[2];
			} else {
				$base = sanitize_title( $text );
				$base = '' !== $base ? $base : 'section-' . ( count( $items ) + 1 );
				$id   = $base;
				for ( $n = 2; in_array( $id, $used, true ); $n++ ) {
					$id = $base . '-' . $n;
				}
				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}
			$used[]  = $id;
			$items[] = array(
				'id'   => $id,
				'text' => $text,
			);
			return '<h2' . $attrs . '>' . $m[2] . '</h2>';
		},
		$html
	);
	return array(
		'html'  => $html,
		'items' => $items,
	);
}

/**
 * Keep the last two words of every paragraph together, so a paragraph never
 * ends with one word alone on its last line.
 *
 * @param string $html Rendered content.
 * @return string
 */
function dsn_faq_no_widows( $html ) {
	return preg_replace( '/(\S+)[ \t]+([^\s<>&]+)([ \t]*)<\/p>/u', '$1&nbsp;$2$3</p>', $html );
}

/**
 * Reading time in minutes (200 words a minute, at least 1).
 *
 * @param int $post_id Post (default: current).
 * @return int
 */
function dsn_faq_reading_time( $post_id = 0 ) {
	$words = str_word_count( wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ? $post_id : get_the_ID() ) ) );
	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Person structured data for an FAQ's author.
 *
 * @param int $user_id User ID.
 * @return array Empty when the user doesn't exist.
 */
function dsn_faq_author_schema( $user_id ) {
	$user = get_userdata( $user_id );
	if ( ! $user ) {
		return array();
	}
	$person = array(
		'@type'    => 'Person',
		'name'     => $user->display_name,
		'url'      => get_author_posts_url( $user->ID ),
		'worksFor' => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url( '/' ),
		),
	);
	if ( $user->description ) {
		$person['description'] = wp_strip_all_tags( $user->description );
	}
	return $person;
}
