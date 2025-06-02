<?php
if(function_exists('get_field')) {
    $footer_contact_title = get_field('footer_contact_title', 'option');
	$footer_bg = get_field('footer_bg', 'option');
    $content = get_field('footer_content_editor', 'option');
    $cta_buttons = !empty(get_field('cta_buttons', 'option')) && is_array(get_field('cta_buttons', 'option'))
        ? get_field('cta_buttons', 'option')
        : [];
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
/* 	.footer-main {
        background-color: #003E51;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    } */
		#dsFooter {
		  background-color: #3B3737;
		}
    .footer-link-color {
        color: #F2852A;
        font-weight: bold;
    }
    #footer-copyright {
       background: #F2852A;
    }
    .help-icon-img {
        background-color: #F2852A;
    }
	.get-footer {
		background-image: url(<?php echo $footer_bg; ?>);
		background-size: cover;
		background-position: center;
		padding: 5em 0;
	}
	.get-footer:before {
		content: "";
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: #1a0e00;
		opacity: 0.7;
	}
	.help-icon-img {
		  width: 6em;
		  height: 6em;
		margin: 0 auto;
		}
	
	.menu-footer-menu-container ul li:hover {
		background: transparent;
	}
	
	.menu-footer-menu-container ul li a {
	  font-size: 16px;
		line-height: 16px;
	}
	#menu-footer-menu {
	  margin: 0px;
	}
	svg.phone {
	  transform: rotate(-90deg);
	}
	@media only screen and (min-width: 1024px) {
		.locations {
		width: 50%;
		}
		.socials {
			width: 20%;
		}
		.menu-footer-menu-container ul li {
		width: max-content;
		border-left: 1px solid #fff;
		padding-left: 10px;
  		margin-right: 10px;
	}
		#menu-footer-menu {
	  margin-left: 10px;
	}
		.footer4 .help-icon {
			  width: 26%;
			  text-align: center;
			} 
	}
 </style>

<footer id="dsFooter" class="footer4 dsn:relative dsn:clear-both">
	<div class="get-footer dsn:relative">
		<div class="dsn:container dsn:mx-auto dsn:flex dsn:flex-col dsn:md:flex-row dsn:relative">
		 <div class=" dsn:block dsn:relative dsn:text-white dsn:w-full dsn:md:w-1/3">
			    <h4 class="dsn:font-bold m-0 dsn:text-3xl dsn:text-center"><?php //echo $footer_contact_title; ?></h4>
			 <div class="dsn:flex dsn:flex-wrap dsn:items-start dsn:justify-center dsn:mt-8 dsn:gap-10 dsn:pr-4">
                        <?php foreach ($cta_buttons as $button) : ?>
                           
                            <a class="help-icon dsn:flex dsn:flex-col dsn:items-center dsn:justify-center dsn:md:items-start dsn:md:justify-start dsn:pb-8 dsn:w-auto" href="<?php echo esc_url_raw($button['link_url']); ?>">
                                <div class="bg-footerPrimaryLink help-icon-img dsn:flex dsn:h-24 dsn:items-center dsn:justify-center dsn:rounded-full dsn:w-24 dsn:md:h-30 dsn:md:w-30">
                                  
                                <img class="dsn:h-10 dsn:w-10 dsn:object-contain" src="<?php echo esc_url_raw($button['icon_url']); ?>" alt="<?php  echo esc_html($button['label']); ?> icon image">
                                </div>
                                <span class="dsn:font-medium dsn:mt-2 dsn:md:w-full dsn:text-center dsn:text-xl">
                                    <?php echo __(esc_html($button['label']), 'dsn-showcase-theme-v3'); ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
		</div>
	
    <div class="locations dsn:w-full">
        <div class="dsn:pt-1 dsn:md:pt-0 dsn:mx-auto dsn:block dsn:md:flex dsn:flex-col dsn:flex-wrap dsn:px-0 dsn:relative dsn:z-10 dsn:md:justify-start dsn:text-white footer-inner">
            
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
                                $first = "first dsn:mb-12 ";
                            endif;
                            ?>
                            <div class="dsn:md:w-full dsn:w-2/3 dsn:md:px-5 dsn:mx-auto dsn:md:mx-0 <?php echo $first; ?>">
							    <?php if (!empty($location['location_image'])) : ?>	
                                    <img class="dsn:w-full" src="<?php echo esc_html($location['location_image']['url']); ?>" alt="<?php echo $location['tab_title']; ?>" />
                                <?php endif; ?>
