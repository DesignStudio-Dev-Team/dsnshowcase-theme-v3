<?php 
get_header();
// Include custom blocks helper
require_once get_template_directory() . '/inc/custom-blocks.php';

if(function_exists('get_field')) {
    // fetch the acf group top_custom_blocks
    $top_custom_blocks = get_field('top_custom_blocks');
    //get selecte_custom_blocks from the group
    $selected_blocks = $top_custom_blocks['select_custom_blocks'] ?? [];
    //get the display type from the group
    $display_type = $top_custom_blocks['how_to_display_blocks'] ?? [];

    //Render TOP Custom Blocks
    if ($selected_blocks) {
        // Render the blocks using the helper function
        render_custom_blocks($selected_blocks, $display_type);
    }
}
?>
<main class="dsn:container dsn:mx-auto dsn:mb-10 dsn:py-4 dsn:px-10 dsn:pt-15">
    <?php 
    if (have_posts()): while (have_posts()): the_post();
        get_template_part('templates/content', 'page');
    endwhile; endif; 
    ?>
</main>


<?php

if(function_exists('get_field')) {
    // fetch the acf group bottom_custom_blocks
    $bot_custom_blocks = get_field('bottom_custom_blocks');
    //get selecte_custom_blocks from the group
    $selected_blocks_bot = $bot_custom_blocks['select_custom_blocks_bottom'] ?? [];
    //get the display type from the group
    $display_type_bot = $bot_custom_blocks['how_to_display_blocks_bottom'] ?? [];

    //Render Bottom Custom Blocks
    if ($selected_blocks_bot) {
        // Render the blocks using the helper function
        render_custom_blocks($selected_blocks_bot, $display_type_bot);
    }
}
get_footer(); ?>