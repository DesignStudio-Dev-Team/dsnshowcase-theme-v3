<?php
/**
 * FAQs: custom post type, categories, short/long answers, front-end assets,
 * FAQPage structured data, a shortcode and starter content.
 *
 * Every FAQ has:
 *  - the Title     = the question
 *  - Quick answer  = a meta box (one or two sentences, shown first)
 *  - Answer        = the main editor (post content), shown on the FAQ's own
 *                    page; the expanders show only the quick answer.
 *
 * Categories are two levels: product lines at the top (Hot Tubs, Swim Spas,
 * Saunas, Cold Plunge…) with topics under them (Buyer, Installation…), plus
 * the top-level `company` category for the dealer's own questions.
 *
 * Loaded by inc/faq-options.php only while Theme Settings → FAQs → Enable
 * FAQs is on. Ported from the DesignStudio v4 theme: the post type, taxonomy,
 * meta keys and starter content are the same, so FAQs carry over between the
 * two themes. Helpers it needs (icons, buttons, contact band…) are in
 * inc/faq-helpers.php; styles in assets/css/faq.css.
 *
 * Front end, all built from templates/faq/*:
 *  - template-faqs.php              the FAQs page (its texts are edited in the
 *                                   page editor); /faqs/ redirects to it
 *  - archive-dsn_faq.php            /faqs/ when there is no FAQs page
 *    (both in the Explorer or Concierge layout, templates/faq/landing-*)
 *  - taxonomy-dsn_faq_category.php  a product line (FAQs grouped by topic) or
 *                                   one topic
 *  - single-dsn_faq.php             one FAQ, with Sections and the author
 *  - the [dsn_faqs] shortcode ([dns_v4_faqs] works too)
 *
 * Expanders are native <details> elements, so every answer is in the HTML and
 * opens without JavaScript; assets/js/faq.js only adds live search, expand
 * all and #faq-123 deep links.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

define( 'DSN_FAQ_CPT', 'dsn_faq' );
define( 'DSN_FAQ_TAX', 'dsn_faq_category' );
define( 'DSN_FAQ_SHORT_META', '_dsn_faq_short' );
define( 'DSN_FAQ_HIDE_AUTHOR_META', '_dns_v4_faq_hide_author' );
define( 'DSN_FAQ_COMPANY', 'company' );

require DSN_THEME_DIR . '/inc/faq-helpers.php';

/**
 * Register the post type, its category taxonomy and the short-answer meta.
 */