<!--                             <h4 class="dsn:mt-4 dsn:font-bold m-0 dsn:text-base dsn:lg:text-2xl dsn:mx-auto dsn:text-left dsn:uppercase"><?php echo esc_html($location['tab_title']); ?></h4> -->
                            <div class="dsn:flex dsn:flex-col dsn:lg:flex-row dsn:flex-wrap dsn:gap-6 dsn:justify-between">
								<div class="footer-address-body dsn:w-full dsn:md:w-5/12">
                                        <div class="dsn:mt-4 dsn:md:mt-8 dsn:text-base dsn:lg:text-xl dsn:w-full">
										
											<h4 class="dsn:font-bold m-0 dsn:text-base dsn:lg:text-2xl dsn:mx-auto dsn:text-left dsn:uppercase"><?php echo "ADDRESS:"; ?></h4>
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
									<?php if (!empty($location['phone_2'])) : ?>
                                                <div class="dsn:flex dsn:items-center dsn:md:mt-4">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="phone dsn:w-4 dsn:h-4 dsn:md:w-6 dsn:md:h-6">
                                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                                    </svg>
                                                    
                                                    <a class="footer-link-color" href="tel:<?php echo esc_html($location['phone_2']['url']); ?>">
                                                        <?php
                                                        // Fix ext
                                                        $number_2 = str_replace(',', ' x ', $location['phone_2']['title']);
                                                        ?>
                                                        <span class="dsn:ml-2 dsn:text-base dsn:2xl:text-xl dsn:hover:text-white"><?php echo esc_html($number_2); ?></span>
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
                                    <div class="dsn:relative dsn:w-full dsn:md:w-6/12 dsn:mt-4 dsn:md:mt-8 dsn:text-base dsn:lg:text-xl hours">
										<h4 class="dsn:font-bold m-0 dsn:text-base dsn:lg:text-2xl dsn:mx-auto dsn:text-left dsn:uppercase"><?php echo "Hours:"; ?></h4>
                                    
                                    <?php foreach ($hours as $hour) : ?>
                                        <div class="dsn:flex dsn:gap-4 dsn:items-center dsn:w-full">
                                        <div class="dsn:w-32 dsn:h-auto">
                                        <?php echo $hour['days']; ?>
                                       </div>
                                       <div class="dsn:w-48 dsn:h-auto">
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
		
            </div>
		<div class="dsn:mt-4 dsn:md:mt-0 dsn:w-full dsn:md:w-1/3 dsn:md:pl-4 dsn:text-white socials">
                <div class="dsn:sm:w-full dsn:mx-auto">
					<div class="dsn:w-2/3 dsn:mx-auto dsn:md:mx-0 dsn:md:w-full dsn:mx-auto dsn:mt-4 dsn:md:mt-8">
						<h4 class="dsn:font-bold m-0 dsn:text-base dsn:lg:text-2xl dsn:mx-auto dsn:text-left dsn:uppercase"><?php echo "Social"; ?></h4>
                    <div id="social-link" class="dsn:flex dsn:flex-wrap dsn:justify-start dsn:gap-4 dsn:items-start dsn:mt-4 dsn:md:mt-4">
                      
                        <?php if ($social_networks) : ?>
                            <?php foreach ($social_networks as $network) : ?>
                                <div class="dsn:flex dsn:items-center dsn:pb-5 dsn:md:pb-4 dsn:w-auto dsn:justify-start dsn:md:justify-start">
                                    <?php // echo $network; ?>
                                <?php if($network == 'Facebook') { ?>
                                    <a href="<?php echo esc_url_raw(get_field('facebook_url', 'option')); ?>">
                                    <!-- <img src="<?php echo  get_template_directory() . '\assets\svg\social\facebook.webp'; ?>" /> -->
                                    <img class="dsn:w-10" src="/wp-content/uploads/theme-assets/social/facebook.webp" alt="<?php echo $network; ?>" />
                                    </a>
                                    <?php } elseif ($network == 'Instagram') {?>
                                    <a href="<?php echo esc_url_raw(get_field('insta_url', 'option')); ?>">
                                    <img class="dsn:w-10" src="/wp-content/uploads/theme-assets/social/insta.webp" alt="<?php echo $network; ?>" />
                                    </a>
                                    <?php } elseif ($network == 'Youtube') {?>
                                    <a href="<?php echo esc_url_raw(get_field('youtube_url', 'option')); ?>">
                                    <img class="dsn:w-10" src="/wp-content/uploads/theme-assets/social/youtube.webp" alt="<?php echo $network; ?>" />
                                    </a>
                                    <?php } elseif ($network == 'Pinterest') {?>
                                    <a href="<?php echo esc_url_raw(get_field('pinterest_url', 'option')); ?>">
                                    <img class="dsn:w-10" src="/wp-content/uploads/theme-assets/social/pin.webp" alt="<?php echo $network; ?>" />
                                    </a>
                                    <?php } ?>
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
			<div class="dsn:container dsn:mx-auto dsn:text-center dsn:text-white dsn:flex dsn:flex-col dsn:md:flex-row dsn:items-center dsn:justify-center dsn:gap-1">
				<span>&copy; <?php echo date('Y'); ?> <?php the_field('copyright', 'option'); ?></span> | <span class="dsn:flex dsn:items-center dsn:justify-center dsn:gap-1">Site By <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30.328369140625" height="32.000001072883606" viewBox="-3501.9998779296875 6842 30.328369140625 32.000001072883606"><g transform="matrix(1,0,0,1,-4711.85107421875,93)"><g transform="matrix(1,0,0,1,1209.8511962890625,6749)"><g><g transform="matrix(1,0,0,1,-2.2737367544323206e-13,0)"><path d="M 99.81491851806641 21.97014427185059 L 99.81491851806641 23.94029808044434 L 96.7701416015625 23.94029808044434 C 96.23283386230469 23.94029808044434 95.75522613525391 24.41790390014648 95.75522613525391 24.95522117614746 C 95.75522613525391 25.49253463745117 96.23283386230469 25.97014617919922 96.7701416015625 25.97014617919922 L 110.9194107055664 25.97014617919922 C 111.4567184448242 25.97014617919922 111.934326171875 25.49253463745117 111.934326171875 24.95522117614746 C 111.934326171875 24.41790390014648 111.4567184448242 23.94029808044434 110.9194107055664 23.94029808044434 L 107.874626159668 23.94029808044434 L 107.874626159668 21.97014427185059 L 107.874626159668 21.97014427185059 L 112.9492645263672 14.32835578918457 L 104.8895492553711 0 L 104.4119338989258 0 L 104.8895492553711 12 L 107.9343338012695 12 L 105.9044723510742 14.32835578918457 L 106.3820877075195 17.07462310791016 L 103.874626159668 15.76119422912598 L 101.3671646118164 17.07462310791016 L 101.8447799682617 14.32835578918457 L 99.81491851806641 12 L 102.8596954345703 12 L 103.3970184326172 0 L 102.9194030761719 0 L 94.79999542236328 14.32835578918457 L 99.81491851806641 21.97014427185059 Z" transform="matrix(1,0,0,1,-88.71044921875,0)" fill="#ffffff" fill-rule="evenodd"/><path d="M 104.6596908569336 4.700000286102295 L 106.3313369750977 7.625373363494873 C 110.2716217041016 9.894028663635254 112.8984985351562 14.07313251495361 112.8984985351562 18.90895080566406 C 112.8984985351562 24.70000076293945 109.0776062011719 29.59552192687988 103.8238677978516 31.26716804504395 L 103.8238677978516 30.31194305419922 C 103.8238677978516 30.07313537597656 103.6447830200195 29.89402961730957 103.3462677001953 29.89402961730957 L 96.18209075927734 29.89402961730957 C 95.94328308105469 29.89402961730957 95.70447540283203 30.07313537597656 95.70447540283203 30.31194305419922 L 95.70447540283203 31.26716804504395 C 90.45074462890625 29.59552192687988 86.62984466552734 24.64029502868652 86.62984466552734 18.90895080566406 C 86.62984466552734 14.0731315612793 89.25670623779297 9.894025802612305 93.19700622558594 7.625373363494873 L 94.86865997314453 4.700000286102295 C 88.89850616455078 6.729851245880127 84.59999847412109 12.2820873260498 84.59999847412109 18.90895080566406 C 84.59999847412109 25.83432579040527 89.31641387939453 31.62537002563477 95.70447540283203 33.35671997070312 C 97.01791381835938 33.71492385864258 98.33133697509766 33.8940315246582 99.76418304443359 33.8940315246582 C 101.1970138549805 33.8940315246582 102.5104370117188 33.71493530273438 103.8238906860352 33.35671997070312 C 110.2119369506836 31.62537002563477 114.9283676147461 25.77462387084961 114.9283676147461 18.90895080566406 C 114.928352355957 12.2820873260498 110.6298370361328 6.729851245880127 104.6596908569336 4.700000286102295 Z" transform="matrix(1,0,0,1,-84.5999984741211,-1.8940304517745972)" fill="#ffffff" fill-rule="evenodd"/></g></g></g></g></svg></span>
				<?php

//                 wp_nav_menu(
//                     array(
//                         'menu' => 'footer_menu',
//                         'theme_location' => 'footer',
//                         'menu_class' => 'dsn:py-0 dsn:flex dsn:flex-wrap dsn:p-0 dsn:items-center dsn:md:items-start  dsn:justify-center dsn:md:justify-center dsn:space-x-4 dsn:md:space-x-10',
//                         'link_class'   => 'dealerLinkColor dsn:text-sm dsn:md:text-xl'
//                     )
//                 );

                ?>
	</div>
	  
		</div>

</div>
