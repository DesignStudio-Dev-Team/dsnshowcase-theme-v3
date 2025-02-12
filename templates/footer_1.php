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
        <div class="dsn:md:px-10 dsn:pt-1 dsn:md:pt-0 dsn:container dsn:mx-auto dsn:block dsn:md:flex dsn:px-0 dsn:pb-10 dsn:relative dsn:z-10 dsn:md:justify-center dsn:md:gap-x-3.5 dsn:text-white">
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
                                                    <ul class="dsn:list-none dsn:m-0 dsn:text-base dsn:lg:text-xl dsn:p-0 dsn:!pl-0 dsn:!mt-0">
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
					<div class="dsn:w-3/4 dsn:md:w-full dsn:mx-auto dsn:mt-8">
                            <h4 class="dsn:font-bold dsn:m-0 dsn:text-base dsn:lg:text-xl dsn:text-left dsn:md:text-left"><?php echo "Social"; ?></h4>
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
    
   jQuery(document).on('click', '#social-link a', function(e){ 
    e.preventDefault(); 
    var url = jQuery(this).attr('href'); 
    window.open(url, '_blank');
});
</script>
	</div> 

</footer>
 <div id="footer-copyright" class="copyright dsn:py-4">
			<div class="dsn:container dsn:mx-auto dsn:text-center dsn:text-white dsn:flex dsn:items-center dsn:justify-center dsn:gap-1">
		<span>&copy; <?php echo date('Y'); ?> <?php the_field('company_name', 'option'); ?>. All rights reserved. | Site by</span> <a href="https://designstudio.com/"><svg title="DesignStudio Logo" id="Group_171" data-name="Group 171" xmlns="http://www.w3.org/2000/svg" width="30.328" height="32" viewBox="0 0 30.328 32">
        <g id="Group_343" data-name="Group 343">
            <g id="Group_53" data-name="Group 53" transform="translate(0)">
            <path id="Path_1" data-name="Path 1" d="M99.815,21.97v1.97H96.77a1.015,1.015,0,0,0,0,2.03h14.149a1.015,1.015,0,0,0,0-2.03h-3.045V21.97h0l5.075-7.642L104.89,0h-.478l.478,12h3.045l-2.03,2.328.478,2.746-2.507-1.313-2.507,1.313.478-2.746L99.815,12h3.045L103.4,0h-.478L94.8,14.328Z" transform="translate(-88.71)" fill="#fff"/>
            <path id="Path_2" data-name="Path 2" d="M104.66,4.7l1.672,2.925a12.963,12.963,0,0,1-2.507,23.642v-.955a.426.426,0,0,0-.478-.418H96.182a.461.461,0,0,0-.478.418v.955A12.963,12.963,0,0,1,93.2,7.625L94.869,4.7A14.958,14.958,0,0,0,95.7,33.357a15.165,15.165,0,0,0,19.224-14.448A15.014,15.014,0,0,0,104.66,4.7Z" transform="translate(-84.6 -1.894)" fill="#fff"/>
            </g>
        </g>
        </svg></a>
	</div>
		</div>

</div>