function dsn_faq_register() {
	register_post_type(
		DSN_FAQ_CPT,
		array(
			'labels'        => array(
				'name'               => __( 'FAQs', 'dsnshowcase' ),
				'singular_name'      => __( 'FAQ', 'dsnshowcase' ),
				'add_new_item'       => __( 'Add New FAQ', 'dsnshowcase' ),
				'edit_item'          => __( 'Edit FAQ', 'dsnshowcase' ),
				'new_item'           => __( 'New FAQ', 'dsnshowcase' ),
				'view_item'          => __( 'View FAQ', 'dsnshowcase' ),
				'search_items'       => __( 'Search FAQs', 'dsnshowcase' ),
				'not_found'          => __( 'No FAQs found.', 'dsnshowcase' ),
				'not_found_in_trash' => __( 'No FAQs found in Trash.', 'dsnshowcase' ),
				'all_items'          => __( 'All FAQs', 'dsnshowcase' ),
				'menu_name'          => __( 'FAQs', 'dsnshowcase' ),
			),
			'public'        => true,
			'has_archive'   => 'faqs',
			// /faqs/hot-tubs/buyer/<faq>/: the path of the FAQ's category
			// (dsn_faq_permalink()). The same addresses as a category page
			// are told apart in dsn_faq_resolve_request().
			'rewrite'       => array(
				'slug'       => 'faqs/%' . DSN_FAQ_TAX . '%',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-editor-help',
			'menu_position' => 21,
			'supports'      => array( 'title', 'editor', 'author', 'page-attributes', 'revisions' ),
			'show_in_rest'  => true,
		)
	);

	register_taxonomy(
		DSN_FAQ_TAX,
		DSN_FAQ_CPT,
		array(
			'labels'            => array(
				'name'          => __( 'FAQ Categories', 'dsnshowcase' ),
				'singular_name' => __( 'FAQ Category', 'dsnshowcase' ),
				'add_new_item'  => __( 'Add New FAQ Category', 'dsnshowcase' ),
				'edit_item'     => __( 'Edit FAQ Category', 'dsnshowcase' ),
				'search_items'  => __( 'Search FAQ Categories', 'dsnshowcase' ),
				'all_items'     => __( 'All FAQ Categories', 'dsnshowcase' ),
				'menu_name'     => __( 'FAQ Categories', 'dsnshowcase' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			// /faqs/hot-tubs/ and /faqs/hot-tubs/buyer/ (parents in the path).
			// The /faqs/ archive (and its /page/ and /feed/ rules) are
			// registered first, so they still win.
			'rewrite'           => array(
				'slug'         => 'faqs',
				'with_front'   => false,
				'hierarchical' => true,
			),
		)
	);

	// Old addresses still resolve, then redirect (dsn_faq_redirect_old()):
	// /faqs/category/<slug>/ and /faq/<faq>/.
	add_rewrite_rule( '^faqs/category/([^/]+)/?$', 'index.php?' . DSN_FAQ_TAX . '=$matches[1]&dsn_faq_old=1', 'top' );
	add_rewrite_rule( '^faq/([^/]+)/?$', 'index.php?' . DSN_FAQ_CPT . '=$matches[1]&dsn_faq_old=1', 'top' );

	register_post_meta(
		DSN_FAQ_CPT,
		DSN_FAQ_SHORT_META,
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_textarea_field',
			'auth_callback'     => function () {
				return current_user_can( 'edit_posts' );
			},
		)
	);

	// Rewrite rules are flushed when FAQs are switched on or off (inc/faq-options.php).
}
add_action( 'init', 'dsn_faq_register' );

add_filter(
	'query_vars',
	function ( $vars ) {
		$vars[] = 'dsn_faq_old';
		return $vars;
	}
);

// ── Permalinks ────────────────────────────────────────────────────────────────

/**
 * The category a FAQ's address is built from: its deepest category (a
 * topic before its product line), the first one created on a tie.
 *
 * @param WP_Post $post FAQ.
 * @return WP_Term|null
 */
function dsn_faq_permalink_term( $post ) {
	$best  = null;
	$depth = -1;
	foreach ( (array) get_the_terms( $post, DSN_FAQ_TAX ) as $term ) {
		if ( ! $term instanceof WP_Term ) {
			continue;
		}
		$d = count( get_ancestors( $term->term_id, DSN_FAQ_TAX, 'taxonomy' ) );
		if ( $d > $depth || ( $d === $depth && $term->term_id < $best->term_id ) ) {
			$best  = $term;
			$depth = $d;
		}
	}
	return $best;
}

/**
 * A category's path: its parents' slugs and its own (hot-tubs/buyer).
 *
 * @param WP_Term $term Category.
 * @return string
 */
function dsn_faq_term_path( $term ) {
	$slugs = array( $term->slug );
	foreach ( get_ancestors( $term->term_id, DSN_FAQ_TAX, 'taxonomy' ) as $id ) {
		$parent = get_term( $id, DSN_FAQ_TAX );
		if ( $parent && ! is_wp_error( $parent ) ) {
			array_unshift( $slugs, $parent->slug );
		}
	}
	return implode( '/', $slugs );
}

/**
 * The category at a path (hot-tubs/buyer), each slug a child of the one
 * before it.
 *
 * @param string $path Slugs separated by /.
 * @return WP_Term|null
 */
function dsn_faq_term_by_path( $path ) {
	$parent = 0;
	$term   = null;
	foreach ( array_filter( explode( '/', $path ) ) as $slug ) {
		$found = get_terms(
			array(
				'taxonomy'   => DSN_FAQ_TAX,
				'slug'       => sanitize_title( $slug ),
				'parent'     => $parent,
				'hide_empty' => false,
				'number'     => 1,
			)
		);
		if ( is_wp_error( $found ) || ! $found ) {
			return null;
		}
		$term   = $found[0];
		$parent = (int) $term->term_id;
	}
	return $term;
}

/**
 * FAQ addresses follow their category: /faqs/hot-tubs/buyer/<faq>/. A FAQ
 * without a category gets /faqs/general/<faq>/.
 *
 * @param string  $link Permalink with the %dsn_faq_category% tag.
 * @param WP_Post $post FAQ.
 * @return string
 */
function dsn_faq_permalink( $link, $post ) {
	if ( DSN_FAQ_CPT !== $post->post_type || false === strpos( $link, '%' . DSN_FAQ_TAX . '%' ) ) {
		return $link;
	}
	$term = dsn_faq_permalink_term( $post );
	return str_replace( '%' . DSN_FAQ_TAX . '%', $term ? dsn_faq_term_path( $term ) : 'general', $link );
}
add_filter( 'post_type_link', 'dsn_faq_permalink', 10, 2 );

/**
 * /faqs/<a>/<b>/ matches both a FAQ (category <a>, FAQ <b>) and a topic
 * (<b> under <a>). WordPress tries the FAQ rule first; when the whole path
 * is a category, show the category page instead.
 *
 * @param array $vars Query vars of the matched rule.
 * @return array
 */
function dsn_faq_resolve_request( $vars ) {
	if ( empty( $vars[ DSN_FAQ_CPT ] ) || empty( $vars[ DSN_FAQ_TAX ] ) || ! empty( $vars['dsn_faq_old'] ) ) {
		return $vars;
	}
	$path = trim( $vars[ DSN_FAQ_TAX ], '/' ) . '/' . $vars[ DSN_FAQ_CPT ];
	if ( dsn_faq_term_by_path( $path ) ) {
		$vars[ DSN_FAQ_TAX ] = $path;
		unset( $vars[ DSN_FAQ_CPT ], $vars['post_type'], $vars['name'], $vars['page'] );
	}
	return $vars;
}
add_filter( 'request', 'dsn_faq_resolve_request' );

/**
 * Send old and non-canonical FAQ addresses to the current one with a 301,
 * keeping a search (?q=): /faq/<faq>/ (before FAQs followed their category),
 * /faqs/category/<slug>/ and /faqs/<topic>/ (before topics had their
 * product line in the path), and a FAQ reached through a wrong category path.
 */
function dsn_faq_redirect_old() {
	global $wp;
	// Plain ?p= / ?dsn_faq= links and previews are left to WordPress.
	if ( is_preview() || ! ( is_tax( DSN_FAQ_TAX ) || is_singular( DSN_FAQ_CPT ) ) || '' === (string) $wp->request || empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}
	$link = is_singular( DSN_FAQ_CPT ) ? get_permalink() : get_term_link( get_queried_object() );
	if ( ! $link || is_wp_error( $link ) ) {
		return;
	}
	$want = untrailingslashit( rawurldecode( (string) wp_parse_url( $link, PHP_URL_PATH ) ) );
	$have = untrailingslashit( rawurldecode( (string) wp_parse_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH ) ) );
	if ( $want === $have ) {
		return;
	}
	wp_safe_redirect( add_query_arg( array_filter( array( 'q' => rawurlencode( dsn_faq_query() ) ) ), $link ), 301 );
	exit;
}
add_action( 'template_redirect', 'dsn_faq_redirect_old' );

/**
 * Archive and category pages list every FAQ on one page (grouped and
 * filtered client-side), in the order set by Order, then title.
 *
 * @param WP_Query $query The query.
 */
function dsn_faq_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( DSN_FAQ_CPT ) || $query->is_tax( DSN_FAQ_TAX ) ) {
		$query->set( 'posts_per_page', -1 );
		$query->set( 'nopaging', true );
		$query->set(
			'orderby',
			array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			)
		);
		$query->set( 'no_found_rows', true );
	}
}
add_action( 'pre_get_posts', 'dsn_faq_pre_get_posts' );

