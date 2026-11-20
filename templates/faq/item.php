<?php
/**
 * One FAQ expander: the question, then the quick answer, a "Read the full
 * answer" link to the FAQ's own page (where the long answer is) and an "Ask
 * our team" button. Expects the FAQ to be the current post.
 *
 * A native <details> element: it opens without JavaScript and the answers are
 * always in the HTML, so search engines and AI assistants can read them.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

$dsn_faq_id     = get_the_ID();
$dsn_faq_short  = dsn_faq_short();
$dsn_faq_hay    = strtolower( wp_strip_all_tags( get_the_title() . ' ' . $dsn_faq_short . ' ' . get_the_content() ) );
$dsn_faq_hidden = ! empty( $args['hide'] ) && in_array( $dsn_faq_id, $args['hide'], true );
?>
<li id="faq-<?php echo esc_attr( $dsn_faq_id ); ?>" class="faq-item" data-faq-item data-search="<?php echo esc_attr( $dsn_faq_hay ); ?>"<?php echo $dsn_faq_hidden ? ' hidden' : ''; ?>>
	<details class="faq-details dsn:rounded-faq-card dsn:bg-white dsn:shadow-faq-soft dsn:ring-1 dsn:ring-faq-ink/10 dsn:transition dsn:hover:ring-faq-ink/20">
		<summary class="dsn:flex dsn:cursor-pointer dsn:list-none dsn:items-start dsn:justify-between dsn:gap-4 dsn:rounded-faq-card dsn:px-5 dsn:py-4 dsn:sm:px-6 dsn:sm:py-5 dsn:[&::-webkit-details-marker]:hidden">
			<h3 class="dsn:m-0 dsn:font-faq-display dsn:text-lg dsn:leading-snug dsn:text-faq-ink dsn:sm:text-xl"><span><?php the_title(); ?></span></h3>
			<span class="faq-icon dsn:mt-0.5 dsn:grid dsn:h-8 dsn:w-8 dsn:shrink-0 dsn:place-items-center dsn:rounded-full dsn:bg-faq-primary/10 dsn:text-faq-primary dsn:transition" aria-hidden="true"><?php dsn_faq_the_icon( 'plus', 'dsn:h-4 dsn:w-4', 2.5 ); ?></span>
		</summary>
		<div class="faq-panel dsn:px-5 dsn:pb-6 dsn:sm:px-6">
			<div class="dsn:rounded-faq-btn dsn:border-l-4 dsn:border-faq-accent dsn:bg-faq-primary/5 dsn:px-4 dsn:py-3.5">
				<p class="faq-eyebrow dsn:text-faq-primary"><?php esc_html_e( 'Quick answer', 'dsnshowcase' ); ?></p>
				<p class="dsn:mt-1.5 dsn:text-base dsn:leading-relaxed dsn:text-faq-ink"><?php echo esc_html( $dsn_faq_short ); ?></p>
			</div>

			<div class="dsn:mt-6 dsn:flex dsn:flex-wrap dsn:items-center dsn:justify-between dsn:gap-4 dsn:border-t dsn:border-faq-ink/10 dsn:pt-5">
				<a class="dsn:group dsn:inline-flex dsn:items-center dsn:gap-1.5 dsn:text-[15px] dsn:font-semibold dsn:text-faq-action dsn:hover:underline" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'Read the full answer', 'dsnshowcase' ); ?><?php dsn_faq_the_icon( 'arrow', 'dsn:h-4 dsn:w-4 dsn:transition dsn:group-hover:translate-x-0.5' ); ?>
				</a>
				<?php
				echo dsn_faq_ask_button( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper.
					__( 'Ask our team', 'dsnshowcase' ),
					'faq-btn faq-btn-accent faq-btn-sm',
					array(
						'title'  => __( 'Ask our team', 'dsnshowcase' ),
						'source' => 'faq',
					)
				);
				?>
			</div>
		</div>
	</details>
</li>
