<?php
/**
 * Template Name: Collections
 */

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php get_template_part('template-parts/content', 'collections'); ?>
<?php endwhile; endif; ?>
<?php get_template_part('template-parts/content-reusable-blocks'); ?>
<?php get_footer(); ?>
