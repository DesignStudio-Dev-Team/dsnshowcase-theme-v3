<?php
/**
 * FAQ landing page search results (?q=), grouped by product line, with the
 * company questions last. Rendered on the server, so search works without
 * JavaScript. Used by both landing layouts.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

$dsn_faq_q       = dsn_faq_query();
$dsn_faq_url     = get_post_type_archive_link( DSN_FAQ_CPT );
$dsn_faq_company = dsn_faq_company();
$dsn_faq_groups  = dsn_faq_group( dsn_faq_search( dsn_faq_landing_posts(), $dsn_faq_q ), array_merge( dsn_faq_lines(), $dsn_faq_company ? array( $dsn_faq_company ) : array() ) );
$dsn_faq_n       = 0;
foreach ( $dsn_faq_groups as $dsn_faq_g ) {
	$dsn_faq_n += count( $dsn_faq_g['faqs'] );
}
$dsn_faq_back = remove_query_arg( 'q' );
?>
<section class="faq-section dsn:pt-12 dsn:sm:pt-14">
	<div class="faq-container dsn:mx-auto dsn:max-w-4xl">
		<div class="dsn:mb-10 dsn:flex dsn:flex-wrap dsn:items-baseline dsn:justify-between dsn:gap-3">
			<h2 class="dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink dsn:sm:text-3xl" aria-live="polite">
				<?php
				/* translators: 1: number of FAQs, 2: search text */
				echo esc_html( sprintf( _n( '%1$d answer for “%2$s”', '%1$d answers for “%2$s”', $dsn_faq_n, 'dsnshowcase' ), $dsn_faq_n, $dsn_faq_q ) );
				?>
			</h2>
			<a class="dsn:text-sm dsn:font-semibold dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( $dsn_faq_back ); ?>"><?php esc_html_e( 'Clear search', 'dsnshowcase' ); ?></a>
		</div>

		<?php foreach ( $dsn_faq_groups as $dsn_faq_g ) : ?>
			<section class="dsn:mb-20 dsn:last-of-type:mb-0">
				<header class="dsn:mb-6 dsn:flex dsn:items-center dsn:justify-between dsn:gap-4">
					<h3 class="dsn:flex dsn:items-center dsn:gap-3 dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink">
						<span class="dsn:grid dsn:h-10 dsn:w-10 dsn:place-items-center dsn:rounded-faq-card dsn:bg-faq-primary/10 dsn:text-faq-primary"><?php dsn_faq_the_icon( dsn_faq_icon( $dsn_faq_g['term'] ), 'dsn:h-5 dsn:w-5' ); ?></span>
						<?php echo esc_html( $dsn_faq_g['term']->name ); ?>
					</h3>
					<a class="dsn:shrink-0 dsn:text-sm dsn:font-semibold dsn:text-faq-action dsn:hover:underline" href="<?php echo esc_url( add_query_arg( 'q', rawurlencode( $dsn_faq_q ), get_term_link( $dsn_faq_g['term'] ) ) ); ?>"><?php esc_html_e( 'Search only here', 'dsnshowcase' ); ?></a>
				</header>
				<?php dsn_faq_render_items( $dsn_faq_g['faqs'] ); ?>
			</section>
		<?php endforeach; ?>

		<?php if ( ! $dsn_faq_n ) : ?>
			<div class="dsn:rounded-faq-card dsn:border dsn:border-dashed dsn:border-faq-ink/20 dsn:p-10 dsn:text-center">
				<p class="dsn:font-faq-display dsn:text-2xl dsn:text-faq-ink"><?php esc_html_e( 'No matching questions', 'dsnshowcase' ); ?></p>
				<p class="dsn:mt-2 dsn:text-faq-ink/60"><?php esc_html_e( 'Try a different word, or ask us directly — we’ll reply fast.', 'dsnshowcase' ); ?></p>
				<div class="dsn:mt-5"><?php echo dsn_faq_ask_button( __( 'Ask our team', 'dsnshowcase' ), 'faq-btn faq-btn-accent', array( 'title' => __( 'Ask our team', 'dsnshowcase' ), 'source' => 'faq-search' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			</div>
		<?php endif; ?>
	</div>
</section>
