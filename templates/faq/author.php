<?php
/**
 * Author block at the top of the left column on a single FAQ: profile
 * picture, name, site name and Biographical Info from the author's WordPress
 * profile. A long bio is shortened (the column is narrow).
 *
 * $args:
 *  - user  (int)    Author user ID.
 *  - label (string) Optional eyebrow above the name, e.g. "Answered by".
 *
 * @package dsnshowcase
 */

defined( 'ABSPATH' ) || exit;

$dsn_faq_user = get_userdata( isset( $args['user'] ) ? (int) $args['user'] : 0 );
if ( ! $dsn_faq_user ) {
	return;
}
$dsn_faq_label = isset( $args['label'] ) ? (string) $args['label'] : '';
$dsn_faq_url   = get_author_posts_url( $dsn_faq_user->ID );
$dsn_faq_bio   = wp_trim_words( wp_strip_all_tags( (string) $dsn_faq_user->description ), 30 );
?>
<div class="dsn:pb-5 dsn:md:pb-6">
	<div class="dsn:flex dsn:items-center dsn:gap-4 dsn:md:block">
		<a href="<?php echo esc_url( $dsn_faq_url ); ?>" class="dsn:block dsn:shrink-0" tabindex="-1" aria-hidden="true">
			<?php echo get_avatar( $dsn_faq_user->ID, 128, '', '', array( 'class' => 'dsn:h-16 dsn:w-16 dsn:rounded-full dsn:object-cover dsn:ring-1 dsn:ring-faq-ink/10 dsn:md:h-24 dsn:md:w-24' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
		<div class="dsn:min-w-0 dsn:md:mt-4">
			<?php if ( '' !== $dsn_faq_label ) : ?>
				<p class="faq-eyebrow dsn:text-faq-ink/50"><?php echo esc_html( $dsn_faq_label ); ?></p>
			<?php endif; ?>
			<a href="<?php echo esc_url( $dsn_faq_url ); ?>" rel="author" class="dsn:mt-1 dsn:block dsn:text-xl dsn:font-semibold dsn:leading-tight dsn:text-faq-action dsn:hover:underline"><?php echo esc_html( $dsn_faq_user->display_name ); ?></a>
			<p class="dsn:mt-1 dsn:text-sm dsn:text-faq-ink/60"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
		</div>
	</div>
	<?php if ( '' !== $dsn_faq_bio ) : ?>
		<p class="dsn:mt-4 dsn:text-sm dsn:leading-relaxed dsn:text-faq-ink/70"><?php echo esc_html( $dsn_faq_bio ); ?></p>
	<?php endif; ?>
</div>
