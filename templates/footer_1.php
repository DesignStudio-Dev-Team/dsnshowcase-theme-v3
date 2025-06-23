<?php
if(function_exists('get_field')) {
    $footer_contact_title = get_field('footer_contact_title', 'option');
    $footer_bg = get_field('footer_bg', 'option');
    $content = get_field('footer_content_editor', 'option');
    $social_networks = !empty(get_field('footer_social_icons', 'option')) && is_array(get_field('footer_social_icons', 'option'))
        ? get_field('footer_social_icons', 'option')
        : [];
}

// Make sure locations exists
$locations = !empty($content) && is_array($content)
    ? $content
    : [];

?>



<style>
	.footer-main {
        background-color: #191919;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .footer-link-color {
        color: #00BFE6;
        
    }
    #footer-copyright {
       background: #333;
    }
    
        @media only screen and (min-width: 1024px) and (max-width: 1400px) {
            .footer-inner {
                max-width: 1400px;
            }
        }
     
            div#footer-copyright ul li:after {
                content: ".";
                position: absolute;
                top: -4px;
                right: -1em;
            }
            div#footer-copyright ul li:last-child:after {
                content: "";
        }
        div#footer-copyright ul li {
            width: auto;
        }
        div#footer-copyright ul li:hover {
            background-color: transparent;
        }
        @media only screen and (max-width: 1024px) {
            div#footer-copyright ul li:after {
                right: -0.5em;
            }
        }
    
 </style>

