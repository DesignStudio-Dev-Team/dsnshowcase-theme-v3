<?php
/**
 * FAQ landing page, "Concierge" layout (/faqs/ or the page using the FAQs
 * template; the other layout is landing-explorer.php):
 *
 * - a guided, chat-style answer finder: the visitor picks a product, then a
 *   topic, then a question, and gets the quick answer as a reply, with links
 *   to the full answer and the team. They can also type a question and get
 *   the best match;
 * - a card for each product line (its number of questions and topics),
 *   linking to that line's FAQ page;
 * - the company questions as cards with their quick answers.
 *
 * Headings and intro texts can be edited on the FAQs page (dsn_faq_copy()).
 * Without JavaScript the chat shows its first message with links to each
 * product line, the typed question is a plain GET search (?q=), and the
 * product and company cards are complete HTML. assets/js/faq.js runs the chat.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

$dsn_faq_q       = dsn_faq_query();
$dsn_faq_url     = get_post_type_archive_link( DSN_FAQ_CPT );
$dsn_faq_posts   = dsn_faq_landing_posts();
$dsn_faq_company = dsn_faq_company();
$dsn_faq_by_line = dsn_faq_group( $dsn_faq_posts, dsn_faq_lines() );

$dsn_faq_company_faqs = array();
if ( $dsn_faq_company ) {
	$dsn_faq_cg           = dsn_faq_group( $dsn_faq_posts, array( $dsn_faq_company ) );
	$dsn_faq_company_faqs = $dsn_faq_cg ? $dsn_faq_cg[ $dsn_faq_company->term_id ]['faqs'] : array();
}

// The chat's data: every FAQ once, and the product → topic → question tree.
$dsn_faq_tree = array(
	'faqs'    => array(),
	'lines'   => array(),
	'company' => null,
);
$dsn_faq_add  = function ( $faqs ) use ( &$dsn_faq_tree ) {
	$ids = array();
	foreach ( $faqs as $f ) {
		$dsn_faq_tree['faqs'][ $f->ID ] = array(
			'q' => dsn_faq_text( get_the_title( $f ) ),
			'a' => dsn_faq_text( dsn_faq_short( $f ) ),
			'u' => get_permalink( $f ),
		);
		$ids[]                         = $f->ID;
	}
	return $ids;
};
$dsn_faq_map = array();
foreach ( $dsn_faq_by_line as $dsn_faq_g ) {
	$dsn_faq_line   = $dsn_faq_g['term'];
	$dsn_faq_topics = dsn_faq_topics( $dsn_faq_line );
	$dsn_faq_groups = $dsn_faq_topics ? dsn_faq_group( $dsn_faq_g['faqs'], $dsn_faq_topics, $dsn_faq_line ) : array( array( 'term' => $dsn_faq_line, 'faqs' => $dsn_faq_g['faqs'] ) );
	$dsn_faq_node   = array(
		'name'   => dsn_faq_text( $dsn_faq_line->name ),
		'icon'   => dsn_faq_svg( dsn_faq_icon( $dsn_faq_line ), 'dsn:h-4 dsn:w-4' ),
		'url'    => get_term_link( $dsn_faq_line ),
		'top'    => $dsn_faq_add( array_slice( $dsn_faq_g['faqs'], 0, 6 ) ),
		'topics' => array(),
	);
	foreach ( $dsn_faq_groups as $dsn_faq_tg ) {
		$dsn_faq_node['topics'][] = array(
			'name' => dsn_faq_text( dsn_faq_short_cat( $dsn_faq_tg['term']->name ) ),
			'icon' => dsn_faq_svg( dsn_faq_icon( $dsn_faq_tg['term'] ), 'dsn:h-4 dsn:w-4' ),
			'url'  => empty( $dsn_faq_tg['term']->term_id ) ? get_term_link( $dsn_faq_line ) : get_term_link( $dsn_faq_tg['term'] ),
			'faqs' => $dsn_faq_add( $dsn_faq_tg['faqs'] ),
		);
	}
	$dsn_faq_tree['lines'][] = $dsn_faq_node;
	$dsn_faq_map[]           = array(
		'line'  => $dsn_faq_line,
		'count' => count( $dsn_faq_g['faqs'] ),
	);
}
if ( $dsn_faq_company_faqs ) {
	$dsn_faq_tree['company'] = array(
		'name' => __( 'Our store & policies', 'dsnshowcase' ),
		'icon' => dsn_faq_svg( 'users', 'dsn:h-4 dsn:w-4' ),
		'faqs' => $dsn_faq_add( $dsn_faq_company_faqs ),
	);
}
// Every FAQ, so a typed question can match any of them.
$dsn_faq_add( $dsn_faq_posts );

// Product cards: up to 3 lines share a row, 4 or more go 4 across.
$dsn_faq_cols = array(
	1 => 'dsn:lg:grid-cols-2',
	2 => 'dsn:lg:grid-cols-2',
	3 => 'dsn:lg:grid-cols-3',
);
$dsn_faq_cols = isset( $dsn_faq_cols[ count( $dsn_faq_map ) ] ) ? $dsn_faq_cols[ count( $dsn_faq_map ) ] : 'lg:grid-cols-4';

$dsn_faq_i18n = array(
	/* translators: %s: product line, e.g. Hot Tubs */
	'askTopic'  => __( 'Good choice. What would you like to know about %s?', 'dsnshowcase' ),
	'mostAsked' => __( 'Most asked', 'dsnshowcase' ),
	/* translators: %s: topic, e.g. Buyer */
	'pickQ'     => __( 'Here’s what people ask about %s:', 'dsnshowcase' ),
	'pickCo'    => __( 'Here’s what people ask about us:', 'dsnshowcase' ),
	'answer'    => __( 'Here’s the quick answer:', 'dsnshowcase' ),
	'best'      => __( 'This looks like your answer:', 'dsnshowcase' ),
	'related'   => __( 'You might also mean:', 'dsnshowcase' ),
	'none'      => __( 'I couldn’t find that one — but our team can answer it for you.', 'dsnshowcase' ),
	'readFull'  => __( 'Read the full answer', 'dsnshowcase' ),
	'ask'       => __( 'Ask our team', 'dsnshowcase' ),
	'next'      => __( 'Anything else?', 'dsnshowcase' ),
	/* translators: %s: topic, e.g. Buyer */
	'more'      => __( 'More about %s', 'dsnshowcase' ),
	'restart'   => __( 'Pick another product', 'dsnshowcase' ),
	'seeAll'    => __( 'Browse by product', 'dsnshowcase' ),
	'typing'    => __( 'Typing…', 'dsnshowcase' ),
);
?>
<div class="dsn-faq" data-faq-root>

	<section class="dsn:relative dsn:isolate dsn:overflow-hidden dsn:bg-faq-surface">
		<div class="dsn:pointer-events-none dsn:absolute dsn:-left-32 dsn:-top-40 dsn:-z-10 dsn:h-[560px] dsn:w-[560px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-primary)_16%,transparent),transparent_65%)]"></div>
		<div class="dsn:pointer-events-none dsn:absolute dsn:-bottom-48 dsn:-right-24 dsn:-z-10 dsn:h-[520px] dsn:w-[520px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-accent)_14%,transparent),transparent_65%)]"></div>
		<div class="faq-container dsn:grid dsn:items-center dsn:gap-12 dsn:py-14 dsn:sm:py-20 dsn:lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] dsn:lg:gap-16">
			<div class="faq-hero-in">
				<p class="faq-eyebrow dsn:text-faq-primary"><?php echo esc_html( dsn_faq_copy( 'eyebrow', __( 'FAQ concierge', 'dsnshowcase' ) ) ); ?></p>
				<h1 class="dsn:mt-3 dsn:font-faq-display dsn:text-4xl dsn:leading-[1.05] dsn:tracking-tight dsn:text-faq-ink dsn:text-balance dsn:sm:text-5xl dsn:lg:text-6xl"><?php echo esc_html( dsn_faq_copy( 'title', __( 'Answers, the way you’d ask a person', 'dsnshowcase' ) ) ); ?></h1>
				<div class="dsn:mt-5 dsn:max-w-xl dsn:text-lg dsn:leading-relaxed dsn:text-faq-ink/65 dsn:[&>*+*]:mt-4 dsn:[&_a]:text-faq-action dsn:[&_a]:underline"><?php echo dsn_faq_intro( __( 'Tell our concierge what you’re thinking about and it walks you to the answer in three taps — or just type your question.', 'dsnshowcase' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<ol class="dsn:m-0 dsn:mt-8 dsn:grid dsn:list-none dsn:gap-3 dsn:p-0">
					<?php foreach ( array( __( 'Pick a product', 'dsnshowcase' ), __( 'Choose a topic', 'dsnshowcase' ), __( 'Get the answer instantly', 'dsnshowcase' ) ) as $dsn_faq_i => $dsn_faq_step ) : ?>
						<li class="dsn:flex dsn:items-center dsn:gap-3 dsn:font-semibold dsn:text-faq-ink">
							<span class="dsn:grid dsn:h-8 dsn:w-8 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-ink dsn:font-faq-display dsn:text-sm dsn:text-white"><?php echo (int) $dsn_faq_i + 1; ?></span>
							<?php echo esc_html( $dsn_faq_step ); ?>
						</li>
					<?php endforeach; ?>
				</ol>
				<?php if ( dsn_faq_opt( 'phone' ) ) : ?>
					<p class="dsn:mt-8 dsn:text-sm dsn:text-faq-ink/60">
						<?php esc_html_e( 'Rather talk?', 'dsnshowcase' ); ?>
						<a class="dsn:font-semibold dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( dsn_faq_tel() ); ?>" data-track="call"><?php echo esc_html( dsn_faq_opt( 'phone' ) ); ?></a>
					</p>
				<?php endif; ?>
			</div>

			<div class="faq-hero-in dsn:overflow-hidden dsn:rounded-[calc(var(--faq-radius)+6px)] dsn:bg-white dsn:shadow-faq-lift dsn:ring-1 dsn:ring-faq-ink/10" style="--d:120ms" data-faq-concierge data-i18n="<?php echo esc_attr( wp_json_encode( $dsn_faq_i18n ) ); ?>">
				<div class="dsn:flex dsn:items-center dsn:gap-3 dsn:border-b dsn:border-faq-ink/10 dsn:px-5 dsn:py-4">
					<span class="dsn:relative dsn:grid dsn:h-11 dsn:w-11 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-primary dsn:text-white">
						<?php dsn_faq_the_icon( 'sparkle', 'dsn:h-5 dsn:w-5' ); ?>
						<span class="dsn:absolute dsn:bottom-0 dsn:right-0 dsn:h-3 dsn:w-3 dsn:rounded-full dsn:bg-emerald-500 dsn:ring-2 dsn:ring-white" aria-hidden="true"></span>
					</span>
					<div class="dsn:min-w-0 dsn:flex-1">
						<p class="dsn:truncate dsn:font-semibold dsn:text-faq-ink">
							<?php
							/* translators: %s: site name */
							echo esc_html( sprintf( __( '%s concierge', 'dsnshowcase' ), get_bloginfo( 'name' ) ) );
							?>
						</p>
						<p class="dsn:text-xs dsn:text-faq-ink/55"><?php esc_html_e( 'Online · answers instantly', 'dsnshowcase' ); ?></p>
					</div>
					<button type="button" class="dsn:inline-flex dsn:items-center dsn:gap-1.5 dsn:rounded-full dsn:px-3 dsn:py-1.5 dsn:text-sm dsn:font-semibold dsn:text-faq-action dsn:hover:bg-faq-surface" data-cc-restart hidden><?php dsn_faq_the_icon( 'arrow-l', 'dsn:h-4 dsn:w-4' ); ?><?php esc_html_e( 'Start over', 'dsnshowcase' ); ?></button>
				</div>

				<ol class="cc-log dsn:m-0 dsn:h-[26rem] dsn:list-none dsn:space-y-4 dsn:overflow-y-auto dsn:bg-[linear-gradient(color-mix(in_srgb,var(--faq-surface)_50%,transparent),transparent_40%)] dsn:p-5 dsn:sm:h-[30rem] dsn:sm:p-6" aria-live="polite" aria-label="<?php esc_attr_e( 'Conversation', 'dsnshowcase' ); ?>" data-cc-log>
					<li class="cc-bot">
						<p class="cc-bubble"><?php esc_html_e( 'Hi! I can find your answer in seconds. What are you thinking about?', 'dsnshowcase' ); ?></p>
					</li>
					<li class="cc-choices" data-cc-first>
						<?php foreach ( $dsn_faq_tree['lines'] as $dsn_faq_n => $dsn_faq_node ) : ?>
							<a href="<?php echo esc_url( $dsn_faq_node['url'] ); ?>" class="cc-chip" data-cc-line="<?php echo (int) $dsn_faq_n; ?>"><?php echo $dsn_faq_node['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG. ?><?php echo esc_html( $dsn_faq_node['name'] ); ?></a>
						<?php endforeach; ?>
						<?php if ( $dsn_faq_tree['company'] ) : ?>
							<a href="#company" class="cc-chip" data-cc-company><?php echo $dsn_faq_tree['company']['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG. ?><?php echo esc_html( $dsn_faq_tree['company']['name'] ); ?></a>
						<?php endif; ?>
					</li>
				</ol>

				<form class="dsn:flex dsn:items-center dsn:gap-2 dsn:border-t dsn:border-faq-ink/10 dsn:p-3" role="search" action="<?php echo esc_url( $dsn_faq_url ); ?>" method="get" data-cc-form>
					<?php dsn_faq_layout_field(); ?>
					<label for="dsn-cc-input" class="dsn:sr-only"><?php esc_html_e( 'Type your question', 'dsnshowcase' ); ?></label>
					<input id="dsn-cc-input" name="q" type="search" autocomplete="off" value="<?php echo esc_attr( $dsn_faq_q ); ?>" placeholder="<?php esc_attr_e( 'Or type your question…', 'dsnshowcase' ); ?>" class="faq-input dsn:rounded-full! dsn:border-transparent! dsn:bg-faq-surface! dsn:py-3!" data-cc-input>
					<button type="submit" class="dsn:grid dsn:h-11 dsn:w-11 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-accent dsn:text-faq-on-accent dsn:transition dsn:hover:brightness-110" aria-label="<?php esc_attr_e( 'Send', 'dsnshowcase' ); ?>"><?php dsn_faq_the_icon( 'arrow', 'dsn:h-5 dsn:w-5', 2 ); ?></button>
				</form>
				<script type="application/json" data-cc-tree><?php echo wp_json_encode( $dsn_faq_tree, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?></script>
			</div>
		</div>
	</section>

	<?php if ( '' !== $dsn_faq_q ) : ?>

		<?php get_template_part( 'templates/faq/search-results' ); ?>

	<?php else : ?>

		<?php if ( $dsn_faq_map ) : ?>
			<section id="products" class="faq-section dsn:scroll-mt-[calc(var(--header-h,80px)+1rem)] dsn:pt-14 dsn:sm:pt-16 dsn:lg:pt-20">
				<div class="faq-container">
					<?php dsn_faq_section_heading( dsn_faq_copy( 'lines_eyebrow', __( 'Browse by product', 'dsnshowcase' ) ), dsn_faq_copy( 'lines_title', __( 'What can we help you with?', 'dsnshowcase' ) ), dsn_faq_copy( 'lines_text', __( 'Every product has its own questions, grouped by topic — from buying and delivery to care and everyday use.', 'dsnshowcase' ) ) ); ?>
					<ul class="dsn:m-0 dsn:mt-12 dsn:grid dsn:list-none dsn:gap-6 dsn:p-0 dsn:sm:grid-cols-2 <?php echo esc_attr( $dsn_faq_cols ); ?>">
						<?php
						foreach ( $dsn_faq_map as $dsn_faq_i => $dsn_faq_col ) :
							$dsn_faq_line   = $dsn_faq_col['line'];
							$dsn_faq_topics = dsn_faq_topics( $dsn_faq_line );
							?>
							<li class="" style="--d:<?php echo (int) $dsn_faq_i * 80; ?>ms">
								<article class="dsn:group dsn:relative dsn:flex dsn:h-full dsn:flex-col dsn:rounded-faq-card dsn:bg-white dsn:p-6 dsn:shadow-faq-soft dsn:ring-1 dsn:ring-faq-ink/10 dsn:transition dsn:duration-300 dsn:hover:-translate-y-1 dsn:hover:shadow-faq-lift dsn:hover:ring-faq-primary/40 dsn:sm:p-7">
									<span class="dsn:grid dsn:h-14 dsn:w-14 dsn:place-items-center dsn:rounded-faq-card dsn:bg-faq-primary/10 dsn:text-faq-primary dsn:transition dsn:group-hover:bg-faq-primary dsn:group-hover:text-white"><?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_line ), 'dsn:h-7 dsn:w-7' ); ?></span>
									<h3 class="dsn:mt-5 dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink">
										<a class="dsn:after:absolute dsn:after:inset-0 dsn:after:rounded-faq-card dsn:focus:outline-none" href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>"><?php echo esc_html( $dsn_faq_line->name ); ?></a>
									</h3>
									<p class="dsn:mt-1 dsn:text-sm dsn:font-semibold dsn:text-faq-ink/50">
										<?php /* translators: %d: number of FAQs */ echo esc_html( sprintf( _n( '%d question', '%d questions', $dsn_faq_col['count'], 'dsnshowcase' ), $dsn_faq_col['count'] ) ); ?>
									</p>
									<?php if ( $dsn_faq_line->description ) : ?>
										<p class="dsn:mt-3 dsn:leading-relaxed dsn:text-faq-ink/65"><?php echo esc_html( $dsn_faq_line->description ); ?></p>
									<?php endif; ?>
									<?php if ( $dsn_faq_topics ) : ?>
										<?php $dsn_faq_more = count( $dsn_faq_topics ) - 5; ?>
										<ul class="dsn:relative dsn:z-10 dsn:m-0 dsn:mt-5 dsn:flex dsn:list-none dsn:flex-wrap dsn:gap-2 dsn:p-0" aria-label="<?php /* translators: %s: product line, e.g. Hot Tubs */ echo esc_attr( sprintf( __( '%s topics', 'dsnshowcase' ), $dsn_faq_line->name ) ); ?>">
											<?php foreach ( array_slice( $dsn_faq_topics, 0, 5 ) as $dsn_faq_t ) : ?>
												<li><a class="faq-topic" href="<?php echo esc_url( get_term_link( $dsn_faq_t ) ); ?>"><?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_t ), 'dsn:h-3.5 dsn:w-3.5 dsn:shrink-0' ); ?><?php echo esc_html( dsn_faq_short_cat( $dsn_faq_t->name ) ); ?></a></li>
											<?php endforeach; ?>
											<?php if ( $dsn_faq_more > 0 ) : ?>
												<li><a class="faq-topic faq-topic--more" href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>"><?php /* translators: %d: number of other topics */ echo esc_html( sprintf( __( '+%d more', 'dsnshowcase' ), $dsn_faq_more ) ); ?></a></li>
											<?php endif; ?>
										</ul>
									<?php endif; ?>
									<p class="dsn:mt-auto dsn:inline-flex dsn:items-center dsn:gap-1.5 dsn:pt-6 dsn:text-[15px] dsn:font-semibold dsn:text-faq-action">
										<?php
										/* translators: %s: product line, e.g. Hot Tubs */
										echo esc_html( sprintf( __( 'See %s FAQs', 'dsnshowcase' ), $dsn_faq_line->name ) );
										?>
										<?php dsn_faq_the_icon( 'arrow', 'dsn:h-4 dsn:w-4 dsn:transition dsn:group-hover:translate-x-1' ); ?>
									</p>
								</article>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $dsn_faq_company_faqs ) : ?>
			<section id="company" class="faq-section dsn:scroll-mt-[calc(var(--header-h,80px)+1rem)] dsn:bg-faq-ink dsn:text-white">
				<div class="faq-container">
					<?php
					dsn_faq_section_heading(
						dsn_faq_copy( 'company_eyebrow', __( 'Our company', 'dsnshowcase' ) ),
						/* translators: %s: site name */
						dsn_faq_copy( 'company_title', sprintf( __( 'Questions about %s', 'dsnshowcase' ), get_bloginfo( 'name' ) ) ),
						dsn_faq_copy( 'company_text', $dsn_faq_company->description ),
						'center',
						true
					);
					?>
					<ul class="dsn:m-0 dsn:mt-12 dsn:grid dsn:list-none dsn:gap-5 dsn:p-0 dsn:sm:grid-cols-2 dsn:lg:grid-cols-3">
						<?php foreach ( $dsn_faq_company_faqs as $dsn_faq_i => $dsn_faq_f ) : ?>
							<li class="" style="--d:<?php echo (int) $dsn_faq_i * 60; ?>ms">
								<article class="dsn:group dsn:relative dsn:flex dsn:h-full dsn:flex-col dsn:rounded-faq-card dsn:bg-white/[.06] dsn:p-6 dsn:ring-1 dsn:ring-white/10 dsn:transition dsn:hover:-translate-y-1 dsn:hover:bg-white/10 dsn:hover:ring-white/25">
									<span class="dsn:font-faq-display dsn:text-4xl dsn:leading-none dsn:text-faq-accent" aria-hidden="true">“</span>
									<h3 class="dsn:mt-2 dsn:font-faq-display dsn:text-xl dsn:leading-snug dsn:text-white">
										<a class="dsn:after:absolute dsn:after:inset-0 dsn:after:rounded-faq-card" href="<?php echo esc_url( get_permalink( $dsn_faq_f ) ); ?>"><?php echo esc_html( get_the_title( $dsn_faq_f ) ); ?></a>
									</h3>
									<p class="dsn:mt-3 dsn:leading-relaxed dsn:text-white/70"><?php echo esc_html( dsn_faq_short( $dsn_faq_f ) ); ?></p>
									<span class="dsn:mt-auto dsn:inline-flex dsn:items-center dsn:gap-1.5 dsn:pt-5 dsn:text-sm dsn:font-semibold dsn:text-white/90"><?php esc_html_e( 'Read the full answer', 'dsnshowcase' ); ?><?php dsn_faq_the_icon( 'arrow', 'dsn:h-4 dsn:w-4 dsn:transition dsn:group-hover:translate-x-1' ); ?></span>
								</article>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</section>
		<?php endif; ?>

	<?php endif; ?>

	<?php get_template_part( 'templates/faq/cta' ); ?>
</div>
