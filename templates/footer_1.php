<?php

// Footer content
$content = get_field('footer_content', 'option');

// Make sure CTA buttons exists
$cta_buttons = !empty($content['cta_buttons']) && is_array($content['cta_buttons'])
    ? $content['cta_buttons']
    : [];

// Make sure locations exists
$locations = !empty($content['locations']) && is_array($content['locations'])
    ? $content['locations']
    : [];

// Make sure social networks exists
$social_networks = !empty($content['social_icons']) && is_array($content['social_icons'])
    ? $content['social_icons']
    : [];
?>

<style>
	.footer-main {
        background-color: #000;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    .footer-link-color {
        color: #00bfe6;
    }
    #footer-copyright {
        background: #0073b1;
    }
    .help-icon-img {
        background-color: #00bfe6;
    }
 </style>

<footer id="dsFooter" class="dsn:relative dsn:clear-both">
    <div class="footer-main bgImage">
        <div class="dsn:md:px-10 dsn:pt-1 dsn:md:pt-0 dsn:container dsn:block dsn:md:flex dsn:px-0 dsn:pb-10 dsn:relative dsn:z-10 dsn:md:justify-center dsn:md:gap-x-3.5 dsn:text-white">
            <div class="dsn:mt-12 dsn:w-full dsn:md:w-5/12">
                <div class="dsn:mx-auto">
                    <div class="dsn:flex dsn:flex-wrap dsn:items-start dsn:justify-center dsn:mt-8">
                        <?php foreach ($cta_buttons as $button) : ?>
                           
                            <a class="help-icon dsn:flex dsn:flex-col dsn:items-center dsn:justify-center dsn:md:items-start dsn:md:justify-start dsn:pb-8 dsn:w-1/2 dsn:md:w-1/3" href="<?php echo esc_url_raw($button['link_url']); ?>">
                                <div class="bg-footerPrimaryLink help-icon-img dsn:flex dsn:h-24 dsn:items-center dsn:justify-center dsn:rounded-full dsn:w-24 dsn:md:h-20 dsn:md:w-20">
                                  
                                <img class="dsn:h-12 dsn:w-12 dsn:object-contain" src="<?php echo esc_url_raw($button['icon_url']); ?>" alt="<?php  echo esc_html($button['label']); ?> icon image">
                                </div>
                                <span class="dsn:font-medium dsn:mt-2 dsn:md:w-32 dsn:md:-ml-6 dsn:text-center dsn:text-sm">
                                    <?php echo __(esc_html($button['label']), 'dsn-showcase-theme-v3'); ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="dsn:mt-4 dsn:md:mt-12 dsn:w-full dsn:md:w-3/12 dsn:md:pl-4">
                <div class="dsn:w-3/4 dsn:md:w-full dsn:mx-auto">
                    <?php if (count($locations) > 1) : ?>
                        <?php $locationTitle = 's'; ?>
                    <?php endif; ?>
                    <h4 class="dsn:font-bold dsn:m-0 dsn:text-xl dsn:text-center dsn:uppercase dsn:md:text-left dsn:hidden"></h4>

                    <div class="dsn:flex dsn:flex-wrap dsn:items-start dsn:mt-8">
                        <?php $i = 0; ?>
                        <?php foreach ($locations as $location) : ?>
                            <?php
                            $partial_address = "{$location['city']}, {$location['state']} {$location['zip_code']}";
                            $full_address    = "{$location['address']}, {$location['city']}, {$location['state']} {$location['zip_code']}";
                            ?>
                            <?php
                            $first = "";
                            if ($i == 0) :
                                $first = "first";
                            endif;
                            ?>
                            <div class="dsn:mb-12 dsn:w-full <?php echo $first; ?>">
                                <h4 class="dsn:font-bold m-0 dsn:text-base dsn:lg:text-xl dsn:text-center dsn:md:text-left">Address:</h4>

                                <div class="footer-address-body">
                                        <div class="dsn:mt-4 dsn:md:mt-4 dsn:text-base dsn:lg:text-xl dsn:w-full">
											<p class="dsn:m-0 dsn:text-base dsn:lg:text-xl">
												<?php echo esc_html($location['name']); ?>
											</p>
                                            <p class="dsn:m-0 dsn:text-base dsn:lg:text-xl"><?php echo esc_html($location['address']); ?></p>
                                            <?php if (!empty($location['city']) && !empty($location['state'])) : ?>
                                                <p class="dsn:m-0 dsn:mt-1 dsn:text-base dsn:lg:text-xl"><?php echo esc_html($partial_address); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="dsn:w-full dsn:mt-4 dsn:md:mt-4">
											<?php if (!empty($location['phone_number'])) : ?>
                                                <div class="dsn:flex dsn:items-center">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="location-marker dsn:w-4 dsn:h-4 dsn:md:w-6 dsn:md:h-6">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <a class="dsn:ml-2 dsn:text-base dsn:lg:text-xl dsn:hover:!text-white footer-link-color" href="<?php echo 'https://www.google.com/maps/?q=' . urlencode($full_address); ?>" target="_blank">
                                                        
                                                        <?php echo "Get Directions";?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($location['phone_number'])) : ?>
                                                <div class="dsn:flex dsn:items-center dsn:md:mt-4">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="phone dsn:w-4 dsn:h-4 dsn:md:w-6 dsn:md:h-6">
                                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                                    </svg>
                                                    <a class="footer-link-color" href="tel:<?php echo esc_html($location['phone_number']); ?>">
                                                        <?php
                                                        // Fix ext
                                                        $number = str_replace(',', ' x ', $location['phone_number']);
                                                        ?>
                                                        <span class="dsn:ml-2 dsn:text-base dsn:lg:text-xl dsn:hover:text-white"><?php echo esc_html($number); ?></span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>                                    
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
		<div class="dsn:mt-4 dsn:md:mt-12 dsn:w-full dsn:md:w-4/12 dsn:md:pl-4 dsn:flex dsn:flex-col">
                <h4 class="dsn:font-bold dsn:m-0 dsn:text-xl dsn:text-center dsn:uppercase dsn:md:text-left dsn:hidden"></h4>
				<div class="dsn:flex dsn:flex-wrap dsn:items-start dsn:mt-8">
                        <?php $i = 0; ?>
                        <?php foreach ($locations as $location) : ?>
                            <?php
                            $first = "";
                            if ($i == 0) :
                                $first = "first";
                            endif;
                            ?>
                            <div class="dsn:mb-12 dsn:w-full <?php echo $first; ?>">
                                <div class="dsn:w-3/4 dsn:md:w-full dsn:mx-auto">
                                    <h4 class="dsn:font-bold dsn:m-0 dsn:text-base dsn:lg:text-xl dsn:text-center dsn:md:text-left"><?php echo "Hours"; ?></h4>
                          
                                <div class="footer-address-body">
                                        <div class="dsn:w-full dsn:mt-4 dsn:md:mt-4">
                                            <div class="dsn:flex dsn:flex-wrap dsn:justify-start dsn:items-start">
                                                <?php if (!empty($location['hours']) && is_array($location['hours'])) : ?>
                                                    <ul class="dsn:list-none dsn:m-0 dsn:text-base dsn:lg:text-xl p-0">
                                                        <?php foreach ($location['hours'] as $hour) : ?>
                                                            <li class="dsn:flex dsn:w-full dsn:text-base dsn:lg:text-xl dsn:m-0">
                                                                <span class="dsn:w-34"><?php echo esc_html($hour['day']); ?></span>
                                                                <span class="dsn:mr-auto"><?php echo esc_html($hour['time']); ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
								</div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
	            </div>

            <div class="dsn:mt-4 dsn:md:mt-12 dsn:md:mt-12 dsn:w-full dsn:md:w-2/12 dsn:md:pl-4">
                <div class="dsn:sm:w-full dsn:mx-auto">
                    <h4 class="dsn:font-bold dsn:m-0 dsn:text-xl dsn:text-left dsn:md:text-left dsn:hidden"></h4>
					<div class="dsn:w-3/4 dsn:md:w-full dsn:mx-auto">
						<div class="dsn:font-bold dsn:mt-8">
                            <h4 class="dsn:font-bold dsn:m-0 dsn:text-base dsn:lg:text-xl dsn:text-left dsn:md:text-left"><?php echo "Social"; ?></h4>
                        </div>
                    <div id="social-link" class="dsn:flex dsn:flex-wrap dsn:justify-start dsn:gap-4 dsn:items-start dsn:mt-4 dsn:md:mt-4">
                        <?php if ($social_networks) : ?>
                            <?php foreach ($social_networks as $network) : ?>
                                <div class="dsn:flex dsn:items-center dsn:pb-10 dsn:md:pb-8 dsn:w-auto dsn:justify-start dsn:md:justify-start">
                                    <a href="<?php echo esc_url_raw($network['url']); ?>">
                                        <img class="dsn:h-8 dsn:w-auto dsn:md:h-10" src="<?php echo esc_url_raw($network['icon_url']); ?>" alt="<?php echo esc_html($network['social_network']); ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
				</div>
            </div>
<script>
    
   $(document).on('click', '#social-link a', function(e){ 
    e.preventDefault(); 
    var url = $(this).attr('href'); 
    window.open(url, '_blank');
});
</script>
	</div> 

</footer>
 <div id="footer-copyright" class="copyright dsn:py-4">
			<div class="dsn:container dsn:mx-auto dsn:text-center dsn:text-white dsn:flex dsn:items-center dsn:justify-center dsn:gap-1">
		<span>Copyright &copy; <?php echo date('Y'); ?> <?php the_field('company_name', 'option'); ?> 	| Site by</span> <a href="https://designstudio.com/"><img src="https://islandspasne.designstudio.host/wp-content/uploads/svg/designstudio-icon.svg" /></a>
	</div>
		</div>

</div>
