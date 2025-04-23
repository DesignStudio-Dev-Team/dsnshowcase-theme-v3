<?php 
$customBlock = get_field('custom_block', $block_id);
?>
<div class="CustomBlock">
 <?php echo $customBlock['content']; ?>
</div>