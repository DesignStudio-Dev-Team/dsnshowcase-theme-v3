<?php
/**
 * FAQ category page (taxonomy-dsn_faq_category.php): a product line with its
 * FAQs grouped by topic, or a single topic. Hero with search, topic
 * navigation and the expanders.
 *
 * Search works without JavaScript (?q= hides the non-matching FAQs on the
 * server); assets/js/faq.js filters live as you type.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

global $wp_query;

$dsn_faq_term    = get_queried_object();
$dsn_faq_line    = dsn_faq_line_of( $dsn_faq_term );
$dsn_faq_is_line = (int) $dsn_faq_term->term_id === (int) $dsn_faq_line->term_id;
$dsn_faq_topics  = dsn_faq_topics( $dsn_faq_line );
$dsn_faq_landing = get_post_type_archive_link( DSN_FAQ_CPT );
$dsn_faq_q       = dsn_faq_query();

if ( ! $dsn_faq_is_line ) {
	$dsn_faq_groups = dsn_faq_group( $wp_query->posts, array( $dsn_faq_term ) );
} elseif ( $dsn_faq_topics ) {
	$dsn_faq_groups = dsn_faq_group( $wp_query->posts, $dsn_faq_topics, $dsn_faq_line );
} else {
	$dsn_faq_groups = dsn_faq_group( $wp_query->posts, array( $dsn_faq_line ) );
}

// FAQs not matching ?q= stay in the page (for the live search) but hidden.
$dsn_faq_hide = array();
$dsn_faq_all  = array();
foreach ( $dsn_faq_groups as $dsn_faq_g ) {
	foreach ( $dsn_faq_g['faqs'] as $dsn_faq_f ) {
		$dsn_faq_all[ $dsn_faq_f->ID ] = $dsn_faq_f;
	}
}
$dsn_faq_all = array_values( $dsn_faq_all );
if ( '' !== $dsn_faq_q ) {
	$dsn_faq_hide = array_values( array_diff( wp_list_pluck( $dsn_faq_all, 'ID' ), wp_list_pluck( dsn_faq_search( $dsn_faq_all, $dsn_faq_q ), 'ID' ) ) );
}
$dsn_faq_total = count( $dsn_faq_all ) - count( $dsn_faq_hide );

$dsn_faq_intro = $dsn_faq_term->description
	? $dsn_faq_term->description
	/* translators: %s: product line or topic, e.g. Hot Tubs */
	: sprintf( __( 'Straight answers about %s from our experts. Get the quick answer in seconds, or read the full answer when you want the detail.', 'dsnshowcase' ), $dsn_faq_term->name );