<footer id="dsFooter" class="dsn:relative dsn:clear-both dsn:z-0">
    <div class="footer-main bgImage">
        <div class="dsn:md:px-5 dsn:pt-1 dsn:md:pt-0 dsn:container dsn:mx-auto dsn:block dsn:md:flex dsn:flex-wrap dsn:px-0 dsn:pb-10 dsn:relative dsn:z-10 dsn:md:justify-start dsn:text-white footer-inner">
            
                    <?php if (count($locations) > 1) : ?>
                        <?php $locationTitle = 's'; ?>
                    <?php endif; ?>
                    
                    
                        <?php $i = 0; ?>
                        <?php foreach ($locations as $location) : ?>
                            <?php
                            $partial_address = "{$location['city']}, {$location['state']} {$location['zip_code']}";
                            $full_address    = "{$location['address']}, {$location['address_2']}, {$location['po_box']}, {$location['city']}, {$location['state']} {$location['zip_code']}";
                            ?>
                            <?php
                            $first = "";
                            if ($i == 0) :
                                $first = "first";
                            endif;
                            ?>
                            <div class="dsn:mb-12 dsn:mt-12 dsn:md:w-1/3 dsn:w-2/3 dsn:md:px-5 dsn:mx-auto dsn:md:mx-0 <?php echo $first; ?>">
							    <?php if (!empty($location['location_image'])) : ?>	
                                    <img class="dsn:w-full" src="<?php echo esc_html($location['location_image']['url']); ?>" alt="<?php echo $location['tab_title']; ?>" />
                                <?php endif; ?>
                            <h4 class="dsn:mt-4 dsn:font-bold m-0 dsn:text-base dsn:lg:text-2xl dsn:md:min-h-30 dsn:2xl:min-h-20 dsn:md:w-105 dsn:mx-auto dsn:text-center"><?php echo esc_html($location['tab_title']); ?></h4>
                            <div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:flex-wrap dsn:gap-6 dsn:justify-between">
								<div class="footer-address-body dsn:w-full dsn:md:w-5/12">
                                        <div class="dsn:mt-4 dsn:md:mt-4 dsn:text-base dsn:lg:text-xl dsn:w-full">
											<p class="dsn:m-0 dsn:text-base dsn:font-normal dsn:lg:text-xl dsn:mb-2">
												ADDRESS:
											</p>
                                            <p class="dsn:m-0 dsn:text-base dsn:lg:text-xl"><?php echo esc_html($location['address']); ?></p>
                                            <?php if (!empty($location['city']) && !empty($location['state'])) : ?>
                                                <p class="dsn:m-0 dsn:mt-1 dsn:text-base dsn:lg:text-xl"><?php echo esc_html($partial_address); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($location['phone'])) : ?>
                                                <div class="dsn:flex dsn:items-center dsn:md:mt-4">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="phone dsn:w-4 dsn:h-4 dsn:md:w-6 dsn:md:h-6">
                                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                                    </svg>
                                                    
                                                    <a class="footer-link-color" href="tel:<?php echo esc_html($location['phone']['url']); ?>">
                                                        <?php
                                                        // Fix ext
                                                        $number = str_replace(',', ' x ', $location['phone']['title']);
                                                        ?>
                                                        <span class="dsn:ml-2 dsn:text-base dsn:2xl:text-xl dsn:hover:text-white"><?php echo esc_html($number); ?></span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>   
                                        <div class="dsn:w-full dsn:mt-4 dsn:md:mt-4">
											<?php if (!empty($location['directions'])) : ?>
                                                <div class="dsn:flex dsn:items-center">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="location-marker dsn:w-4 dsn:h-4 dsn:md:w-6 dsn:md:h-6">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <a class="dsn:ml-2 dsn:text-base dsn:2xl:text-xl dsn:hover:!text-white footer-link-color" href="<?php echo $location['directions']['url']; ?>" target="_blank">
                                                        <?php echo $location['directions']['title'];?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                                                            
                                        </div>
                                    </div>
                                    <?php 
                                    $hours = $location['hours'];
                                    if($hours): ?>
                                    <div class="dsn:relative dsn:w-full dsn:md:w-6/12 dsn:mt-4 dsn:md:mt-4 dsn:text-base dsn:lg:text-xl hours">
                                    <p class="dsn:m-0 dsn:text-base dsn:font-normal dsn:lg:text-xl dsn:mb-2">
												HOURS:
											</p>
                                    <?php foreach ($hours as $hour) : ?>
                                        <div class="dsn:flex dsn:gap-4 dsn:items-center dsn:w-full">
                                        <div class="dsn:w-22 dsn:h-auto">
                                        <?php echo $hour['days']; ?>
                                       </div>
                                       <div class="dsn:w-auto dsn:shrink-0 dsn:h-auto">
                                        <?php echo $hour['times']; ?>
                                       </div>
                                    </div>
                                       <?php endforeach; ?>
                                       </div>
                                    <?php endif; ?>
                                </div>
							</div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                   
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
 <div id="social-link" class="dsn:flex dsn:flex-wrap dsn:justify-center dsn:gap-4 dsn:items-start dsn:mt-4 dsn:md:mt-4">
                      
                      <?php if ($social_networks) : ?>
                          <?php foreach ($social_networks as $network) : ?>
                              <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start">
                                  <?php // echo $network; ?>
                              <?php if($network == 'Facebook') { ?>
                                  <a href="<?php echo esc_url_raw(get_field('facebook_url', 'option')); ?>">
                                  <!-- <img src="<?php echo  get_template_directory() . '\assets\svg\social\facebook.webp'; ?>" /> -->
                                  <img class="dsn:w-10 dsn:md:w-14" src="./wp-content/uploads/theme-assets/social/footer-1-facebook-icon.jpg" alt="<?php echo $network; ?>" />
                                  </a>
                                  <?php } elseif ($network == 'Instagram') {?>
                                  <a href="<?php echo esc_url_raw(get_field('insta_url', 'option')); ?>">
                                  <img class="dsn:w-10 dsn:md:w-14" src="./wp-content/uploads/theme-assets/social/footer-1-insta-icon.jpg" alt="<?php echo $network; ?>" />
                                  </a>
                                  <?php } elseif ($network == 'Youtube') {?>
                                  <a href="<?php echo esc_url_raw(get_field('youtube_url', 'option')); ?>">
                                  <img class="dsn:w-10 dsn:md:w-14" src="./wp-content/uploads/theme-assets/social/footer-1-youtube-icon.jpg" alt="<?php echo $network; ?>" />
                                  </a>
                                  <?php } elseif ($network == 'Pinterest') {?>
                                  <a href="<?php echo esc_url_raw(get_field('pinterest_url', 'option')); ?>">
                                  <img class="dsn:w-10 dsn:md:w-14" src="./wp-content/uploads/theme-assets/social/footer-1-pin-icon.jpg" alt="<?php echo $network; ?>" />
                                  </a>
                                  <?php } elseif ($network == 'Twitter') {?>
                                  <a href="<?php echo esc_url_raw(get_field('twitter_url', 'option')); ?>">
                                  <img class="dsn:w-10 dsn:md:w-14" src="./wp-content/uploads/theme-assets/social/footer-1-twitter-icon.jpg" alt="<?php echo $network; ?>" />
                                  </a>
                                  <?php } ?>
                              </div>
                          <?php endforeach; ?>
                      <?php endif; ?>
                  </div>
                  <?php

                wp_nav_menu(
                    array(
                        'menu' => 'footer_menu',
                        'theme_location' => 'footer',
                        'menu_class' => 'dsn:py-4 dsn:px-8 dsn:md:py-0 dsn:flex dsn:flex-wrap dsn:p-0 dsn:items-center dsn:md:items-start  dsn:justify-center dsn:md:justify-center dsn:space-x-4 dsn:md:space-x-10',
                        'link_class'   => 'dealerLinkColor dsn:text-sm dsn:md:text-xl'
                    )
                );

                ?>
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
<style>
    .dealerLinkColor {
        color: #00BFE6;
    }
    .dealerLinkColor:hover {
        color: #fff;
    }
</style>