// ── Admin ─────────────────────────────────────────────────────────────────────

add_action(
	'add_meta_boxes',
	function () {
		add_meta_box( 'dsn_faq_short', __( 'Quick answer', 'dsnshowcase' ), 'dsn_faq_render_meta_box', DSN_FAQ_CPT, 'normal', 'high' );
	}
);

/**
 * Render the Quick answer box (and the author switch).
 *
 * @param WP_Post $post Current FAQ.
 */
function dsn_faq_render_meta_box( $post ) {
	wp_nonce_field( 'dsn_faq_short', 'dsn_faq_nonce' );
	?>
	<p class="description" style="margin-top:0"><?php esc_html_e( 'A one or two sentence answer, shown in the expanders on the FAQ pages. Write the full answer in the main editor below: it appears on this FAQ’s own page, where each H2 heading becomes a link in the Sections list.', 'dsnshowcase' ); ?></p>
	<textarea name="dsn_faq_short" rows="3" style="width:100%" maxlength="400"><?php echo esc_textarea( get_post_meta( $post->ID, DSN_FAQ_SHORT_META, true ) ); ?></textarea>
	<p><label><input type="checkbox" name="dsn_faq_hide_author" value="1" <?php checked( '1', get_post_meta( $post->ID, DSN_FAQ_HIDE_AUTHOR_META, true ) ); ?>> <?php esc_html_e( 'Hide the author on this FAQ (for generic answers that aren’t written by your team)', 'dsnshowcase' ); ?></label></p>
	<?php
}

add_action(
	'save_post_' . DSN_FAQ_CPT,
	function ( $post_id ) {
		if ( ! isset( $_POST['dsn_faq_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dsn_faq_nonce'] ), 'dsn_faq_short' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$short = isset( $_POST['dsn_faq_short'] ) ? sanitize_textarea_field( wp_unslash( $_POST['dsn_faq_short'] ) ) : '';
		update_post_meta( $post_id, DSN_FAQ_SHORT_META, $short );
		update_post_meta( $post_id, DSN_FAQ_HIDE_AUTHOR_META, empty( $_POST['dsn_faq_hide_author'] ) ? '' : '1' );
	}
);

add_filter(
	'manage_' . DSN_FAQ_CPT . '_posts_columns',
	function ( $cols ) {
		$out = array();
		foreach ( $cols as $key => $label ) {
			$out[ $key ] = $label;
			if ( 'title' === $key ) {
				$out['dsn_faq_short'] = __( 'Quick answer', 'dsnshowcase' );
				$out['dsn_faq_long']  = __( 'Answer', 'dsnshowcase' );
			}
		}
		return $out;
	}
);

add_action(
	'manage_' . DSN_FAQ_CPT . '_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'dsn_faq_short' === $col ) {
			echo esc_html( wp_trim_words( get_post_meta( $post_id, DSN_FAQ_SHORT_META, true ), 18 ) );
		} elseif ( 'dsn_faq_long' === $col ) {
			$words = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
			/* translators: %d: word count */
			echo $words ? esc_html( sprintf( __( 'Yes (%d words)', 'dsnshowcase' ), $words ) ) : '&mdash;';
		}
	},
	10,
	2
);

/**
 * Fields of the "FAQ page" box on a page using the FAQs template (saved as
 * `_dns_v4_faq_<key>`, the same keys as the v4 theme). Blank keeps the
 * layout's own text.
 *
 * @return array Key => array( type, label ).
 */
function dsn_faq_page_fields() {
	return array(
		'layout'          => array( 'select', __( 'Layout', 'dsnshowcase' ) ),
		'eyebrow'         => array( 'text', __( 'Eyebrow (small text above the heading)', 'dsnshowcase' ) ),
		'title'           => array( 'text', __( 'Heading (the main editor is the intro text under it)', 'dsnshowcase' ) ),
		'lines_eyebrow'   => array( 'text', __( 'Products section: eyebrow', 'dsnshowcase' ) ),
		'lines_title'     => array( 'text', __( 'Products section: heading', 'dsnshowcase' ) ),
		'lines_text'      => array( 'textarea', __( 'Products section: text', 'dsnshowcase' ) ),
		'company_eyebrow' => array( 'text', __( 'Company questions: eyebrow', 'dsnshowcase' ) ),
		'company_title'   => array( 'text', __( 'Company questions: heading', 'dsnshowcase' ) ),
		'company_text'    => array( 'textarea', __( 'Company questions: text', 'dsnshowcase' ) ),
		'cta_eyebrow'     => array( 'text', __( 'Contact band at the bottom: eyebrow (shown on every FAQ page)', 'dsnshowcase' ) ),
		'cta_title'       => array( 'text', __( 'Contact band: heading', 'dsnshowcase' ) ),
		'cta_text'        => array( 'textarea', __( 'Contact band: text', 'dsnshowcase' ) ),
	);
}

add_action(
	'add_meta_boxes_page',
	function ( $post ) {
		if ( DSN_FAQ_PAGE_TEMPLATE === get_page_template_slug( $post ) ) {
			add_meta_box( 'dsn_faq_page', __( 'FAQ page', 'dsnshowcase' ), 'dsn_faq_render_page_box', 'page', 'normal', 'high' );
		}
	}
);

/**
 * Render the "FAQ page" box.
 *
 * @param WP_Post $post Page.
 */
