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
<style>
#colophon {
  padding-bottom: .75rem;
  padding-top: .75rem;
  font-size: 20px;
  background: #10b981;
}
</style>
<section id="request-quote" class="dsn:bg-gray-800 dsn:text-white dsn:text-center dsn:relative dsn:z-30 dsn:py-10">
	
	<div class="dsn:container dsn:z-40 dsn:w-full dsn:md:w-8/12 dsn:mx-auto">
	<h2 class="dsn:text-4xl dsn:font-bold">
		Request a Quote
	</h2>
	<div class="dsn:w-full dsn:md:w-7/12 dsn:mx-auto dsn:py-10 schedule-form">
	<?php echo do_shortcode('[gravityform id="82" title="true"]'); ?>
	</div>
	</div>
</section> 
<footer id="dsFooter" class="dsn:relative dsn:clear-both dsn:z-0">
    
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
<style>
    .dealerLinkColor {
        color: #00BFE6;
    }
    .dealerLinkColor:hover {
        color: #fff;
    }

    .admin-hidden-markup, .gfield_visibility_hidden {
        display: none;
    }
</style>