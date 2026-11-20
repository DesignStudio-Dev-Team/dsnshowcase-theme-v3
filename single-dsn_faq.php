<?php
/**
 * Single FAQ, on the single post pattern (single.php):
 *
 * - left column: the author from their profile
 *   (templates/faq/author.php; unless hidden on this FAQ, see
 *   "Quick answer" box), copy-link and share buttons, the "About this
 *   article" details and a sticky "Sections" list built from the page's
 *   H2s — Quick answer, The full answer, every H2 in the answer, Related
 *   questions;
 * - main column: quick answer, full answer, CTA and related questions;
 * - right column (wide screens): "Can't find your answer?" card.
 *
 * On phones the Sections list becomes a bar pinned under the header. The H2s
 * get anchor IDs on the server (inc/faq-helpers.php), so the links work without
 * JavaScript; assets/js/faq-toc.js adds the active-section highlight.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;
get_header();

while ( have_posts() ) :
	the_post();
	// The category the address is built from, so the breadcrumb matches the URL.
	$dsn_faq_term   = dsn_faq_permalink_term( get_post() );
	$dsn_faq_line   = $dsn_faq_term ? dsn_faq_line_of( $dsn_faq_term ) : null;
	$dsn_faq_author = dsn_faq_show_author();
	$dsn_faq_aid    = (int) get_the_author_meta( 'ID' );
	$dsn_faq_long   = dsn_faq_long();
	$dsn_faq_toc    = dsn_faq_toc_build( $dsn_faq_long );
	$dsn_faq_round  = 'dsn:grid dsn:h-10 dsn:w-10 dsn:place-items-center dsn:rounded-full dsn:bg-faq-ink dsn:text-white dsn:ring-1 dsn:ring-white/10 dsn:transition dsn:hover:bg-faq-primary';

	$dsn_faq_args = array(
		'post_type'      => DSN_FAQ_CPT,
		'posts_per_page' => 4,
		'post__not_in'   => array( get_the_ID() ),
		'orderby'        => 'rand',
		'no_found_rows'  => true,
	);
	if ( $dsn_faq_term ) {
		$dsn_faq_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => DSN_FAQ_TAX,
				'terms'    => array( $dsn_faq_term->term_id ),
			),
		);
	}
	$dsn_faq_related = new WP_Query( $dsn_faq_args );

	// Sections: the page's own H2s around the H2s inside the answer.
	$dsn_faq_items = array(
		array(
			'id'   => 'quick-answer',
			'text' => __( 'Quick answer', 'dsnshowcase' ),
		),
	);
	if ( '' !== $dsn_faq_long ) {
		$dsn_faq_items[] = array(
			'id'   => 'full-answer',
			'text' => __( 'The full answer', 'dsnshowcase' ),
		);
		$dsn_faq_items   = array_merge( $dsn_faq_items, $dsn_faq_toc['items'] );
	}
	if ( $dsn_faq_related->have_posts() ) {
		$dsn_faq_items[] = array(
			'id'   => 'related',
			'text' => __( 'Related questions', 'dsnshowcase' ),
		);
	}
	$dsn_faq_has = count( $dsn_faq_items ) >= 2;
	$dsn_faq_h2  = 'dsn:scroll-mt-[var(--toc-scroll,10rem)]';
	?>
	<div class="dsn-faq">
		<section class="dsn:relative dsn:isolate dsn:overflow-hidden dsn:bg-faq-surface">
			<div class="dsn:pointer-events-none dsn:absolute dsn:-right-32 dsn:-top-32 dsn:-z-10 dsn:h-[460px] dsn:w-[460px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-primary)_14%,transparent),transparent_65%)]"></div>
			<div class="faq-container dsn:py-12 dsn:sm:py-16">
				<nav class="dsn:mb-5 dsn:flex dsn:flex-wrap dsn:items-center dsn:gap-2 dsn:text-sm dsn:font-semibold" aria-label="<?php esc_attr_e( 'Breadcrumb', 'dsnshowcase' ); ?>">
					<a class="dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_post_type_archive_link( DSN_FAQ_CPT ) ); ?>"><?php esc_html_e( 'FAQs', 'dsnshowcase' ); ?></a>
					<?php
					// Every level of the URL: product line, topic, sub-topics…
					foreach ( $dsn_faq_term ? array_reverse( get_ancestors( $dsn_faq_term->term_id, DSN_FAQ_TAX, 'taxonomy' ) ) : array() as $dsn_faq_crumb_id ) :
						$dsn_faq_crumb = get_term( $dsn_faq_crumb_id, DSN_FAQ_TAX );
						if ( ! $dsn_faq_crumb || is_wp_error( $dsn_faq_crumb ) ) {
							continue;
						}
						?>
						<span class="dsn:text-faq-ink/35" aria-hidden="true">/</span>
						<a class="dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_term_link( $dsn_faq_crumb ) ); ?>"><?php echo esc_html( $dsn_faq_crumb->parent ? dsn_faq_short_cat( $dsn_faq_crumb->name ) : $dsn_faq_crumb->name ); ?></a>
					<?php endforeach; ?>
					<?php if ( $dsn_faq_term ) : ?>
						<span class="dsn:text-faq-ink/35" aria-hidden="true">/</span>
						<a class="dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_term_link( $dsn_faq_term ) ); ?>"><?php echo esc_html( dsn_faq_short_cat( $dsn_faq_term->name ) ); ?></a>
					<?php endif; ?>
				</nav>
				<h1 class="dsn:max-w-4xl dsn:font-faq-display dsn:text-3xl dsn:leading-[1.1] dsn:tracking-tight dsn:text-faq-ink dsn:text-balance dsn:sm:text-5xl"><?php the_title(); ?></h1>
			</div>
		</section>

		<article <?php post_class( 'bg-white' ); ?>>
			<div class="faq-container dsn:py-10 dsn:sm:py-14 dsn:md:grid dsn:md:grid-cols-12 dsn:md:gap-x-8 dsn:lg:gap-x-12">

				<!-- Left column: author, actions, sections -->
				<div class="dsn:md:col-span-3" data-post-side data-post-id="<?php the_ID(); ?>" data-site="<?php echo esc_attr( home_url( '/' ) ); ?>">
					<?php
					if ( $dsn_faq_author ) {
						get_template_part(
							'templates/faq/author',
							null,
							array(
								'user'  => $dsn_faq_aid,
								'label' => __( 'Answered by', 'dsnshowcase' ),
							)
						);
					}
					?>

					<div class="dsn:flex dsn:gap-3 dsn:pb-5 dsn:md:pb-6">
						<button type="button" class="<?php echo esc_attr( $dsn_faq_round ); ?>" data-post-copy data-url="<?php echo esc_url( get_permalink() ); ?>" data-copied="<?php esc_attr_e( 'Link copied', 'dsnshowcase' ); ?>" aria-label="<?php esc_attr_e( 'Copy link to this answer', 'dsnshowcase' ); ?>" title="<?php esc_attr_e( 'Copy link', 'dsnshowcase' ); ?>"><?php dsn_faq_the_icon( 'link', 'dsn:h-[18px] dsn:w-[18px]', 2 ); ?></button>
						<button type="button" class="<?php echo esc_attr( $dsn_faq_round ); ?>" data-post-share data-url="<?php echo esc_url( get_permalink() ); ?>" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-copied="<?php esc_attr_e( 'Link copied', 'dsnshowcase' ); ?>" aria-label="<?php esc_attr_e( 'Share this answer', 'dsnshowcase' ); ?>" title="<?php esc_attr_e( 'Share', 'dsnshowcase' ); ?>"><?php dsn_faq_the_icon( 'share', 'dsn:h-[18px] dsn:w-[18px]', 2 ); ?></button>
					</div>

					<!-- About this article -->
					<dl class="dsn:mb-5 dsn:grid dsn:grid-cols-[auto_1fr] dsn:gap-x-4 dsn:gap-y-1.5 dsn:rounded-faq-card dsn:border dsn:border-faq-ink/10 dsn:bg-faq-surface dsn:p-4 dsn:text-sm dsn:text-faq-ink/80 dsn:md:mb-6" aria-label="<?php esc_attr_e( 'About this article', 'dsnshowcase' ); ?>">
						<dt class="dsn:font-semibold dsn:text-faq-ink"><?php esc_html_e( 'Published', 'dsnshowcase' ); ?></dt><dd><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></dd>
						<?php if ( get_the_modified_date( 'Ymd' ) !== get_the_date( 'Ymd' ) ) : ?>
							<dt class="dsn:font-semibold dsn:text-faq-ink"><?php esc_html_e( 'Updated', 'dsnshowcase' ); ?></dt><dd><time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time></dd>
						<?php endif; ?>
						<?php if ( $dsn_faq_line && (int) $dsn_faq_line->term_id !== (int) $dsn_faq_term->term_id ) : ?>
							<dt class="dsn:font-semibold dsn:text-faq-ink"><?php esc_html_e( 'Product', 'dsnshowcase' ); ?></dt><dd><a class="dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>"><?php echo esc_html( $dsn_faq_line->name ); ?></a></dd>
						<?php endif; ?>
						<?php if ( $dsn_faq_term ) : ?>
							<dt class="dsn:font-semibold dsn:text-faq-ink"><?php esc_html_e( 'Topic', 'dsnshowcase' ); ?></dt><dd><a class="dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( get_term_link( $dsn_faq_term ) ); ?>"><?php echo esc_html( dsn_faq_short_cat( $dsn_faq_term->name ) ); ?></a></dd>
						<?php endif; ?>
						<dt class="dsn:font-semibold dsn:text-faq-ink"><?php esc_html_e( 'Reading time', 'dsnshowcase' ); ?></dt><dd><?php echo esc_html( sprintf( /* translators: %d: minutes */ __( '%d min read', 'dsnshowcase' ), dsn_faq_reading_time() ) ); ?></dd>
					</dl>

					<?php if ( $dsn_faq_has ) : ?>
						<!-- Desktop: sticky Sections list -->
						<nav class="dsn:hidden dsn:md:sticky dsn:md:top-[calc(var(--toc-top,0px)+1rem)] dsn:md:block dsn:md:pb-8" aria-label="<?php esc_attr_e( 'Sections', 'dsnshowcase' ); ?>" data-post-sections>
							<p class="dsn:mb-2 dsn:text-xl dsn:text-faq-ink"><?php esc_html_e( 'Sections', 'dsnshowcase' ); ?></p>
							<ol class="dsn:m-0 dsn:max-h-[calc(100vh-14rem)] dsn:list-none dsn:overflow-y-auto dsn:rounded-faq-btn dsn:border dsn:border-faq-ink/15 dsn:bg-white dsn:p-0">
								<?php foreach ( $dsn_faq_items as $dsn_faq_n => $dsn_faq_t ) : ?>
									<li class="dsn:border-b dsn:border-faq-ink/10 dsn:last:border-b-0"><a class="dsn:block dsn:px-4 dsn:py-2.5 dsn:text-[15px] dsn:leading-snug dsn:text-faq-action dsn:transition dsn:hover:bg-faq-primary/5 dsn:aria-[current=location]:bg-faq-primary/10 dsn:aria-[current=location]:font-semibold" href="#<?php echo esc_attr( $dsn_faq_t['id'] ); ?>" data-toc-link data-i="<?php echo (int) $dsn_faq_n; ?>"><?php echo esc_html( $dsn_faq_t['text'] ); ?></a></li>
								<?php endforeach; ?>
							</ol>
						</nav>
					<?php endif; ?>
				</div>

				<!-- Main column -->
				<div class="dsn:min-w-0 dsn:md:col-span-9 dsn:xl:col-span-6" data-post-body>
					<?php if ( $dsn_faq_has ) : ?>
						<!-- Phones: Sections bar pinned under the header -->
						<nav class="dsn:sticky dsn:top-[calc(var(--toc-top,0px))] dsn:z-30 dsn:-mx-4 dsn:mb-6 dsn:border-b dsn:border-faq-ink/10 dsn:bg-white/95 dsn:backdrop-blur dsn:sm:-mx-6 dsn:md:hidden" aria-label="<?php esc_attr_e( 'On this page', 'dsnshowcase' ); ?>" data-post-toc>
							<div class="dsn:flex dsn:items-center dsn:gap-2 dsn:px-4 dsn:py-2.5 dsn:sm:px-6">
								<ol class="faq-no-scrollbar dsn:m-0 dsn:flex dsn:min-w-0 dsn:flex-1 dsn:list-none dsn:gap-2 dsn:overflow-x-auto dsn:p-0" data-toc-list>
									<?php foreach ( $dsn_faq_items as $dsn_faq_n => $dsn_faq_t ) : ?>
										<li class="dsn:flex"><a class="faq-chip dsn:max-w-[15rem]" href="#<?php echo esc_attr( $dsn_faq_t['id'] ); ?>" title="<?php echo esc_attr( $dsn_faq_t['text'] ); ?>" data-toc-link data-i="<?php echo (int) $dsn_faq_n; ?>"><span class="dsn:truncate"><?php echo esc_html( $dsn_faq_t['text'] ); ?></span></a></li>
									<?php endforeach; ?>
								</ol>
								<div class="dsn:flex dsn:shrink-0 dsn:gap-1">
									<button type="button" class="faq-icon-btn dsn:h-9! dsn:w-9! dsn:disabled:opacity-40" data-toc-prev aria-label="<?php esc_attr_e( 'Previous section', 'dsnshowcase' ); ?>"><?php dsn_faq_the_icon( 'arrow-up', 'dsn:h-4 dsn:w-4', 2.25 ); ?></button>
									<button type="button" class="faq-icon-btn dsn:h-9! dsn:w-9! dsn:disabled:opacity-40" data-toc-next aria-label="<?php esc_attr_e( 'Next section', 'dsnshowcase' ); ?>"><?php dsn_faq_the_icon( 'arrow-down', 'dsn:h-4 dsn:w-4', 2.25 ); ?></button>
								</div>
							</div>
							<div class="dsn:h-0.5 dsn:bg-faq-ink/10" aria-hidden="true"><i class="dsn:block dsn:h-full dsn:w-0 dsn:bg-faq-accent" data-toc-progress></i></div>
						</nav>
					<?php endif; ?>

					<div class="dsn:rounded-faq-card dsn:border-l-4 dsn:border-faq-accent dsn:bg-faq-primary/5 dsn:px-6 dsn:py-5">
						<h2 id="quick-answer" class="faq-eyebrow <?php echo esc_attr( $dsn_faq_h2 ); ?> dsn:font-faq-body dsn:text-faq-primary"><?php esc_html_e( 'Quick answer', 'dsnshowcase' ); ?></h2>
						<p class="dsn:mt-2 dsn:text-xl dsn:leading-relaxed dsn:text-faq-ink"><?php echo esc_html( dsn_faq_short() ); ?></p>
					</div>

					<?php if ( '' !== $dsn_faq_long ) : ?>
						<h2 id="full-answer" class="dsn:mb-4 dsn:mt-12 dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink dsn:sm:text-3xl <?php echo esc_attr( $dsn_faq_h2 ); ?>"><?php esc_html_e( 'The full answer', 'dsnshowcase' ); ?></h2>
						<div class="faq-prose dsn:[&_a]:text-faq-action dsn:[&_h2]:scroll-mt-[var(--toc-scroll,10rem)] dsn:[&_p]:text-pretty"><?php echo dsn_faq_no_widows( $dsn_faq_toc['html'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- the_content output. ?></div>
					<?php endif; ?>

					<div class="dsn:mt-10 dsn:flex dsn:flex-wrap dsn:items-center dsn:gap-3 dsn:rounded-faq-card dsn:bg-faq-surface dsn:p-5">
						<p class="dsn:mr-auto dsn:font-semibold dsn:text-faq-ink"><?php esc_html_e( 'Want advice for your home?', 'dsnshowcase' ); ?></p>
						<?php echo dsn_faq_ask_button( __( 'Ask our team', 'dsnshowcase' ), 'faq-btn faq-btn-accent', array( 'title' => __( 'Ask our team', 'dsnshowcase' ), 'source' => 'faq-single' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<?php if ( $dsn_faq_related->have_posts() ) : ?>
						<h2 id="related" class="dsn:mb-5 dsn:mt-14 dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink dsn:sm:text-3xl <?php echo esc_attr( $dsn_faq_h2 ); ?>"><?php esc_html_e( 'Related questions', 'dsnshowcase' ); ?></h2>
						<ul class="dsn:m-0 dsn:list-none dsn:space-y-3 dsn:p-0">
							<?php
							while ( $dsn_faq_related->have_posts() ) :
								$dsn_faq_related->the_post();
								?>
								<li>
									<a href="<?php the_permalink(); ?>" class="dsn:group dsn:flex dsn:items-start dsn:justify-between dsn:gap-4 dsn:rounded-faq-card dsn:bg-white dsn:p-5 dsn:shadow-faq-soft dsn:ring-1 dsn:ring-faq-ink/10 dsn:transition dsn:hover:ring-faq-primary">
										<span>
											<span class="dsn:block dsn:font-faq-display dsn:text-lg dsn:text-faq-ink"><?php the_title(); ?></span>
											<span class="dsn:mt-1 dsn:block dsn:text-sm dsn:text-faq-ink/60"><?php echo esc_html( wp_trim_words( dsn_faq_short(), 22 ) ); ?></span>
										</span>
										<span class="dsn:mt-1 dsn:text-faq-action dsn:transition dsn:group-hover:translate-x-1"><?php dsn_faq_the_icon( 'arrow', 'dsn:h-5 dsn:w-5' ); ?></span>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>

				<!-- Right column (wide screens) -->
				<aside class="dsn:mt-12 dsn:md:col-span-9 dsn:md:col-start-4 dsn:xl:col-span-3 dsn:xl:col-start-auto dsn:xl:mt-0">
					<div class="dsn:rounded-faq-card dsn:bg-faq-ink dsn:p-6 dsn:text-white dsn:xl:sticky dsn:xl:top-[calc(var(--toc-top,0px)+1rem)]">
						<p class="dsn:font-faq-display dsn:text-xl"><?php esc_html_e( 'Can’t find your answer?', 'dsnshowcase' ); ?></p>
						<p class="dsn:mt-2 dsn:text-sm dsn:leading-relaxed dsn:text-white/70"><?php esc_html_e( 'One of our specialists will get back to you fast.', 'dsnshowcase' ); ?></p>
						<div class="dsn:mt-5 dsn:flex dsn:flex-col dsn:gap-2">
							<?php echo dsn_faq_ask_button( __( 'Ask our team', 'dsnshowcase' ), 'faq-btn faq-btn-accent faq-btn-sm', array( 'title' => __( 'Ask our team', 'dsnshowcase' ), 'source' => 'faq-single-side' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php if ( dsn_faq_opt( 'phone' ) ) : ?>
								<a href="<?php echo esc_url( dsn_faq_tel() ); ?>" class="faq-btn faq-btn-ghost-light faq-btn-sm" data-track="call"><?php dsn_faq_the_icon( 'phone', 'dsn:h-4 dsn:w-4' ); ?><?php echo esc_html( dsn_faq_opt( 'phone' ) ); ?></a>
							<?php endif; ?>
						</div>
						<?php if ( $dsn_faq_line ) : ?>
							<a class="dsn:mt-5 dsn:inline-flex dsn:items-center dsn:gap-1.5 dsn:text-sm dsn:font-semibold dsn:text-white/80 dsn:hover:text-white dsn:hover:underline" href="<?php echo esc_url( get_term_link( $dsn_faq_line ) ); ?>">
								<?php
								/* translators: %s: product line, e.g. Hot Tubs */
								echo esc_html( sprintf( __( 'All %s FAQs', 'dsnshowcase' ), $dsn_faq_line->name ) );
								?>
								<?php dsn_faq_the_icon( 'arrow', 'dsn:h-4 dsn:w-4' ); ?>
							</a>
						<?php endif; ?>
					</div>
				</aside>
			</div>
		</article>

		<?php get_template_part( 'templates/faq/cta' ); ?>
	</div>
	<?php
endwhile;
get_footer();
