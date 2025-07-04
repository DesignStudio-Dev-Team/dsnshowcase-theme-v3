<?php 

$iconBlock = get_field('icon_block', $block_id);
$title = $iconBlock['title'];
$background = $iconBlock['background'];
$iconBlockLogo = $iconBlock['logo'];
$iconBlockLogoLink = $iconBlock['logo_link'];
$iconBlockCtaBtns = $iconBlock['cta_buttons'];
// Make sure CTA buttons exists
$cta_buttons = !empty($iconBlockCtaBtns) && is_array($iconBlockCtaBtns)
    ? $iconBlockCtaBtns
    : [];
?>
<style>
    .help-icon-img {
        background-color: var(--dealerColor);
    }
    .help-icon-img:hover {
        background-color: #076594;
        -webkit-transition: background-color 500ms linear;
        -ms-transition: background-color 500ms linear;
        transition: background-color 500ms linear;
    }
	.get-footer {
		background-image: url(<?php echo $background['url']; ?>);
		background-size: cover;
		background-position: right center;
		padding: 5em 0;
	}
	.get-footer:before {
		content: "";
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: #000;
		opacity: 0.8;
	}
	.help-icon-img {
		  width: 7em;
		  height: 7em;
		}
</style>

<div id="icon-block-<?php echo $block_id; ?>" class="get-footer dsn:relative">
		 <div class="dsn:container dsn:mx-auto dsn:block dsn:relative dsn:text-white">
			    <h4 class="dsn:font-bold m-0 dsn:text-3xl dsn:text-center"><?php echo $title; ?></h4>
			 <div class="dsn:flex dsn:flex-wrap dsn:items-start dsn:justify-center dsn:mt-8 dsn:gap-10">
                <div class="dsn:block dsn:relative dsn:h-full dsn:w-36 dsn:after:absolute dsn:after:h-full dsn:after:w-[1px] dsn:after:bg-white dsn:after:top-0 dsn:after:-right-5">
                    <a href="<?php echo $iconBlockLogoLink; ?>"><img class="dsn:w-full" src="<?php echo $iconBlockLogo['url']; ?>" alt="footer logo" /></a>
                </div>
                        <?php foreach ($cta_buttons as $button) : ?>
                           
                            <a class="help-icon dsn:flex dsn:flex-col dsn:items-center dsn:justify-center dsn:md:items-start dsn:md:justify-start dsn:pb-8 dsn:w-32" href="<?php echo esc_url_raw($button['link_url']); ?>">
                                <div class="bg-footerPrimaryLink help-icon-img dsn:flex dsn:h-24 dsn:items-center dsn:justify-center dsn:rounded-full dsn:w-24 dsn:md:h-30 dsn:md:w-24">
                                  
                                <img class="dsn:h-15 dsn:w-15 dsn:object-contain" src="<?php echo esc_url_raw($button['icon_url']); ?>" alt="<?php  echo esc_html($button['label']); ?> icon image">
                                </div>
                                <span class="dsn:font-medium dsn:mt-2 dsn:md:w-full dsn:text-center dsn:text-xl">
                                    <?php echo __(esc_html($button['label']), 'dsn-showcase-theme-v3'); ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
		</div>
	</div>