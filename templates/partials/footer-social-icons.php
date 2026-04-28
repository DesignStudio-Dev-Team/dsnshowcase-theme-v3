<?php $social_icons = $args['social_icons'] ?? []; ?>
<div id="social-link" class="dsn:flex dsn:flex-wrap dsn:justify-center dsn:gap-4 dsn:items-start dsn:mt-4 dsn:md:mt-4">
    <?php foreach ($social_icons as $social_icon) : ?>
        <?php if ($social_icon === 'Facebook') : ?>
            <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start dsn:text-white">
                <a href="<?php echo esc_url_raw(get_field('facebook_url', 'option')); ?>" target="_blank"><?php dsn_icon('facebook', 'dsn:w-10 dsn:h-10'); ?></a>
            </div>
        <?php elseif ($social_icon === 'Instagram') : ?>
            <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start dsn:text-white">
                <a href="<?php echo esc_url_raw(get_field('insta_url', 'option')); ?>" target="_blank"><?php dsn_icon('instagram', 'dsn:w-10 dsn:h-10'); ?></a>
            </div>
        <?php elseif ($social_icon === 'Youtube') : ?>
            <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start dsn:text-white">
                <a href="<?php echo esc_url_raw(get_field('youtube_url', 'option')); ?>" target="_blank"><?php dsn_icon('youtube', 'dsn:w-10 dsn:h-10'); ?></a>
            </div>
        <?php elseif ($social_icon === 'Pinterest') : ?>
            <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start dsn:text-white">
                <a href="<?php echo esc_url_raw(get_field('pinterest_url', 'option')); ?>" target="_blank"><?php dsn_icon('pinterest', 'dsn:w-10 dsn:h-10'); ?></a>
            </div>
        <?php elseif ($social_icon === 'Twitter') : ?>
            <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start dsn:text-white">
                <a href="<?php echo esc_url_raw(get_field('twitter_url', 'option')); ?>" target="_blank"><?php dsn_icon('x', 'dsn:w-10 dsn:h-10'); ?></a>
            </div>
        <?php elseif ($social_icon === 'Houzz') : ?>
            <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start dsn:text-white">
                <a href="<?php echo esc_url_raw(get_field('houzz_url', 'option')); ?>" target="_blank"><?php dsn_icon('houzz', 'dsn:w-10 dsn:h-10'); ?></a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
