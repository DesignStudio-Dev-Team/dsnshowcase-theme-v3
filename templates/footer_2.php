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


<footer id="dsFooter" class="dsn:relative clear-both">
    <div class="footer-main bgImage">
        <div class="dsn:px-0 dsn:pt-1 dsn:md:pt-0 dsn:container dsn:block dsn:md:flex dsn:px-0 dsn:pb-10 dsn:relative dsn:md:gap-6 dsn:md:z-10 dsn:md:justify-center">
            <div class="dsn:mt-24 dsn:w-full dsn:md:w-2/5 dsn:lg:w-1/3">
                <div class="mx-auto">
                    <h4 class="dsn:font-bold dsn:m-0 dsn:text-lg dsn:text-center dsn:uppercase dsn:md:text-left text-footerPrimaryText dsn:md:hidden">How can we help?</h4>
                    <div class="dsn:flex dsn:flex-wrap items-start">
                        <?php 
						$j=1;
						foreach ($cta_buttons as $button) : ?>
                            <a class="help-icon dsn:flex dsn:flex-col dsn:items-center dsn:justify-center dsn:pb-8 dsn:w-1/2 dsn:md:w-1/3" href="<?php echo esc_url_raw($button['link_url']); ?>">
                                <div class="bg-footerPrimaryLink help-icon-img dsn:flex dsn:h-24 dsn:items-center dsn:justify-center dsn:rounded-full dsn:w-24 dsn:md:h-20 dsn:md:w-20">
                                    <img class="<?php if($j == 6) {echo 'dsn:h-8'; } else { echo 'dsn:h-12'; } ?> dsn:w-auto" src="<?php echo esc_url_raw($button['icon_url']); ?>" alt="<?php echo esc_html($button['label']); ?>">
                                </div>
                                <span class="dsn:font-medium dsn:mt-2 dsn:text-center dsn:text-base text-footerPrimaryText">
                                    <?php echo __(esc_html($button['label']), 'dealer-theme'); ?>
                                </span>
                            </a>
                        <?php 
						$j++;
						endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="dsn:mt-12 dsn:md:mt-24 dsn:w-full dsn:md:w-3/5 dsn:lg:dsn:w-1/2">
                <div class="dsn:w-full dsn:mx-auto">
                    <div class="dsn:flex dsn:flex-wrap dsn:tems-start dsn:px-10 dsn:sm:px-0">
                        <?php $i = 0; ?>
                        <?php foreach ($locations as $location) : ?>
                            <?php
                            $partial_address = "{$location['city']}, {$location['state']} {$location['zip_code']}";
                            $full_address    = "{$location['address']}, {$location['city']}, {$location['state']} {$location['zip_code']}";
                            ?>
                            <div class="dsn:mb-12 dsn:w-full dsn:sm:w-1/2 dsn:lg:w-1/2 <?php if($i==0){ echo 'dsn:border-r dsn:border-white'; } else {echo 'dsn:md:pl-10';} ?>" >
                                <h3 class="dsn:font-bold dsn:m-0 dsn:text-lg dsn:uppercase dsn:text-left text-footerPrimaryText">
                                <div class="footer-address-title dsn:flex dsn:items-center dsn:justify-start dsn:text-lg">
                                    <div class="dsn:w-full dsn:flex dsn:justify-between">
                                        <div class="dsn:font-bold">
                                            <h4 class="dsn:font-bold dsn:m-0 dsn:text-lg dsn:text-center dsn:uppercase dsn:md:text-left text-footerPrimaryText"><?php echo esc_html($location['name']); ?></h4>
                                        </div>
                                    </div>

                                </div>
                                </h3>

                                <div class="footer-address-body">
                                    <div class="">
                                        <div class="dsn:mt-8 dsn:md:mt-4 dsn:text-lg dsn:w-full">
                                            <p class="dsn:m-0 text-footerPrimaryText dsn:text-lg"><?php echo esc_html($location['address']); ?></p>
                                            <?php if (!empty($location['city']) && !empty($location['state'])) : ?>
                                                <p class="dsn:m-0 mt-1 text-footerPrimaryText dsn:text-lg"><?php echo esc_html($partial_address); ?></p>
                                            <?php endif; ?>
                                        </div>
										<div class="dsn:w-full dsn:mt-8 dsn:md:mt-4">
                                            <?php if (!empty($location['phone_number'])) : ?>
                                                <div class="dsn:flex dsn:items-center dsn:md:mt-8">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="phone dsn:w-6 dsn:h-6 fill-footerPrimaryText">
                                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                                    </svg>
                                                    <a class="dsn:text-blue-lite" href="tel:<?php echo esc_html($location['phone_number']); ?>">
                                                        <?php
                                                        // Fix ext
                                                        $number = str_replace(',', ' x ', $location['phone_number']);
                                                        ?>
                                                        <span class="dsn:ml-2 dsn:text-lg dsn:text-blue-lite text-footerPrimaryLink dsn:hover:text-footerPrimaryText"><?php echo esc_html($number); ?></span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($location['phone_number'])) : ?>
                                                <div class="dsn:flex dsn:items-center dsn:mt-2">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="location-marker dsn:w-6 dsn:h-6 fill-footerPrimaryText">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <a class="dsn:ml-2 dsn:text-lg dsn:text-blue-lite text-footerPrimaryLink hover:text-footerPrimaryText" href="<?php echo 'https://www.google.com/maps/?q=' . urlencode($full_address); ?>" target="_blank">
                                                        Get Directions
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="dsn:w-full dsn:mt-8 dsn:md:mt-4">
                                            <div class="dsn:flex dsn:flex-col dsn:justify-start dsn:items-start dsn:md:mt-8">
												 <h4 class="dsn:font-bold dsn:m-0 dsn:text-lg dsn:text-center dsn:uppercase dsn:md:text-left text-footerPrimaryText"><?php echo "HOURS:"; ?></h4>
                                                <?php if (!empty($location['hours']) && is_array($location['hours'])) : ?>
                                                    <ul class="dsn:list-none dsn:m-0 dsn:text-lg dsn:p-0">
                                                        <?php foreach ($location['hours'] as $hour) : ?>
                                                            <li class="dsn:flex dsn:flex-row dsn:w-full text-footerPrimaryText dsn:text-lg lg:dsn:text-lg xl:dsn:text-lg dsn:m-0">
                                                                <span class="dsn:w-32"><?php echo esc_html($hour['day']); ?></span>
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
            </div>

            <div class="dsn:mt-12 dsn:md:mt-12 dsn:md:mt-24 dsn:w-full dsn:md:w-1/5 dsn:md:pl-4 dsn:md:hidden">
                <div class="dsn:sm:w-full dsn:mx-auto">
                    <h4 class="dsn:font-bold dsn:m-0 dsn:text-lg dsn:text-center dsn:uppercase dsn:md:text-left text-footerPrimaryText">Social</h4>
                    <div class="dsn:flex dsn:flex-wrap dsn:justify-start dsn:items-start dsn:mt-8">
                        <?php if ($social_networks) : ?>
                            <?php foreach ($social_networks as $network) : ?>
                                <div class="dsn:flex dsn:items-center dsn:pb-10 dsn:md:pb-8 dsn:w-1/3 dsn:justify-center dsn:md:justify-start">
                                    <a href="<?php echo esc_url_raw($network['url']); ?>">
                                        <img class="dsn:h-10 dsn:w-auto dsn:md:h-12" src="<?php echo esc_url_raw($network['icon_url']); ?>" alt="<?php echo esc_html($network['social_network']); ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="lower-footer" style="background-color: #013364;">

        <div class="dsn:container">
            <div class="dsn:w-full dsn:pt-4 text-footerPrimaryText dsn:text-center dsVersion dsn:pb-4">
                &copy; <?php echo date('Y') . "All Rights Reserved." ?> <?php the_field('company_name', 'option'); ?> <span class="dsn:hidden dsn:sm:inline-block">|</span>
                <span class="dsn:block dsn:sm:inline-block">
                    Site by <a href="https://designstudio.com/" target="_blank" class="dsn:sm:inline-block dsn:align-middle"><svg title="DesignStudio Logo" id="Group_171" data-name="Group 171" xmlns="http://www.w3.org/2000/svg" width="30.328" height="32" viewBox="0 0 30.328 32">
                    <g id="Group_343" data-name="Group 343">
                        <g id="Group_53" data-name="Group 53" transform="translate(0)">
                        <path id="Path_1" data-name="Path 1" d="M99.815,21.97v1.97H96.77a1.015,1.015,0,0,0,0,2.03h14.149a1.015,1.015,0,0,0,0-2.03h-3.045V21.97h0l5.075-7.642L104.89,0h-.478l.478,12h3.045l-2.03,2.328.478,2.746-2.507-1.313-2.507,1.313.478-2.746L99.815,12h3.045L103.4,0h-.478L94.8,14.328Z" transform="translate(-88.71)" fill="#fff"/>
                        <path id="Path_2" data-name="Path 2" d="M104.66,4.7l1.672,2.925a12.963,12.963,0,0,1-2.507,23.642v-.955a.426.426,0,0,0-.478-.418H96.182a.461.461,0,0,0-.478.418v.955A12.963,12.963,0,0,1,93.2,7.625L94.869,4.7A14.958,14.958,0,0,0,95.7,33.357a15.165,15.165,0,0,0,19.224-14.448A15.014,15.014,0,0,0,104.66,4.7Z" transform="translate(-84.6 -1.894)" fill="#fff"/>
                        </g>
                    </g>
                    </svg></a>
                </span>
                
            </div>
            <div class="dsn:w-full dsn:pb-8 dsn:text-center dsn:md:hidden">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'lower_footer_menu',
                        'theme_location' => 'lower_footer',
                        'menu_class' => 'dsn:py-4 dsn:md:py-0 dsn:flex dsn:flex-row dsn:items-center dsn:justify-center dsn:gap-4',
                        'link_class'   => 'dsn:text-base text-footerPrimaryLink hover:text-footerPrimaryText'
                    )
                );
                ?>
            </div>
        </div>
    </div>

</footer>

</div><!-- #page -->

<!-- THEME CUSTOM CODE -->
<?php the_field('code_after_footer', 'option'); ?>
<!-- THEME CUSTOM CODE -->

<style>

    .bgImage {
        background-image: url(https://superiorfireplaceandhottubs.com/wp-content/uploads/2024/11/footer-bg-3.webp);
    }
    #dsFooter h3 {
        font-size: 25px;
    }

    #dsFooter .footer_menu ul {
        list-style: none;
        padding: 0;
        margin: 15px 0 0;
    }

    #dsFooter .footer_menu ul li {
        list-style: none;
        padding: 5px 0;
    }

    #dsFooter .footer_menu ul li a {
        color: #406418;
    }

    #dsFooter .footer_menu ul li a:hover {
        color: #5b8f21;
    }

    #dsFooter {
        margin-top: 50px;
    }

    .bg-footerPrimaryLink {
        background-color: #cc3100;
    }

    .text-footerPrimaryLink {
        color: #00a5e6;
    }

    .text-footerPrimaryLink:hover {
        color: #ffffff;
    }

    .text-footerPrimaryText {
        color: #ffffff;
    }

    .fill-footerPrimaryText {
        fill: #ffffff;
    }


</style>
