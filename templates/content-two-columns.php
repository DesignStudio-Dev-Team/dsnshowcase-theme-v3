<?php
$left_block = get_field('left_block');
$right_block = get_field('right_block');
$top_block = get_field('top_block');
$bottom_block = get_field('bottom_block');
$enable_50_50 = get_field('enable_50_50');
$floating_right_column = get_field('floating_right_column');
$floating_left_column = get_field('floating_left_column');
$enable_above = get_field('enable_above');
$enable_below = get_field('enable_below');
$sticky_column = get_field('sticky_column');
$sticky = "dsn:md:sticky dsn:md:top-32 dsn:md:pb-4";
if($sticky_column == 'none') {
    $sticky_column_left = '';
    $sticky_column_right = '';
} elseif ($sticky_column == 'left') {
    $sticky_column_left = $sticky;
} elseif ($sticky_column == 'right') {
    $sticky_column_right = $sticky;
}

$top_block_container_width = get_field('top_block_container_width');
$top_block_container_padding_top = get_field('top_block_container_padding_top');
$top_block_container_padding_bottom = get_field('top_block_container_padding_bottom');
$bottom_block_container_width = get_field('bottom_block_container_width');
$bottom_block_container_padding_top = get_field('bottom_block_container_padding_top');
$bottom_block_container_padding_bottom = get_field('bottom_block_container_padding_bottom');

// container_width

$top_block_container_width_w = ' ';
if ($top_block_container_width != 0) {
    $top_block_container_width_w = ' max-width: ' . $top_block_container_width . 'px; margin-left:auto; margin-right:auto;';
}

$top_block_container_padding_top_pt = ' ';
if ($top_block_container_padding_top != 0) {
    $top_block_container_padding_top_pt = ' padding-top: ' . $top_block_container_padding_top . 'px;';
}

$top_block_container_padding_bottom_pb = ' ';
if ($top_block_container_padding_bottom != 0) {
    $top_block_container_padding_bottom_pb = ' padding-bottom: ' . $top_block_container_padding_bottom . 'px;';
}

$top_styles = $top_block_container_width_w . $top_block_container_padding_top_pt . $top_block_container_padding_bottom_pb;

$bottom_block_container_width_w = ' ';
if ($bottom_block_container_width != 0) {
    $bottom_block_container_width_w = ' max-width: ' . $bottom_block_container_width . 'px; margin-left:auto; margin-right:auto;';
}

$bottom_block_container_padding_top_pt = ' ';
if ($bottom_block_container_padding_top != 0) {
    $bottom_block_container_padding_top_pt = ' padding-top: ' . $bottom_block_container_padding_top . 'px;';
}

$bottom_block_container_padding_bottom_pb = ' ';
if ($bottom_block_container_padding_bottom != 0) {
    $bottom_block_container_padding_bottom_pb = ' padding-bottom: ' . $bottom_block_container_padding_bottom . 'px;';
}

$bottom_styles = $bottom_block_container_width_w . $bottom_block_container_padding_top_pt . $bottom_block_container_padding_bottom_pb;




?>


	<div class="dsn:container">


    <?php if($enable_above) : ?>
    <div style="<?php echo $top_styles; ?>">
        <?php echo $top_block; ?>
    </div>

   <?php endif; ?>

    <?php if ($left_block || $right_block) : ?>
    <div class="dsn:md:flex dsn:md:space-x-10 dsn:items-start">
			<?php if ($left_block) : ?>
				<div class="dsn:w-full dsn:md:w-6/12 dsn:md:pr-5 dsn:mb-6 two-column-left-block <?php echo $sticky_column_left; ?>">
					<div>
						<?php echo $left_block; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($right_block) : ?>
				<div class="dsn:w-full dsn:md:w-6/12 dsn:md:pl-5 dsn:mb-6 two-column-right-block <?php echo $sticky_column_right; ?>">
					<div>
						<?php echo $right_block; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
   <?php endif; ?>
   
   <?php if($enable_below) : ?>
    <div style="<?php echo $bottom_styles; ?>">
        <?php echo $bottom_block; ?>
   </div>

   <?php endif; ?>


   </div>