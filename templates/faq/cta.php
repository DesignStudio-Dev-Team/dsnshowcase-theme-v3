<?php
/**
 * "Still have questions?" band with the lead form. Its texts can be edited on
 * the FAQs page (dsn_faq_copy()) and apply on every FAQ page.
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

// The form card is left out when there is no form or contact page to show.
ob_start();
dsn_faq_form( array( 'source' => 'faq-cta' ) );
$dsn_faq_form = trim( (string) ob_get_clean() );
?>
<section id="faq-ask" class="faq-section dsn:scroll-mt-24 dsn:relative dsn:isolate dsn:overflow-hidden dsn:bg-faq-ink dsn:text-white">
	<div class="dsn:pointer-events-none dsn:absolute dsn:-right-24 dsn:-top-24 dsn:-z-10 dsn:h-[480px] dsn:w-[480px] dsn:rounded-full dsn:bg-[radial-gradient(circle,color-mix(in_srgb,var(--faq-primary)_35%,transparent),transparent_65%)]"></div>
	<div class="faq-container dsn:grid dsn:items-center dsn:gap-12 dsn:lg:grid-cols-2">
		<div>
			<?php dsn_faq_section_heading( dsn_faq_copy( 'cta_eyebrow', __( 'Still curious?', 'dsnshowcase' ) ), dsn_faq_copy( 'cta_title', __( 'Get your answer from a real person', 'dsnshowcase' ) ), dsn_faq_copy( 'cta_text', __( 'Tell us what you’re wondering and one of our specialists will reply fast — no pressure, no obligation.', 'dsnshowcase' ) ), 'left', true ); ?>
			<?php if ( dsn_faq_opt( 'phone' ) ) : ?>
				<a href="<?php echo esc_url( dsn_faq_tel() ); ?>" class="dsn:mt-8 dsn:inline-flex dsn:items-center dsn:gap-4 dsn:text-white" data-track="call">
					<span class="dsn:grid dsn:h-14 dsn:w-14 dsn:place-items-center dsn:rounded-full dsn:bg-white/10 dsn:ring-1 dsn:ring-white/20"><?php dsn_faq_the_icon( 'phone', 'dsn:h-6 dsn:w-6 dsn:text-faq-accent' ); ?></span>
					<span><span class="dsn:block dsn:text-sm dsn:text-white/60"><?php esc_html_e( 'Prefer to talk? Call us', 'dsnshowcase' ); ?></span><span class="dsn:font-faq-display dsn:text-2xl"><?php echo esc_html( dsn_faq_opt( 'phone' ) ); ?></span></span>
				</a>
			<?php endif; ?>
		</div>
		<?php if ( '' !== $dsn_faq_form ) : ?>
			<div class="dsn:rounded-faq-card dsn:bg-white dsn:p-6 dsn:text-faq-ink dsn:shadow-2xl dsn:sm:p-8">
				<?php echo $dsn_faq_form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Gravity Forms / escaped helper output. ?>
			</div>
		<?php endif; ?>
	</div>
</section>
