<?php 
$customBlock = get_field('custom_block', $block_id);
?>
<div id="custom-block-<?php echo $block_id; ?>" class="CustomBlock">
 <?php echo $customBlock['content']; ?>
</div>