function dsn_faq_render_page_box( $post ) {
	wp_nonce_field( 'dsn_faq_page', 'dsn_faq_page_nonce' );
	echo '<p class="description">' . esc_html__( 'Texts of the FAQ landing page. Leave a field empty to keep the layout’s own text. The questions are edited under FAQs in the admin menu.', 'dsnshowcase' ) . '</p>';
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( dsn_faq_page_fields() as $key => $field ) {
		$name  = 'dsn_faq_page_' . $key;
		$value = (string) get_post_meta( $post->ID, '_dns_v4_faq_' . $key, true );
		echo '<tr><th scope="row"><label for="' . esc_attr( $name ) . '">' . esc_html( $field[1] ) . '</label></th><td>';
		if ( 'select' === $field[0] ) {
			echo '<select id="' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '">';
			echo '<option value="">' . esc_html__( 'Site setting (Theme Settings → FAQs)', 'dsnshowcase' ) . '</option>';
			foreach ( dsn_faq_layouts() as $choice => $label ) {
				echo '<option value="' . esc_attr( $choice ) . '"' . selected( $value, $choice, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select>';
		} elseif ( 'textarea' === $field[0] ) {
			echo '<textarea id="' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '" rows="3" class="large-text">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input type="text" id="' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" class="large-text">';
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

add_action(
	'save_post_page',
	function ( $post_id ) {
		if ( ! isset( $_POST['dsn_faq_page_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dsn_faq_page_nonce'] ), 'dsn_faq_page' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		foreach ( dsn_faq_page_fields() as $key => $field ) {
			$raw   = isset( $_POST[ 'dsn_faq_page_' . $key ] ) ? wp_unslash( $_POST[ 'dsn_faq_page_' . $key ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized below.
			$value = 'textarea' === $field[0] ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
			if ( 'select' === $field[0] && ! isset( dsn_faq_layouts()[ $value ] ) ) {
				$value = '';
			}
			update_post_meta( $post_id, '_dns_v4_faq_' . $key, $value );
		}
	}
);

// ── Helpers ───────────────────────────────────────────────────────────────────

/**
 * Is this request one of the FAQ pages?
 *
 * @return bool
 */
function dsn_is_faq_page() {
	return dsn_faq_is_landing() || is_tax( DSN_FAQ_TAX ) || is_singular( DSN_FAQ_CPT );
}

/**
 * Is this request the FAQ landing page (/faqs/ or the FAQs page template)?
 *
 * @return bool
 */
function dsn_faq_is_landing() {
	return is_post_type_archive( DSN_FAQ_CPT ) || is_page_template( DSN_FAQ_PAGE_TEMPLATE );
}

/**
 * The page using the FAQs template (in the current language), if any. Its
 * fields hold the landing page texts.
 *
 * @return int Page ID, 0 when there is none.
 */
function dsn_faq_page_id() {
	static $id = null;
	if ( null === $id ) {
		if ( is_page_template( DSN_FAQ_PAGE_TEMPLATE ) ) {
			$id = (int) get_queried_object_id();
		} else {
			$pages = get_posts(
				array(
					'post_type'        => 'page',
					'post_status'      => 'publish',
					'numberposts'      => 1,
					'fields'           => 'ids',
					'meta_key'         => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
					'meta_value'       => DSN_FAQ_PAGE_TEMPLATE, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
					'suppress_filters' => false,
				)
			);
			$id    = $pages ? (int) $pages[0] : 0;
		}
	}
	return $id;
}

/**
 * A landing page text from the FAQs page fields (_dns_v4_faq_<key>, the same keys as the v4 theme), or the
 * layout's own text when the field is blank or there is no FAQs page.
 *
 * @param string $key     Field key (eyebrow, title, lines_title, cta_text…).
 * @param string $default Layout text.
 * @return string Plain text.
 */
function dsn_faq_copy( $key, $default ) {
	$id    = dsn_faq_page_id();
	$value = $id ? trim( (string) get_post_meta( $id, '_dns_v4_faq_' . $key, true ) ) : '';
	return '' !== $value ? $value : (string) $default;
}

/**
 * The landing page intro: the FAQs page content, or the layout's own text.
 *
 * @param string $default Layout text.
 * @return string HTML (escaped).
 */
function dsn_faq_intro( $default ) {
	$id      = dsn_faq_page_id();
	$content = $id ? (string) get_post_field( 'post_content', $id ) : '';
	if ( '' === trim( wp_strip_all_tags( $content ) ) ) {
		return '<p>' . esc_html( $default ) . '</p>';
	}
	return wp_kses_post( wpautop( do_shortcode( $content ) ) );
}

/**
 * Every FAQ, for the landing page: the archive's own query, or a query of its
 * own on the FAQs page template.
 *
 * @return WP_Post[]
 */
function dsn_faq_landing_posts() {
	global $wp_query;
	static $posts = null;
	if ( null === $posts ) {
		$posts = is_post_type_archive( DSN_FAQ_CPT ) ? (array) $wp_query->posts : get_posts(
			array(
				'post_type'        => DSN_FAQ_CPT,
				'post_status'      => 'publish',
				'numberposts'      => -1,
				'orderby'          => array(
					'menu_order' => 'ASC',
					'title'      => 'ASC',
				),
				'suppress_filters' => false,
			)
		);
	}
	return $posts;
}

/**
 * The short answer for a FAQ (falls back to the start of the long answer).
 *
 * @param int|WP_Post|null $post FAQ.
 * @return string Plain text.
 */
function dsn_faq_short( $post = null ) {
	$post  = get_post( $post );
	$short = trim( (string) get_post_meta( $post->ID, DSN_FAQ_SHORT_META, true ) );
	if ( '' === $short ) {
		$short = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 35 );
	}
	return $short;
}

/**
 * The long answer as HTML (empty string when there isn't one).
 *
 * @param int|WP_Post|null $post FAQ.
 * @return string
 */
function dsn_faq_long( $post = null ) {
	$post = get_post( $post );
	if ( '' === trim( wp_strip_all_tags( $post->post_content ) ) ) {
		return '';
	}
	return apply_filters( 'the_content', $post->post_content ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
}

/**
 * Show the author on this FAQ? Generic, syndicated answers usually don't;
 * an answer the dealer has personalised can show who wrote it. Turning off
 * "Show the author" (Theme Settings → FAQs) hides it on every FAQ.
 *
 * @param int|WP_Post|null $post FAQ.
 * @return bool
 */
function dsn_faq_show_author( $post = null ) {
	$post = get_post( $post );
	return $post && $post->post_author && dsn_faq_opt( 'show_author', '1' ) && '1' !== get_post_meta( $post->ID, DSN_FAQ_HIDE_AUTHOR_META, true );
}

/**
 * All FAQ categories in the order they were created (the planning-sheet
 * order). Product lines are kept while any of their topics has FAQs.
 *
 * @return WP_Term[]
 */
function dsn_faq_categories() {
	static $terms = null;
	if ( null === $terms ) {
		$terms = get_terms(
			array(
				'taxonomy'   => DSN_FAQ_TAX,
				'hide_empty' => true,
				'orderby'    => 'term_id',
				'order'      => 'ASC',
			)
		);
		$terms = is_wp_error( $terms ) ? array() : $terms;
	}
	return $terms;
}

/**
 * The company category (the dealer's own questions), if it exists.
 *
 * @return WP_Term|null
 */
function dsn_faq_company() {
	return dsn_faq_term( DSN_FAQ_COMPANY, DSN_FAQ_TAX );
}

/**
 * Is this the company category?
 *
 * @param WP_Term|object $term Category.
 * @return bool
 */
function dsn_faq_is_company( $term ) {
	$company = dsn_faq_company();
	return $company && (int) $term->term_id === (int) $company->term_id;
}

/**
 * Product lines: the top-level categories, without the company one.
 *
 * @return WP_Term[]
 */
function dsn_faq_lines() {
	return array_values(
		array_filter(
			dsn_faq_categories(),
			function ( $t ) {
				return ! $t->parent && ! dsn_faq_is_company( $t );
			}
		)
	);
}

/**
 * Topics (child categories) of a category.
 *
 * @param WP_Term $term Parent category.
 * @return WP_Term[]
 */
function dsn_faq_topics( $term ) {
	return array_values(
		array_filter(
			dsn_faq_categories(),
			function ( $t ) use ( $term ) {
				return (int) $t->parent === (int) $term->term_id;
			}
		)
	);
}

/**
 * The product line (top-level category) a category belongs to.
 *
 * @param WP_Term $term Category.
 * @return WP_Term
 */
function dsn_faq_line_of( $term ) {
	$ancestors = get_ancestors( $term->term_id, DSN_FAQ_TAX, 'taxonomy' );
	if ( ! $ancestors ) {
		return $term;
	}
	$top = get_term( end( $ancestors ), DSN_FAQ_TAX );
	return $top && ! is_wp_error( $top ) ? $top : $term;
}

/**
 * Icon for a product line or topic, by its default-language slug.
 *
 * @param WP_Term|object $term Category.
 * @return string
 */
function dsn_faq_icon( $term ) {
	$slug  = empty( $term->term_id ) ? (string) $term->slug : dsn_faq_term_slug( $term );
	$icons = array(
		'hot-tubs'               => 'droplet',
		'swim-spas'              => 'waves',
		'saunas'                 => 'flame',
		'cold-plunge'            => 'snow',
		'company'                => 'users',
		'buyer'                  => 'dollar',
		'installation-delivery'  => 'truck',
		'water-care-maintenance' => 'droplet',
		'ownership'              => 'shield',
		'health-wellness-usage'  => 'leaf',
		'troubleshooting'        => 'wrench',
		'winter-seasonal'        => 'snow',
	);
	if ( isset( $icons[ $slug ] ) ) {
		return $icons[ $slug ];
	}
	// Topics of the other product lines: swim-spa-buyer, sauna-care…
	foreach ( array( 'buyer' => 'dollar', 'installation' => 'truck', 'delivery' => 'truck', 'care' => 'droplet', 'ownership' => 'shield', 'safety' => 'shield', 'use' => 'leaf' ) as $part => $icon ) {
		if ( false !== strpos( $slug, $part ) ) {
			return $icon;
		}
	}
	return 'sparkle';
}

/**
 * Short category label: drops the "Hot Tub … Questions" boilerplate.
 *
 * @param string $name Category name.
 * @return string
 */
function dsn_faq_short_cat( $name ) {
	$short = trim( (string) preg_replace( '/^(Hot Tub|Swim Spa|Sauna|Cold Plunge)\s+|\s+Questions$/i', '', $name ) );
	return '' !== $short ? $short : $name;
}

/**
 * FAQs matching every word of a search (question, quick answer and answer).
 *
 * @param WP_Post[] $posts FAQs.
 * @param string    $q     Search text.
 * @return WP_Post[]
 */
function dsn_faq_search( $posts, $q ) {
	$words = array_filter( preg_split( '/\s+/', mb_strtolower( trim( (string) $q ) ) ) );
	if ( ! $words ) {
		return $posts;
	}
	return array_values(
		array_filter(
			$posts,
			function ( $post ) use ( $words ) {
				$hay = mb_strtolower( wp_strip_all_tags( get_the_title( $post ) . ' ' . dsn_faq_short( $post ) . ' ' . $post->post_content ) );
				foreach ( $words as $word ) {
					if ( false === mb_strpos( $hay, $word ) ) {
						return false;
					}
				}
				return true;
			}
		)
	);
}

/**
 * The search text from the URL (?q=), so search works without JavaScript.
 *
 * @return string
 */
function dsn_faq_query() {
	return isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only search.
}

/**
 * Plain text for JSON the page's JavaScript renders (it escapes the text
 * itself): titles and term names come HTML-encoded from WordPress (&amp;,
 * &#8217;…), so decode them to avoid double escaping.
 *
 * @param string $text Title, term name or quick answer.
 * @return string
 */
function dsn_faq_text( $text ) {
	return html_entity_decode( wp_strip_all_tags( (string) $text ), ENT_QUOTES, 'UTF-8' );
}

/**
 * The FAQ landing page layout: the FAQs page's own Layout field, else
 * Theme Settings → FAQs, or ?faq_layout= in the URL to preview and compare
 * the layouts.
 *
 * @return string 'explorer' | 'concierge'.
 */
function dsn_faq_landing_layout() {
	$choices = array_keys( dsn_faq_layouts() );
	$preview = isset( $_GET['faq_layout'] ) ? sanitize_key( wp_unslash( $_GET['faq_layout'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only preview.
	if ( in_array( $preview, $choices, true ) ) {
		return $preview;
	}
	$page = dsn_faq_page_id() ? get_post_meta( dsn_faq_page_id(), '_dns_v4_faq_layout', true ) : '';
	if ( in_array( $page, $choices, true ) ) {
		return $page;
	}
	$saved = dsn_faq_opt( 'layout' );
	return in_array( $saved, $choices, true ) ? $saved : 'concierge';
}

/**
 * Hidden field that keeps a ?faq_layout= preview when a landing page search
 * form is submitted.
 */
function dsn_faq_layout_field() {
	if ( isset( $_GET['faq_layout'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		echo '<input type="hidden" name="faq_layout" value="' . esc_attr( dsn_faq_landing_layout() ) . '">';
	}
}

// Layout previews (?faq_layout=) are duplicates of /faqs/: keep them out of search results.
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( isset( $_GET['faq_layout'] ) && dsn_faq_is_landing() ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$robots['noindex'] = true;
		}
		return $robots;
	}
);

// With a FAQs page, every "All FAQs" link (breadcrumbs, category pages, the shortcode) goes to it.
add_filter(
	'post_type_archive_link',
	function ( $link, $post_type ) {
		if ( DSN_FAQ_CPT === $post_type && dsn_faq_page_id() ) {
			return get_permalink( dsn_faq_page_id() );
		}
		return $link;
	},
	10,
	2
);

// ...and /faqs/ redirects to it, keeping a search or preview. A page with the
// slug "faqs" has the same address as the archive (which WordPress serves
// first): the archive then shows the page's texts, so there is no redirect.
add_action(
	'template_redirect',
	function () {
		global $wp;
		if ( ! is_post_type_archive( DSN_FAQ_CPT ) || ! dsn_faq_page_id() ) {
			return;
		}
		$page = get_permalink( dsn_faq_page_id() );
		if ( untrailingslashit( (string) wp_parse_url( $page, PHP_URL_PATH ) ) === untrailingslashit( (string) wp_parse_url( home_url( $wp->request ), PHP_URL_PATH ) ) ) {
			return;
		}
		$args = array( 'q' => rawurlencode( dsn_faq_query() ) );
		if ( isset( $_GET['faq_layout'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$args['faq_layout'] = dsn_faq_landing_layout();
		}
		wp_safe_redirect( add_query_arg( array_filter( $args ), $page ), 301 );
		exit;
	}
);

/**
 * Group FAQ posts under the given categories. A FAQ goes into the group of
 * its category or of the category's ancestor.
 *
 * @param WP_Post[]    $posts    FAQs.
 * @param WP_Term[]    $terms    Group categories, in display order.
 * @param WP_Term|null $fallback Collect FAQs that fit no group under this
 *                               category (FAQs filed on the product line
 *                               itself rather than on a topic).
 * @return array[] Each: term (object), faqs (WP_Post[]).
 */
function dsn_faq_group( $posts, $terms, $fallback = null ) {
	$groups = array();
	foreach ( $terms as $term ) {
		$groups[ $term->term_id ] = array(
			'term' => $term,
			'faqs' => array(),
		);
	}
	$general = array();
	foreach ( $posts as $post ) {
		$placed = false;
		foreach ( (array) get_the_terms( $post, DSN_FAQ_TAX ) as $t ) {
			if ( ! $t instanceof WP_Term ) {
				continue;
			}
			foreach ( array_merge( array( $t->term_id ), get_ancestors( $t->term_id, DSN_FAQ_TAX, 'taxonomy' ) ) as $id ) {
				if ( isset( $groups[ $id ] ) && ! in_array( $post, $groups[ $id ]['faqs'], true ) ) {
					$groups[ $id ]['faqs'][] = $post;
					$placed                  = true;
					break;
				}
			}
		}
		if ( ! $placed && $fallback ) {
			$general[] = $post;
		}
	}
	if ( $general ) {
		$groups[0] = array(
			'term' => (object) array(
				'term_id'     => 0,
				'slug'        => 'general',
				/* translators: %s: product line, e.g. Hot Tubs */
				'name'        => sprintf( __( 'More %s questions', 'dsnshowcase' ), $fallback->name ),
				'description' => '',
				'count'       => count( $general ),
			),
			'faqs' => $general,
		);
	}
	return array_filter(
		$groups,
		function ( $g ) {
			return ! empty( $g['faqs'] );
		}
	);
}

/**
 * Print a list of FAQ expanders.
 *
 * @param WP_Post[] $faqs FAQs.
 * @param int[]     $hide IDs rendered hidden (not matching the ?q= search;
 *                        still in the page for the live search).
 */
function dsn_faq_render_items( $faqs, $hide = array() ) {
	echo '<ul class="dsn:m-0 dsn:list-none dsn:space-y-4 dsn:p-0">';
	foreach ( $faqs as $faq ) {
		$GLOBALS['post'] = $faq; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		setup_postdata( $faq );
		get_template_part( 'templates/faq/item', null, array( 'hide' => $hide ) );
	}
	wp_reset_postdata();
	echo '</ul>';
}

/**
 * FAQs whose answers are on the current page (for the structured data): the
 * company FAQs (or search results) on the landing page, every listed FAQ on a
 * category page, the FAQ itself on its own page.
 *
 * @return WP_Post[]
 */
function dsn_faq_visible_posts() {
	global $wp_query;
	$posts = array_values(
		array_filter(
			dsn_faq_is_landing() ? dsn_faq_landing_posts() : (array) $wp_query->posts,
			function ( $p ) {
				return $p instanceof WP_Post && DSN_FAQ_CPT === $p->post_type;
			}
		)
	);
	if ( is_singular( DSN_FAQ_CPT ) ) {
		return $posts;
	}
	$posts = dsn_faq_search( $posts, dsn_faq_query() );
	if ( dsn_faq_is_landing() && '' === dsn_faq_query() ) {
		$company = dsn_faq_company();
		$groups  = $company ? dsn_faq_group( $posts, array( $company ) ) : array();
		return $groups ? $groups[ $company->term_id ]['faqs'] : array();
	}
	return $posts;
}

// ── Assets ────────────────────────────────────────────────────────────────────

/**
 * Load the FAQ script when a FAQ view needs it (set by the shortcode too).
 */
function dsn_faq_enqueue_script() {
	if ( wp_script_is( 'dsn-faq', 'enqueued' ) ) {
		return;
	}
	$file = DSN_THEME_DIR . '/assets/js/faq.js';
	wp_enqueue_script( 'dsn-faq', DSN_THEME_URI . '/assets/js/faq.js', array(), file_exists( $file ) ? (string) filemtime( $file ) : DSN_FAQ_VERSION, array( 'in_footer' => true, 'strategy' => 'defer' ) );
}
add_action(
	'wp_enqueue_scripts',
	function () {
		// Single FAQs use assets/js/faq-toc.js (Sections, copy and share) instead.
		if ( is_singular( DSN_FAQ_CPT ) ) {
			$file = DSN_THEME_DIR . '/assets/js/faq-toc.js';
			wp_enqueue_script( 'dsn-faq-toc', DSN_THEME_URI . '/assets/js/faq-toc.js', array(), file_exists( $file ) ? (string) filemtime( $file ) : DSN_FAQ_VERSION, array( 'in_footer' => true, 'strategy' => 'defer' ) );
		} elseif ( dsn_is_faq_page() ) {
			dsn_faq_enqueue_script();
		}
	}
);

// ── Structured data ───────────────────────────────────────────────────────────

/**
 * Print FAQPage JSON-LD for a set of FAQs. The answer text is what the page
 * shows: the quick answer in the expanders, plus the full answer on a FAQ's
 * own page.
 *
 * @param WP_Post[] $faqs FAQs.
 * @param bool      $full Include the full answer.
 */
function dsn_faq_print_schema( $faqs, $full = false ) {
	$items = array();
	foreach ( $faqs as $faq ) {
		$long   = $full ? dsn_faq_long( $faq ) : '';
		$answer = array(
			'@type' => 'Answer',
			'text'  => '<p>' . esc_html( dsn_faq_short( $faq ) ) . '</p>' . $long,
			'url'   => get_permalink( $faq ),
		);
		if ( dsn_faq_show_author( $faq ) ) {
			$answer['author'] = dsn_faq_author_schema( $faq->post_author );
		}
		$items[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( get_the_title( $faq ) ),
			'acceptedAnswer' => $answer,
		);
	}
	if ( ! $items ) {
		return;
	}
	$data = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $items,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . "</script>\n";
}

add_action(
	'wp_head',
	function () {
		if ( ! dsn_is_faq_page() ) {
			return;
		}
		dsn_faq_print_schema( dsn_faq_visible_posts(), is_singular( DSN_FAQ_CPT ) );
	},
	30
);

// ── Shortcode: [dsn_faqs category="slug" limit="6" title="..."] ───────────────

/**
 * [dsn_faqs] (and [dns_v4_faqs], its v4 name, so pasted content keeps working).
 *
 * @param array $atts category (slugs, comma separated), limit, title.
 * @return string
 */
function dsn_faq_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
			'limit'    => 8,
			'title'    => '',
		),
		$atts,
		'dsn_faqs'
	);
	$args = array(
		'post_type'      => DSN_FAQ_CPT,
		'posts_per_page' => max( 1, (int) $atts['limit'] ),
		'orderby'        => array(
			'menu_order' => 'ASC',
			'title'      => 'ASC',
		),
		'no_found_rows'  => true,
	);
	if ( $atts['category'] ) {
		$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => DSN_FAQ_TAX,
				'field'    => 'slug',
				'terms'    => array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
			),
		);
	}
	$faqs = get_posts( $args );
	if ( ! $faqs ) {
		return '';
	}
	dsn_faq_enqueue_script();
	ob_start();
	?>
	<div class="dsn-faq dsn:my-8" data-faq-root>
		<?php if ( $atts['title'] ) : ?>
			<h2 class="dsn:mb-5 dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink dsn:sm:text-3xl"><?php echo esc_html( $atts['title'] ); ?></h2>
		<?php endif; ?>
		<?php dsn_faq_render_items( $faqs ); ?>
		<p class="dsn:mt-5 dsn:text-sm"><a class="dsn:font-semibold dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_post_type_archive_link( DSN_FAQ_CPT ) ); ?>"><?php esc_html_e( 'See all FAQs', 'dsnshowcase' ); ?> &rarr;</a></p>
	</div>
	<?php
	dsn_faq_print_schema( $faqs );
	return ob_get_clean();
}
add_shortcode( 'dsn_faqs', 'dsn_faq_shortcode' );
add_shortcode( 'dns_v4_faqs', 'dsn_faq_shortcode' );

// ── Starter content ───────────────────────────────────────────────────────────

/**
 * Create the starter product lines, topics and FAQs (inc/faq-sample-data.php).
 *
 * - New sites (no FAQ yet): everything is created.
 * - Sites that got the earlier flat starter set: its 7 hot tub topics move
 *   under a new Hot Tubs product line, and the product lines and company
 *   questions that don't exist yet are added with their sample FAQs.
 * - Sites that wrote their own FAQs before the theme seeded: left alone.
 *
 * Starter FAQs are credited to the site's first administrator (so the FAQ
 * pages can show an author); earlier starter FAQs saved without an author
 * get the same.
 *
 * Runs once per step (dns_v4_faq_seeded: 1 flat set, 2 product lines,
 * 3 authors).
 *
 * @return int Number of FAQs created.
 */
function dsn_faq_seed() {
	$state = (int) get_option( 'dns_v4_faq_seeded' );
	if ( $state >= 3 ) {
		return 0;
	}
	update_option( 'dns_v4_faq_seeded', 3, false );

	if ( 2 === $state ) {
		dsn_faq_seed_authors();
		return 0;
	}

	$existing = get_posts(
		array(
			'post_type'      => DSN_FAQ_CPT,
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'orderby'        => 'menu_order',
			'order'          => 'DESC',
		)
	);
	if ( ! $state && $existing ) {
		return 0;
	}

	$data    = require DSN_THEME_DIR . '/inc/faq-sample-data.php';
	$order   = $existing ? (int) $existing[0]->menu_order : 0;
	$created = 0;
	foreach ( $data as $line ) {
		list( $line_id, $line_new ) = dsn_faq_seed_term( $line, 0 );
		if ( ! $line_id ) {
			continue;
		}
		// An existing product line only gets its starter topics re-filed under it.
		$add = ! $state || $line_new;
		if ( $add && ! empty( $line['faqs'] ) ) {
			$created += dsn_faq_seed_posts( $line['faqs'], $line_id, $order );
		}
		foreach ( isset( $line['topics'] ) ? $line['topics'] : array() as $topic ) {
			$found = get_term_by( 'slug', $topic['slug'], DSN_FAQ_TAX );
			if ( ! $found && ! $add ) {
				continue;
			}
			list( $topic_id, $topic_new ) = dsn_faq_seed_term( $topic, $line_id );
			if ( $topic_id && $topic_new ) {
				$created += dsn_faq_seed_posts( $topic['faqs'], $topic_id, $order );
			}
		}
	}
	if ( $state ) {
		dsn_faq_seed_authors();
	}
	return $created;
}
add_action( 'init', 'dsn_faq_seed', 30 );

/**
 * Who starter FAQs are credited to: the site's first administrator.
 *
 * @return int User ID (0 when there is none).
 */
function dsn_faq_seed_author() {
	$admins = get_users(
		array(
			'role'    => 'administrator',
			'number'  => 1,
			'orderby' => 'ID',
			'fields'  => 'ID',
		)
	);
	return $admins ? (int) $admins[0] : 0;
}

/**
 * Credit FAQs saved without an author (earlier starter content) to the
 * first administrator.
 */
function dsn_faq_seed_authors() {
	$author = dsn_faq_seed_author();
	if ( ! $author ) {
		return;
	}
	$ids = get_posts(
		array(
			'post_type'      => DSN_FAQ_CPT,
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);
	// WP_Query can't filter on "no author", so check each one.
	foreach ( $ids as $id ) {
		if ( ! (int) get_post_field( 'post_author', $id ) ) {
			wp_update_post(
				array(
					'ID'          => $id,
					'post_author' => $author,
				)
			);
		}
	}
}

/**
 * Find or create a starter category. An existing top-level category is moved
 * under $parent.
 *
 * @param array $cat    name, slug, desc.
 * @param int   $parent Parent term ID (0 = top level).
 * @return array{0:int,1:bool} Term ID (0 on failure) and whether it was created.
 */
function dsn_faq_seed_term( $cat, $parent ) {
	$found = get_term_by( 'slug', $cat['slug'], DSN_FAQ_TAX );
	if ( $found ) {
		if ( $parent && ! $found->parent ) {
			wp_update_term( $found->term_id, DSN_FAQ_TAX, array( 'parent' => $parent ) );
		}
		return array( (int) $found->term_id, false );
	}
	$term = wp_insert_term(
		$cat['name'],
		DSN_FAQ_TAX,
		array(
			'slug'        => $cat['slug'],
			'description' => $cat['desc'],
			'parent'      => $parent,
		)
	);
	return is_wp_error( $term ) ? array( 0, false ) : array( (int) $term['term_id'], true );
}

/**
 * Create starter FAQs in a category.
 *
 * @param array[] $faqs  Each: q (question), s (quick answer), l (answer HTML).
 * @param int     $term  Category ID.
 * @param int     $order Running menu order (updated).
 * @return int Number created.
 */
function dsn_faq_seed_posts( $faqs, $term, &$order ) {
	static $author = null;
	if ( null === $author ) {
		$author = dsn_faq_seed_author();
	}
	$created = 0;
	foreach ( $faqs as $faq ) {
		$id = wp_insert_post(
			array(
				'post_author'  => $author,
				'post_type'    => DSN_FAQ_CPT,
				'post_status'  => 'publish',
				'post_title'   => $faq['q'],
				'post_content' => $faq['l'],
				'menu_order'   => ++$order,
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, DSN_FAQ_SHORT_META, $faq['s'] );
			wp_set_object_terms( $id, array( $term ), DSN_FAQ_TAX );
			++$created;
		}
	}
	return $created;
}