?>
<div class="dsn-faq" data-faq-root>

	<section class="dsn:relative dsn:isolate dsn:overflow-hidden dsn:bg-faq-surface">
		<div class="dsn:pointer-events-none dsn:absolute dsn:-right-32 dsn:-top-32 dsn:-z-10 dsn:h-[520px] dsn:w-[520px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-primary)_16%,transparent),transparent_65%)]"></div>
		<div class="dsn:pointer-events-none dsn:absolute dsn:-bottom-40 dsn:-left-24 dsn:-z-10 dsn:h-[420px] dsn:w-[420px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-accent)_14%,transparent),transparent_65%)]"></div>
		<div class="faq-container dsn:py-14 dsn:text-center dsn:sm:py-20">
			<nav class="dsn:mb-4 dsn:flex dsn:flex-wrap dsn:items-center dsn:justify-center dsn:gap-2 dsn:text-sm dsn:font-semibold" aria-label="<?php esc_attr_e( 'Breadcrumb', 'dsnshowcase' ); ?>">
				<a class="dsn:inline-flex dsn:items-center dsn:gap-1.5 dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( $dsn_faq_landing ); ?>"><?php dsn_faq_the_icon( 'arrow-l', 'dsn:h-4 dsn:w-4' ); ?><?php esc_html_e( 'All FAQs', 'dsnshowcase' ); ?></a>
				<?php if ( ! $dsn_faq_is_line ) : ?>
					<span class="dsn:text-faq-ink/35" aria-hidden="true">/</span>
					<a class="dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>"><?php echo esc_html( $dsn_faq_line->name ); ?></a>
				<?php endif; ?>
			</nav>
			<h1 class="dsn:mx-auto dsn:mt-2 dsn:max-w-4xl dsn:font-faq-display dsn:text-4xl dsn:leading-[1.05] dsn:tracking-tight dsn:text-faq-ink dsn:text-balance dsn:sm:text-5xl dsn:lg:text-6xl">
				<?php
				/* translators: %s: product line or topic, e.g. Hot Tubs */
				echo esc_html( $dsn_faq_is_line ? sprintf( __( '%s FAQs', 'dsnshowcase' ), $dsn_faq_term->name ) : $dsn_faq_term->name );
				?>
			</h1>
			<p class="dsn:mx-auto dsn:mt-5 dsn:max-w-2xl dsn:text-lg dsn:leading-relaxed dsn:text-faq-ink/65"><?php echo esc_html( $dsn_faq_intro ); ?></p>

			<form class="dsn:mx-auto dsn:mt-9 dsn:max-w-2xl" role="search" action="<?php echo esc_url( get_term_link( $dsn_faq_term ) ); ?>" method="get" data-faq-search-form>
				<label for="dsn-faq-search" class="dsn:sr-only"><?php esc_html_e( 'Search FAQs', 'dsnshowcase' ); ?></label>
				<div class="dsn:relative">
					<span class="dsn:pointer-events-none dsn:absolute dsn:left-5 dsn:top-1/2 dsn:-translate-y-1/2 dsn:text-faq-ink/40"><?php dsn_faq_the_icon( 'search', 'dsn:h-5 dsn:w-5' ); ?></span>
					<input id="dsn-faq-search" name="q" type="search" autocomplete="off" value="<?php echo esc_attr( $dsn_faq_q ); ?>" placeholder="<?php esc_attr_e( 'Search questions — heating, cost, winter…', 'dsnshowcase' ); ?>" class="faq-input dsn:rounded-full! dsn:py-4! dsn:pr-24 dsn:text-base dsn:shadow-faq-lift dsn:[padding-left:3.25rem]" data-faq-search>
					<button type="button" class="dsn:absolute dsn:right-4 dsn:top-1/2 dsn:hidden dsn:-translate-y-1/2 dsn:rounded-full dsn:bg-faq-ink/5 dsn:px-3 dsn:py-1 dsn:text-xs dsn:font-semibold dsn:text-faq-ink/70 dsn:hover:bg-faq-ink/10" data-faq-clear><?php esc_html_e( 'Clear', 'dsnshowcase' ); ?></button>
				</div>
			</form>
			<p class="dsn:mt-4 dsn:text-sm dsn:text-faq-ink/55" aria-live="polite" data-faq-status data-one="<?php esc_attr_e( '1 question', 'dsnshowcase' ); ?>" data-many="<?php esc_attr_e( '%d questions', 'dsnshowcase' ); ?>">
				<?php /* translators: %d: number of FAQs */ echo esc_html( sprintf( _n( '%d question', '%d questions', $dsn_faq_total, 'dsnshowcase' ), $dsn_faq_total ) ); ?>
			</p>
		</div>
	</section>

	<section class="faq-section dsn:pt-12 dsn:sm:pt-14 dsn:lg:pt-16">
		<div class="faq-container dsn:grid dsn:grid-cols-1 dsn:gap-10 dsn:lg:grid-cols-[18rem_minmax(0,1fr)] dsn:lg:gap-20">

			<aside class="dsn:min-w-0 dsn:lg:sticky dsn:lg:top-[calc(var(--header-h,80px)+1.5rem)] dsn:lg:self-start" aria-label="<?php esc_attr_e( 'FAQ topics', 'dsnshowcase' ); ?>">
				<?php if ( $dsn_faq_topics ) : ?>
					<p class="faq-eyebrow dsn:mb-4 dsn:hidden dsn:text-faq-ink/50 dsn:lg:block"><?php esc_html_e( 'Browse by topic', 'dsnshowcase' ); ?></p>
					<nav class="faq-no-scrollbar dsn:-mx-4 dsn:flex dsn:gap-2 dsn:overflow-x-auto dsn:px-4 dsn:pb-1 dsn:sm:-mx-6 dsn:sm:px-6 dsn:lg:mx-0 dsn:lg:flex-col dsn:lg:gap-1.5 dsn:lg:overflow-visible dsn:lg:px-0 dsn:lg:pb-0">
						<a href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>" class="faq-chip dsn:lg:justify-start dsn:lg:rounded-faq-card! dsn:lg:px-4! dsn:lg:py-3! <?php echo $dsn_faq_is_line ? 'faq-chip--active' : ''; ?>" data-faq-nav-all>
							<?php dsn_faq_the_icon( 'grid', 'dsn:h-4 dsn:w-4' ); ?><span><?php esc_html_e( 'All topics', 'dsnshowcase' ); ?></span>
						</a>
						<?php
						foreach ( $dsn_faq_topics as $dsn_faq_t ) :
							$dsn_faq_current = (int) $dsn_faq_t->term_id === (int) $dsn_faq_term->term_id;
							$dsn_faq_href    = $dsn_faq_is_line ? '#cat-' . $dsn_faq_t->slug : get_term_link( $dsn_faq_t );
							?>
							<a href="<?php echo esc_url( $dsn_faq_href ); ?>" class="faq-chip dsn:lg:justify-start dsn:lg:rounded-faq-card! dsn:lg:px-4! dsn:lg:py-3! <?php echo $dsn_faq_current ? 'faq-chip--active' : ''; ?>" data-faq-nav="<?php echo esc_attr( $dsn_faq_t->slug ); ?>"<?php echo $dsn_faq_current ? ' aria-current="page"' : ''; ?>>
								<?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_t ), 'dsn:h-4 dsn:w-4' ); ?>
								<span><?php echo esc_html( dsn_faq_short_cat( $dsn_faq_t->name ) ); ?></span>
								<span class="dsn:ml-auto dsn:hidden dsn:rounded-full dsn:bg-faq-ink/5 dsn:px-2 dsn:py-0.5 dsn:text-xs dsn:lg:inline"><?php echo esc_html( $dsn_faq_t->count ); ?></span>
							</a>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>

				<div class="dsn:mt-8 dsn:hidden dsn:rounded-faq-card dsn:bg-faq-ink dsn:p-6 dsn:text-white dsn:lg:block <?php echo $dsn_faq_topics ? '' : 'dsn:lg:mt-0'; ?>">
					<p class="dsn:font-faq-display dsn:text-xl"><?php esc_html_e( 'Can’t find your answer?', 'dsnshowcase' ); ?></p>
					<p class="dsn:mt-2 dsn:text-sm dsn:leading-relaxed dsn:text-white/70"><?php esc_html_e( 'One of our specialists will get back to you fast.', 'dsnshowcase' ); ?></p>
					<div class="dsn:mt-5 dsn:flex dsn:flex-col dsn:gap-2">
						<?php echo dsn_faq_ask_button( __( 'Ask our team', 'dsnshowcase' ), 'faq-btn faq-btn-accent faq-btn-sm', array( 'title' => __( 'Ask our team', 'dsnshowcase' ), 'source' => 'faq-sidebar' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php if ( dsn_faq_opt( 'phone' ) ) : ?>
							<a href="<?php echo esc_url( dsn_faq_tel() ); ?>" class="faq-btn faq-btn-ghost-light faq-btn-sm" data-track="call"><?php dsn_faq_the_icon( 'phone', 'dsn:h-4 dsn:w-4' ); ?><?php echo esc_html( dsn_faq_opt( 'phone' ) ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</aside>

			<div class="dsn:min-w-0">
				<div class="dsn:mb-8 dsn:flex dsn:items-center dsn:justify-between dsn:gap-3">
					<p class="dsn:text-sm dsn:text-faq-ink/55"><?php esc_html_e( 'Tap a question to see the answer.', 'dsnshowcase' ); ?></p>
					<button type="button" class="dsn:shrink-0 dsn:text-sm dsn:font-semibold dsn:text-faq-action dsn:hover:underline" data-faq-expand-all data-expand="<?php esc_attr_e( 'Expand all', 'dsnshowcase' ); ?>" data-collapse="<?php esc_attr_e( 'Collapse all', 'dsnshowcase' ); ?>" hidden><?php esc_html_e( 'Expand all', 'dsnshowcase' ); ?></button>
				</div>

				<?php
				foreach ( $dsn_faq_groups as $dsn_faq_g ) :
					$dsn_faq_shown = array_diff( wp_list_pluck( $dsn_faq_g['faqs'], 'ID' ), $dsn_faq_hide );
					?>
					<section id="cat-<?php echo esc_attr( $dsn_faq_g['term']->slug ); ?>" class="dsn:mb-20 dsn:scroll-mt-[calc(var(--header-h,80px)+1.5rem)] dsn:last-of-type:mb-0 dsn:lg:mb-24" data-faq-group<?php echo $dsn_faq_shown ? '' : ' hidden'; ?>>
						<header class="dsn:mb-6 dsn:flex dsn:items-center dsn:gap-4">
							<span class="dsn:grid dsn:h-12 dsn:w-12 dsn:shrink-0 dsn:place-items-center dsn:rounded-faq-card dsn:bg-faq-primary/10 dsn:text-faq-primary"><?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_g['term'] ), 'dsn:h-6 dsn:w-6' ); ?></span>
							<div>
								<h2 class="dsn:font-faq-display dsn:text-2xl dsn:leading-tight dsn:text-faq-ink dsn:sm:text-3xl"><?php echo esc_html( $dsn_faq_g['term']->name ); ?></h2>
								<?php if ( ! empty( $dsn_faq_g['term']->description ) && $dsn_faq_is_line ) : ?>
									<p class="dsn:mt-1 dsn:text-sm dsn:text-faq-ink/55"><?php echo esc_html( $dsn_faq_g['term']->description ); ?></p>
								<?php endif; ?>
							</div>
						</header>
						<?php dsn_faq_render_items( $dsn_faq_g['faqs'], $dsn_faq_hide ); ?>
					</section>
				<?php endforeach; ?>

				<?php if ( ! $dsn_faq_groups ) : ?>
					<p class="dsn:rounded-faq-card dsn:bg-faq-surface dsn:p-10 dsn:text-center dsn:text-faq-ink/60"><?php esc_html_e( 'No FAQs have been published yet.', 'dsnshowcase' ); ?></p>
				<?php endif; ?>

				<div class="dsn:rounded-faq-card dsn:border dsn:border-dashed dsn:border-faq-ink/20 dsn:p-10 dsn:text-center <?php echo $dsn_faq_groups && ! $dsn_faq_total ? '' : 'dsn:hidden'; ?>" data-faq-empty>
					<p class="dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink"><?php esc_html_e( 'No matching questions', 'dsnshowcase' ); ?></p>
					<p class="dsn:mt-2 dsn:text-faq-ink/60"><?php esc_html_e( 'Try a different word, or ask us directly — we’ll reply fast.', 'dsnshowcase' ); ?></p>
					<div class="dsn:mt-5"><?php echo dsn_faq_ask_button( __( 'Ask our team', 'dsnshowcase' ), 'faq-btn faq-btn-accent', array( 'title' => __( 'Ask our team', 'dsnshowcase' ), 'source' => 'faq-search' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/faq/cta' ); ?>
</div>
