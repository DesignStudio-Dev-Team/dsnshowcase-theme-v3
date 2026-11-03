<?php
/**
 * FAQ landing page, "Explorer" layout (/faqs/ or the page using the FAQs
 * template; the other layout is landing-concierge.php):
 *
 * - dark hero with an instant-answer search (suggestions with the quick
 *   answer as you type), popular questions and a few numbers;
 * - product explorer: a tab per product line, each with its topics and its
 *   most-asked questions;
 * - the company questions in two columns, next to ways to reach the team.
 *
 * Without JavaScript the search is a plain GET (?q=, results rendered on the
 * server) and every product panel is shown one after the other; all answers
 * are in the HTML. assets/js/faq.js adds the suggestions and the tabs.
 * Headings and intro texts can be edited on the FAQs page (dsn_faq_copy()).
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

$dsn_faq_q       = dsn_faq_query();
$dsn_faq_url     = get_post_type_archive_link( DSN_FAQ_CPT );
$dsn_faq_posts   = dsn_faq_landing_posts();
$dsn_faq_company = dsn_faq_company();
$dsn_faq_by_line = dsn_faq_group( $dsn_faq_posts, dsn_faq_lines() );
$dsn_faq_lines   = wp_list_pluck( $dsn_faq_by_line, 'term' );
$dsn_faq_topic_n = 0;
foreach ( $dsn_faq_lines as $dsn_faq_line ) {
	$dsn_faq_topic_n += count( dsn_faq_topics( $dsn_faq_line ) );
}

// Company questions, split into two columns.
$dsn_faq_company_faqs = array();
if ( $dsn_faq_company ) {
	$dsn_faq_cg           = dsn_faq_group( $dsn_faq_posts, array( $dsn_faq_company ) );
	$dsn_faq_company_faqs = $dsn_faq_cg ? $dsn_faq_cg[ $dsn_faq_company->term_id ]['faqs'] : array();
}
$dsn_faq_half = (int) ceil( count( $dsn_faq_company_faqs ) / 2 );

// Popular questions: the first question of each product line, then the first company one.
$dsn_faq_popular = array();
foreach ( $dsn_faq_by_line as $dsn_faq_g ) {
	$dsn_faq_popular[] = $dsn_faq_g['faqs'][0];
}
if ( $dsn_faq_company_faqs ) {
	$dsn_faq_popular[] = $dsn_faq_company_faqs[0];
}

// Instant search index: question, quick answer, link and product line of every FAQ.
$dsn_faq_index = array();
foreach ( $dsn_faq_posts as $dsn_faq_p ) {
	$dsn_faq_terms   = get_the_terms( $dsn_faq_p, DSN_FAQ_TAX );
	$dsn_faq_index[] = array(
		'q' => dsn_faq_text( get_the_title( $dsn_faq_p ) ),
		'a' => dsn_faq_text( dsn_faq_short( $dsn_faq_p ) ),
		'u' => get_permalink( $dsn_faq_p ),
		'c' => $dsn_faq_terms && ! is_wp_error( $dsn_faq_terms ) ? dsn_faq_text( dsn_faq_line_of( $dsn_faq_terms[0] )->name ) : '',
	);
}
$dsn_faq_hours = array_filter( array_map( 'trim', explode( "\n", (string) dsn_faq_opt( 'hours' ) ) ) );
?>
<div class="dsn-faq" data-faq-root>

	<section class="dsn:relative dsn:isolate dsn:overflow-hidden dsn:bg-faq-ink dsn:text-white">
		<div class="dsn:pointer-events-none dsn:absolute dsn:-right-40 dsn:-top-40 dsn:-z-10 dsn:h-[640px] dsn:w-[640px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-primary)_55%,transparent),transparent_65%)]"></div>
		<div class="dsn:pointer-events-none dsn:absolute dsn:-bottom-56 dsn:-left-40 dsn:-z-10 dsn:h-[560px] dsn:w-[560px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-accent)_35%,transparent),transparent_65%)]"></div>
		<div class="dsn:pointer-events-none dsn:absolute dsn:inset-0 dsn:-z-10 dsn:bg-[radial-gradient(rgb(255_255_255/.07)_1px,transparent_1px)] dsn:[background-size:22px_22px]"></div>
		<div class="faq-container dsn:py-16 dsn:text-center dsn:sm:py-24">
			<p class="faq-eyebrow dsn:text-faq-accent faq-hero-in"><?php echo esc_html( dsn_faq_copy( 'eyebrow', __( 'Help center', 'dsnshowcase' ) ) ); ?></p>
			<h1 class="faq-hero-in dsn:mx-auto dsn:mt-3 dsn:max-w-4xl dsn:font-faq-display dsn:text-4xl dsn:leading-[1.05] dsn:tracking-tight dsn:text-balance dsn:sm:text-6xl dsn:lg:text-7xl" style="--d:80ms"><?php echo esc_html( dsn_faq_copy( 'title', __( 'How can we help?', 'dsnshowcase' ) ) ); ?></h1>
			<div class="faq-hero-in dsn:mx-auto dsn:mt-5 dsn:max-w-2xl dsn:text-lg dsn:leading-relaxed dsn:text-white/70 dsn:[&>*+*]:mt-4 dsn:[&_a]:text-white dsn:[&_a]:underline" style="--d:160ms"><?php echo dsn_faq_intro( __( 'Type a question and get the answer instantly — or explore everything by product below.', 'dsnshowcase' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

			<form class="faq-hero-in dsn:relative dsn:mx-auto dsn:mt-10 dsn:max-w-2xl dsn:text-left" style="--d:240ms" role="search" action="<?php echo esc_url( $dsn_faq_url ); ?>" method="get" data-faq-instant-form>
				<?php dsn_faq_layout_field(); ?>
				<label for="dsn-faq-instant" class="dsn:sr-only"><?php esc_html_e( 'Search all FAQs', 'dsnshowcase' ); ?></label>
				<div class="dsn:relative">
					<span class="dsn:pointer-events-none dsn:absolute dsn:left-5 dsn:top-1/2 dsn:-translate-y-1/2 dsn:text-faq-ink/40"><?php dsn_faq_the_icon( 'search', 'dsn:h-5 dsn:w-5' ); ?></span>
					<input id="dsn-faq-instant" name="q" type="search" autocomplete="off" value="<?php echo esc_attr( $dsn_faq_q ); ?>" placeholder="<?php esc_attr_e( 'Ask anything — cost, delivery, winter, store hours…', 'dsnshowcase' ); ?>" class="faq-input dsn:rounded-full! dsn:border-transparent! dsn:py-5! dsn:pr-32 dsn:text-base dsn:shadow-2xl dsn:[padding-left:3.25rem]" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="dsn-faq-suggest" data-faq-instant>
					<button type="submit" class="faq-btn faq-btn-accent dsn:absolute dsn:right-2 dsn:top-1/2 dsn:-translate-y-1/2 dsn:rounded-full!"><?php esc_html_e( 'Search', 'dsnshowcase' ); ?></button>
				</div>
				<div class="dsn:absolute dsn:inset-x-0 dsn:top-full dsn:z-30 dsn:mt-3 dsn:overflow-hidden dsn:rounded-faq-card dsn:bg-white dsn:text-faq-ink dsn:shadow-2xl dsn:ring-1 dsn:ring-faq-ink/10" data-faq-suggest-box hidden>
					<ul id="dsn-faq-suggest" class="dsn:m-0 dsn:max-h-[60vh] dsn:list-none dsn:overflow-y-auto dsn:p-2" role="listbox" aria-label="<?php esc_attr_e( 'Matching questions', 'dsnshowcase' ); ?>" data-faq-suggest></ul>
					<p class="dsn:m-0 dsn:border-t dsn:border-faq-ink/10 dsn:bg-faq-surface dsn:px-5 dsn:py-3 dsn:text-sm" data-faq-suggest-foot>
						<button type="submit" class="dsn:font-semibold dsn:text-faq-action dsn:hover:underline" data-faq-suggest-all data-label="<?php /* translators: %s: search text */ esc_attr_e( 'Search every answer for “%s” →', 'dsnshowcase' ); ?>"></button>
					</p>
					<p class="dsn:m-0 dsn:px-5 dsn:py-6 dsn:text-center dsn:text-sm dsn:text-faq-ink/60" data-faq-suggest-empty hidden><?php esc_html_e( 'No matching questions yet — press Enter to search every answer, or ask our team.', 'dsnshowcase' ); ?></p>
				</div>
				<script type="application/json" data-faq-index><?php echo wp_json_encode( $dsn_faq_index, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?></script>
			</form>

			<?php if ( $dsn_faq_popular && '' === $dsn_faq_q ) : ?>
				<div class="faq-hero-in dsn:mx-auto dsn:mt-6 dsn:flex dsn:max-w-3xl dsn:flex-wrap dsn:items-center dsn:justify-center dsn:gap-2" style="--d:320ms">
					<span class="dsn:text-sm dsn:font-semibold dsn:text-white/55"><?php esc_html_e( 'Popular:', 'dsnshowcase' ); ?></span>
					<?php foreach ( $dsn_faq_popular as $dsn_faq_p ) : ?>
						<a href="<?php echo esc_url( get_permalink( $dsn_faq_p ) ); ?>" class="dsn:rounded-full dsn:border dsn:border-white/15 dsn:bg-white/5 dsn:px-3.5 dsn:py-1.5 dsn:text-sm dsn:text-white/85 dsn:backdrop-blur dsn:transition dsn:hover:border-white/40 dsn:hover:bg-white/10 dsn:hover:text-white"><?php echo esc_html( get_the_title( $dsn_faq_p ) ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<dl class="faq-hero-in dsn:mx-auto dsn:mt-12 dsn:grid dsn:max-w-3xl dsn:grid-cols-3 dsn:gap-4 dsn:border-t dsn:border-white/10 dsn:pt-8" style="--d:400ms">
				<?php
				foreach (
					array(
						array( count( $dsn_faq_posts ), __( 'answers', 'dsnshowcase' ) ),
						array( count( $dsn_faq_lines ), __( 'products', 'dsnshowcase' ) ),
						array( $dsn_faq_topic_n, __( 'topics', 'dsnshowcase' ) ),
					) as $dsn_faq_stat
				) :
					?>
					<div>
						<dt class="dsn:sr-only"><?php echo esc_html( $dsn_faq_stat[1] ); ?></dt>
						<dd class="dsn:m-0"><span class="dsn:block dsn:font-faq-display dsn:text-3xl dsn:sm:text-4xl"><?php echo (int) $dsn_faq_stat[0]; ?></span><span class="dsn:mt-1 dsn:block dsn:text-xs dsn:font-semibold dsn:uppercase dsn:tracking-[.18em] dsn:text-white/55"><?php echo esc_html( $dsn_faq_stat[1] ); ?></span></dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
	</section>

	<?php if ( '' !== $dsn_faq_q ) : ?>

		<?php get_template_part( 'templates/faq/search-results' ); ?>

	<?php else : ?>

		<?php if ( $dsn_faq_by_line ) : ?>
			<section class="faq-section dsn:pt-14 dsn:sm:pt-16 dsn:lg:pt-20">
				<div class="faq-container">
					<?php dsn_faq_section_heading( dsn_faq_copy( 'lines_eyebrow', __( 'Explore by product', 'dsnshowcase' ) ), dsn_faq_copy( 'lines_title', __( 'Pick a product, find your answer', 'dsnshowcase' ) ), dsn_faq_copy( 'lines_text', __( 'Jump into a topic or open one of the most-asked questions.', 'dsnshowcase' ) ) ); ?>

					<div class="faq-no-scrollbar dsn:-mx-4 dsn:mt-10 dsn:flex dsn:justify-start dsn:gap-2 dsn:overflow-x-auto dsn:px-4 dsn:pb-1 dsn:sm:mx-0 dsn:sm:justify-center dsn:sm:px-0" role="tablist" aria-label="<?php esc_attr_e( 'Products', 'dsnshowcase' ); ?>" data-faq-tabs hidden>
						<?php foreach ( $dsn_faq_by_line as $dsn_faq_g ) : ?>
							<button type="button" role="tab" id="tab-<?php echo esc_attr( $dsn_faq_g['term']->slug ); ?>" class="dsn:tab dsn:inline-flex dsn:items-center dsn:gap-2 dsn:px-5! dsn:py-3! dsn:text-[15px] dsn:ring-1 dsn:ring-faq-ink/10 dsn:aria-selected:ring-faq-ink" aria-selected="false" aria-controls="line-<?php echo esc_attr( $dsn_faq_g['term']->slug ); ?>" tabindex="-1" data-faq-tab="<?php echo esc_attr( $dsn_faq_g['term']->slug ); ?>">
								<?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_g['term'] ), 'dsn:h-5 dsn:w-5' ); ?>
								<?php echo esc_html( $dsn_faq_g['term']->name ); ?>
								<span class="dsn:text-xs dsn:opacity-60"><?php echo (int) count( $dsn_faq_g['faqs'] ); ?></span>
							</button>
						<?php endforeach; ?>
					</div>

					<?php
					foreach ( $dsn_faq_by_line as $dsn_faq_g ) :
						$dsn_faq_line   = $dsn_faq_g['term'];
						$dsn_faq_topics = dsn_faq_topics( $dsn_faq_line );
						$dsn_faq_count  = count( $dsn_faq_g['faqs'] );
						?>
						<section id="line-<?php echo esc_attr( $dsn_faq_line->slug ); ?>" class="faq-tabpanel dsn:mt-12 dsn:scroll-mt-[calc(var(--header-h,80px)+1.5rem)] dsn:rounded-faq-card dsn:bg-faq-surface dsn:p-6 dsn:ring-1 dsn:ring-faq-ink/5 dsn:sm:p-10" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr( $dsn_faq_line->slug ); ?>" data-faq-panel="<?php echo esc_attr( $dsn_faq_line->slug ); ?>">
							<div class="dsn:grid dsn:gap-10 dsn:lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] dsn:lg:gap-14">
								<div>
									<div class="dsn:flex dsn:items-center dsn:gap-4">
										<span class="dsn:grid dsn:h-14 dsn:w-14 dsn:shrink-0 dsn:place-items-center dsn:rounded-faq-card dsn:bg-faq-primary dsn:text-white dsn:shadow-faq-soft"><?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_line ), 'dsn:h-7 dsn:w-7' ); ?></span>
										<div>
											<h2 class="dsn:font-faq-display dsn:text-3xl dsn:leading-tight dsn:text-faq-ink"><?php echo esc_html( $dsn_faq_line->name ); ?></h2>
											<p class="dsn:text-sm dsn:font-semibold dsn:text-faq-ink/50"><?php /* translators: %d: number of FAQs */ echo esc_html( sprintf( _n( '%d question', '%d questions', $dsn_faq_count, 'dsnshowcase' ), $dsn_faq_count ) ); ?></p>
										</div>
									</div>
									<?php if ( $dsn_faq_line->description ) : ?>
										<p class="dsn:mt-4 dsn:leading-relaxed dsn:text-faq-ink/65"><?php echo esc_html( $dsn_faq_line->description ); ?></p>
									<?php endif; ?>

									<?php if ( $dsn_faq_topics ) : ?>
										<p class="faq-eyebrow dsn:mb-3 dsn:mt-8 dsn:text-faq-ink/50"><?php esc_html_e( 'Topics', 'dsnshowcase' ); ?></p>
										<ul class="dsn:m-0 dsn:grid dsn:list-none dsn:gap-2.5 dsn:p-0 dsn:sm:grid-cols-2">
											<?php foreach ( $dsn_faq_topics as $dsn_faq_t ) : ?>
												<li>
													<a href="<?php echo esc_url( get_term_link( $dsn_faq_t ) ); ?>" class="dsn:group dsn:flex dsn:h-full dsn:items-center dsn:gap-3 dsn:rounded-faq-btn dsn:bg-white dsn:p-3.5 dsn:ring-1 dsn:ring-faq-ink/10 dsn:transition dsn:hover:-translate-y-0.5 dsn:hover:shadow-faq-soft dsn:hover:ring-faq-primary/40">
														<span class="dsn:grid dsn:h-9 dsn:w-9 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-primary/10 dsn:text-faq-primary dsn:transition dsn:group-hover:bg-faq-primary dsn:group-hover:text-white"><?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_t ), 'dsn:h-4 dsn:w-4' ); ?></span>
														<span class="dsn:min-w-0 dsn:flex-1">
															<span class="dsn:block dsn:font-semibold dsn:leading-snug dsn:text-faq-ink"><?php echo esc_html( dsn_faq_short_cat( $dsn_faq_t->name ) ); ?></span>
															<span class="dsn:block dsn:text-xs dsn:text-faq-ink/50"><?php /* translators: %d: number of FAQs */ echo esc_html( sprintf( _n( '%d question', '%d questions', $dsn_faq_t->count, 'dsnshowcase' ), $dsn_faq_t->count ) ); ?></span>
														</span>
														<?php dsn_faq_the_icon( 'arrow', 'dsn:h-4 dsn:w-4 dsn:shrink-0 dsn:text-faq-action dsn:transition dsn:group-hover:translate-x-0.5' ); ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<a href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>" class="faq-btn faq-btn-primary dsn:mt-8">
										<?php
										/* translators: 1: number of FAQs, 2: product line, e.g. Hot Tubs */
										echo esc_html( sprintf( __( 'See all %1$d %2$s FAQs', 'dsnshowcase' ), $dsn_faq_count, $dsn_faq_line->name ) );
										?>
										<?php dsn_faq_the_icon( 'arrow', 'dsn:h-4 dsn:w-4' ); ?>
									</a>
								</div>

								<div class="dsn:min-w-0">
									<p class="faq-eyebrow dsn:mb-4 dsn:text-faq-ink/50"><?php esc_html_e( 'Most asked', 'dsnshowcase' ); ?></p>
									<?php dsn_faq_render_items( array_slice( $dsn_faq_g['faqs'], 0, 5 ) ); ?>
								</div>
							</div>
						</section>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $dsn_faq_company_faqs ) : ?>
			<section id="company" class="faq-section dsn:bg-faq-surface">
				<div class="faq-container">
					<?php
					dsn_faq_section_heading(
						dsn_faq_copy( 'company_eyebrow', __( 'Our company', 'dsnshowcase' ) ),
						/* translators: %s: site name */
						dsn_faq_copy( 'company_title', sprintf( __( 'Questions about %s', 'dsnshowcase' ), get_bloginfo( 'name' ) ) ),
						dsn_faq_copy( 'company_text', $dsn_faq_company->description )
					);
					?>
					<div class="dsn:mt-12 dsn:grid dsn:gap-4 dsn:lg:grid-cols-2 dsn:lg:gap-6">
						<div class="dsn:min-w-0"><?php dsn_faq_render_items( array_slice( $dsn_faq_company_faqs, 0, $dsn_faq_half ) ); ?></div>
						<div class="dsn:min-w-0"><?php dsn_faq_render_items( array_slice( $dsn_faq_company_faqs, $dsn_faq_half ) ); ?></div>
					</div>

					<ul class="dsn:m-0 dsn:mt-12 dsn:grid dsn:list-none dsn:gap-4 dsn:p-0 dsn:sm:grid-cols-3">
						<?php if ( dsn_faq_opt( 'phone' ) ) : ?>
							<li>
								<a href="<?php echo esc_url( dsn_faq_tel() ); ?>" class="dsn:group dsn:flex dsn:h-full dsn:items-center dsn:gap-4 dsn:rounded-faq-card dsn:bg-white dsn:p-5 dsn:ring-1 dsn:ring-faq-ink/10 dsn:transition dsn:hover:shadow-faq-soft dsn:hover:ring-faq-primary/40" data-track="call">
									<span class="dsn:grid dsn:h-12 dsn:w-12 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-primary/10 dsn:text-faq-primary"><?php dsn_faq_the_icon( 'phone', 'dsn:h-5 dsn:w-5' ); ?></span>
									<span><span class="dsn:block dsn:text-sm dsn:text-faq-ink/55"><?php esc_html_e( 'Call us', 'dsnshowcase' ); ?></span><span class="dsn:block dsn:font-semibold dsn:text-faq-ink"><?php echo esc_html( dsn_faq_opt( 'phone' ) ); ?></span></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $dsn_faq_hours ) : ?>
							<li>
								<a href="<?php echo esc_url( dsn_faq_map_url() ); ?>" class="dsn:group dsn:flex dsn:h-full dsn:items-center dsn:gap-4 dsn:rounded-faq-card dsn:bg-white dsn:p-5 dsn:ring-1 dsn:ring-faq-ink/10 dsn:transition dsn:hover:shadow-faq-soft dsn:hover:ring-faq-primary/40" target="_blank" rel="noopener">
									<span class="dsn:grid dsn:h-12 dsn:w-12 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-primary/10 dsn:text-faq-primary"><?php dsn_faq_the_icon( 'clock', 'dsn:h-5 dsn:w-5' ); ?></span>
									<span><span class="dsn:block dsn:text-sm dsn:text-faq-ink/55"><?php esc_html_e( 'Visit the showroom', 'dsnshowcase' ); ?></span><span class="dsn:block dsn:font-semibold dsn:text-faq-ink"><?php echo esc_html( reset( $dsn_faq_hours ) ); ?></span></span>
								</a>
							</li>
						<?php endif; ?>
						<li>
							<div class="dsn:flex dsn:h-full dsn:items-center dsn:gap-4 dsn:rounded-faq-card dsn:bg-faq-ink dsn:p-5 dsn:text-white">
								<span class="dsn:grid dsn:h-12 dsn:w-12 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-white/10 dsn:text-faq-accent"><?php dsn_faq_the_icon( 'mail', 'dsn:h-5 dsn:w-5' ); ?></span>
								<span class="dsn:flex-1"><span class="dsn:block dsn:text-sm dsn:text-white/60"><?php esc_html_e( 'Still wondering?', 'dsnshowcase' ); ?></span>
								<?php echo dsn_faq_ask_button( __( 'Ask our team', 'dsnshowcase' ), 'dsn:mt-0.5 dsn:block dsn:font-semibold dsn:text-white dsn:underline-offset-4 dsn:hover:underline', array( 'title' => __( 'Ask our team', 'dsnshowcase' ), 'source' => 'faq-company' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</div>
						</li>
					</ul>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( ! $dsn_faq_by_line && ! $dsn_faq_company_faqs ) : ?>
			<section class="faq-section">
				<p class="faq-container dsn:rounded-faq-card dsn:bg-faq-surface dsn:p-10 dsn:text-center dsn:text-faq-ink/60"><?php esc_html_e( 'No FAQs have been published yet.', 'dsnshowcase' ); ?></p>
			</section>
		<?php endif; ?>

	<?php endif; ?>

	<?php get_template_part( 'templates/faq/cta' ); ?>
</div>
