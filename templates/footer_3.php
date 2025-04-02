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
        background-color: #191919;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .footer-link-color {
        color: #089BF7;
        
    }
    #footer-copyright {
       background: #333333;
    }
    .footer-menu {
        background: url('https://valleyhotspring.designstudio.host/wp-content/uploads/2025/03/footer-menu-valley.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height:466px;
        width:100%;
        color:white;
    }
    .footer-circle {
        width: 163px;
        height: 163px;
        border-radius: 50%;
        background: var(--dealerColor);
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 10px;
    }
 </style>

<footer id="dsFooter" class="dsn:relative dsn:clear-both">
    <div class="footer-menu dsn:p-15">
        <div class="dsn:container dsn:mx-auto">
            <h2 class="dsn:text-center">Get In Touch</h2>
        </div>
        <div class="dsn:container dsn:gap-10 dsn:justify-center dsn:align-middle dsn:items-center dsn:mx-auto dsn:flex">
            <div>
                <img width="198px" height="199px" src="https://valleyhotspring.designstudio.host/wp-content/uploads/2025/03/valley-logo.png" alt="logo">
                <p class="dsn:text-center dsn:pt-2">Since 1997</p>
            </div>
            <div class="dsn:px-10 dsn:gap-5 dsn:flex dsn:justify-between">
       <div class="dsn:flex dsn:flex-col dsn:justify-center">       

<div class="footer-circle">

<svg xmlns="http://www.w3.org/2000/svg" width="68.691" height="77.108" viewBox="0 0 68.691 77.108">
<g id="Group_400" data-name="Group 400" transform="translate(0.5 0.5)">
    <g id="Group_395" data-name="Group 395" transform="translate(0.006 24.743)">
    <path id="Path_80" data-name="Path 80" d="M137.669,351.632c-7.6-.464-15.945-1.375-19.125-3.168v7.2a.676.676,0,0,1,.034.17c.224.805,4.242,1.983,11.8,2.834A27.066,27.066,0,0,1,137.669,351.632Z" transform="translate(-118.544 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_81" data-name="Path 81" d="M172.672,351.633a27.074,27.074,0,0,1,7.293,7.036c7.562-.852,11.586-2.033,11.81-2.846a.659.659,0,0,1,.033-.163v-7.194C188.626,350.258,180.279,351.169,172.672,351.633Z" transform="translate(-124.123 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_396" data-name="Group 396" transform="translate(0.006 33.745)">
    <path id="Path_82" data-name="Path 82" d="M129.533,360.982c-4.752-.539-8.941-1.327-10.989-2.481v7.2a.681.681,0,0,1,.034.171c.18.649,2.842,1.54,7.813,2.307A26.723,26.723,0,0,1,129.533,360.982Z" transform="translate(-118.544 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_83" data-name="Path 83" d="M181.743,360.984a26.775,26.775,0,0,1,3.141,7.2c4.978-.77,7.644-1.665,7.826-2.32a.655.655,0,0,1,.033-.162v-7.2C190.693,359.656,186.5,360.444,181.743,360.984Z" transform="translate(-125.058 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_397" data-name="Group 397" transform="translate(0.006 42.747)">
    <path id="Path_84" data-name="Path 84" d="M125.425,376.271a27.027,27.027,0,0,1,.62-5.715,24.875,24.875,0,0,1-7.5-2.019v7.2a.683.683,0,0,1,.034.171c.17.612,2.517,1.438,6.939,2.173C125.476,377.48,125.425,376.882,125.425,376.271Z" transform="translate(-118.544 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_85" data-name="Path 85" d="M185.63,370.558a27.006,27.006,0,0,1,.62,5.713c0,.611-.051,1.209-.091,1.809,4.429-.736,6.78-1.568,6.951-2.185a.661.661,0,0,1,.033-.163v-7.194A24.932,24.932,0,0,1,185.63,370.558Z" transform="translate(-125.459 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_398" data-name="Group 398" transform="translate(0 51.746)">
    <path id="Path_86" data-name="Path 86" d="M125.635,380.528a23.93,23.93,0,0,1-7.1-1.958v7.486h.013c.133,1.2,3.787,2.283,9.636,3.076A26.709,26.709,0,0,1,125.635,380.528Z" transform="translate(-118.537 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_87" data-name="Path 87" d="M185.794,380.53a26.751,26.751,0,0,1-2.552,8.6c5.851-.794,9.5-1.876,9.636-3.077h.014V378.57A23.826,23.826,0,0,1,185.794,380.53Z" transform="translate(-125.207 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <ellipse id="Ellipse_61" data-name="Ellipse 61" cx="33.842" cy="4.501" rx="33.842" ry="4.501" transform="translate(0.006)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_88" data-name="Path 88" d="M152.386,339.659c21.791,0,33.422-2.506,33.81-3.91a.659.659,0,0,1,.033-.163v-7.2c-6.382,3.6-33.532,3.646-33.843,3.646s-27.46-.049-33.842-3.646v7.2a.675.675,0,0,1,.034.17C118.965,337.153,130.6,339.659,152.386,339.659Z" transform="translate(-118.538 -321.652)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_89" data-name="Path 89" d="M152.386,342.074c-.31,0-27.46-.049-33.842-3.646v7.2a.683.683,0,0,1,.034.171c.3,1.091,7.544,2.861,21.14,3.579a26.918,26.918,0,0,1,25.326,0c13.6-.717,20.848-2.491,21.152-3.591a.651.651,0,0,1,.033-.162v-7.2C179.847,342.025,152.7,342.074,152.386,342.074Z" transform="translate(-118.538 -322.686)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_90" data-name="Path 90" d="M153.324,348.588a25.627,25.627,0,1,0,25.627,25.627A25.627,25.627,0,0,0,153.324,348.588Zm0,46.427a20.8,20.8,0,1,1,20.8-20.8A20.824,20.824,0,0,1,153.324,395.015Z" transform="translate(-119.481 -323.734)" fill="#fff" stroke="#333" stroke-width="1"/>
    <g id="Group_399" data-name="Group 399" transform="translate(14.483 31.12)">
    <path id="Path_91" data-name="Path 91" d="M157.223,378.839v6.309a4.04,4.04,0,0,0,1.834-.58A2.987,2.987,0,0,0,160.063,382a2.743,2.743,0,0,0-.941-2.195A6.852,6.852,0,0,0,157.223,378.839Z" transform="translate(-137.007 -357.972)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_92" data-name="Path 92" d="M154.044,355.574a19.361,19.361,0,1,0,19.36,19.361A19.382,19.382,0,0,0,154.044,355.574Zm5.18,29.451a9.459,9.459,0,0,1-4.324,1.323v3.244h-1.566v-3.212a10.984,10.984,0,0,1-4.744-1.388q-2.759-1.855-2.711-6.325h4.357a7.9,7.9,0,0,0,.63,2.727,3.319,3.319,0,0,0,2.468,1.4v-6.89l-1.307-.388A8.353,8.353,0,0,1,147.679,373a6.1,6.1,0,0,1-1.267-3.889,7.261,7.261,0,0,1,.492-2.727,6.365,6.365,0,0,1,3.929-3.7,11.727,11.727,0,0,1,2.5-.4v-2.145H154.9v2.178a8.024,8.024,0,0,1,4.111,1.292,6.339,6.339,0,0,1,2.811,5.6h-4.244a5.829,5.829,0,0,0-.478-2.1,2.479,2.479,0,0,0-2.2-1.258V372a20.176,20.176,0,0,1,5.141,2.34,5.712,5.712,0,0,1,2.169,4.777A6.414,6.414,0,0,1,159.224,385.025Z" transform="translate(-134.684 -355.574)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_93" data-name="Path 93" d="M152.4,369.784a2.576,2.576,0,0,0,1.016,2.146,5.748,5.748,0,0,0,1.743.806v-5.663a2.834,2.834,0,0,0-2.081.75A2.742,2.742,0,0,0,152.4,369.784Z" transform="translate(-136.51 -356.759)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
</g>
</svg>
</div>
<p class="dsn:text-center dsn:pt-2">Get Pricing</p> 
</div>
<div class="dsn:flex dsn:flex-col dsn:justify-center">       

<div class="footer-circle">

<svg xmlns="http://www.w3.org/2000/svg" width="68.691" height="77.108" viewBox="0 0 68.691 77.108">
<g id="Group_400" data-name="Group 400" transform="translate(0.5 0.5)">
    <g id="Group_395" data-name="Group 395" transform="translate(0.006 24.743)">
    <path id="Path_80" data-name="Path 80" d="M137.669,351.632c-7.6-.464-15.945-1.375-19.125-3.168v7.2a.676.676,0,0,1,.034.17c.224.805,4.242,1.983,11.8,2.834A27.066,27.066,0,0,1,137.669,351.632Z" transform="translate(-118.544 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_81" data-name="Path 81" d="M172.672,351.633a27.074,27.074,0,0,1,7.293,7.036c7.562-.852,11.586-2.033,11.81-2.846a.659.659,0,0,1,.033-.163v-7.194C188.626,350.258,180.279,351.169,172.672,351.633Z" transform="translate(-124.123 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_396" data-name="Group 396" transform="translate(0.006 33.745)">
    <path id="Path_82" data-name="Path 82" d="M129.533,360.982c-4.752-.539-8.941-1.327-10.989-2.481v7.2a.681.681,0,0,1,.034.171c.18.649,2.842,1.54,7.813,2.307A26.723,26.723,0,0,1,129.533,360.982Z" transform="translate(-118.544 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_83" data-name="Path 83" d="M181.743,360.984a26.775,26.775,0,0,1,3.141,7.2c4.978-.77,7.644-1.665,7.826-2.32a.655.655,0,0,1,.033-.162v-7.2C190.693,359.656,186.5,360.444,181.743,360.984Z" transform="translate(-125.058 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_397" data-name="Group 397" transform="translate(0.006 42.747)">
    <path id="Path_84" data-name="Path 84" d="M125.425,376.271a27.027,27.027,0,0,1,.62-5.715,24.875,24.875,0,0,1-7.5-2.019v7.2a.683.683,0,0,1,.034.171c.17.612,2.517,1.438,6.939,2.173C125.476,377.48,125.425,376.882,125.425,376.271Z" transform="translate(-118.544 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_85" data-name="Path 85" d="M185.63,370.558a27.006,27.006,0,0,1,.62,5.713c0,.611-.051,1.209-.091,1.809,4.429-.736,6.78-1.568,6.951-2.185a.661.661,0,0,1,.033-.163v-7.194A24.932,24.932,0,0,1,185.63,370.558Z" transform="translate(-125.459 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_398" data-name="Group 398" transform="translate(0 51.746)">
    <path id="Path_86" data-name="Path 86" d="M125.635,380.528a23.93,23.93,0,0,1-7.1-1.958v7.486h.013c.133,1.2,3.787,2.283,9.636,3.076A26.709,26.709,0,0,1,125.635,380.528Z" transform="translate(-118.537 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_87" data-name="Path 87" d="M185.794,380.53a26.751,26.751,0,0,1-2.552,8.6c5.851-.794,9.5-1.876,9.636-3.077h.014V378.57A23.826,23.826,0,0,1,185.794,380.53Z" transform="translate(-125.207 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <ellipse id="Ellipse_61" data-name="Ellipse 61" cx="33.842" cy="4.501" rx="33.842" ry="4.501" transform="translate(0.006)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_88" data-name="Path 88" d="M152.386,339.659c21.791,0,33.422-2.506,33.81-3.91a.659.659,0,0,1,.033-.163v-7.2c-6.382,3.6-33.532,3.646-33.843,3.646s-27.46-.049-33.842-3.646v7.2a.675.675,0,0,1,.034.17C118.965,337.153,130.6,339.659,152.386,339.659Z" transform="translate(-118.538 -321.652)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_89" data-name="Path 89" d="M152.386,342.074c-.31,0-27.46-.049-33.842-3.646v7.2a.683.683,0,0,1,.034.171c.3,1.091,7.544,2.861,21.14,3.579a26.918,26.918,0,0,1,25.326,0c13.6-.717,20.848-2.491,21.152-3.591a.651.651,0,0,1,.033-.162v-7.2C179.847,342.025,152.7,342.074,152.386,342.074Z" transform="translate(-118.538 -322.686)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_90" data-name="Path 90" d="M153.324,348.588a25.627,25.627,0,1,0,25.627,25.627A25.627,25.627,0,0,0,153.324,348.588Zm0,46.427a20.8,20.8,0,1,1,20.8-20.8A20.824,20.824,0,0,1,153.324,395.015Z" transform="translate(-119.481 -323.734)" fill="#fff" stroke="#333" stroke-width="1"/>
    <g id="Group_399" data-name="Group 399" transform="translate(14.483 31.12)">
    <path id="Path_91" data-name="Path 91" d="M157.223,378.839v6.309a4.04,4.04,0,0,0,1.834-.58A2.987,2.987,0,0,0,160.063,382a2.743,2.743,0,0,0-.941-2.195A6.852,6.852,0,0,0,157.223,378.839Z" transform="translate(-137.007 -357.972)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_92" data-name="Path 92" d="M154.044,355.574a19.361,19.361,0,1,0,19.36,19.361A19.382,19.382,0,0,0,154.044,355.574Zm5.18,29.451a9.459,9.459,0,0,1-4.324,1.323v3.244h-1.566v-3.212a10.984,10.984,0,0,1-4.744-1.388q-2.759-1.855-2.711-6.325h4.357a7.9,7.9,0,0,0,.63,2.727,3.319,3.319,0,0,0,2.468,1.4v-6.89l-1.307-.388A8.353,8.353,0,0,1,147.679,373a6.1,6.1,0,0,1-1.267-3.889,7.261,7.261,0,0,1,.492-2.727,6.365,6.365,0,0,1,3.929-3.7,11.727,11.727,0,0,1,2.5-.4v-2.145H154.9v2.178a8.024,8.024,0,0,1,4.111,1.292,6.339,6.339,0,0,1,2.811,5.6h-4.244a5.829,5.829,0,0,0-.478-2.1,2.479,2.479,0,0,0-2.2-1.258V372a20.176,20.176,0,0,1,5.141,2.34,5.712,5.712,0,0,1,2.169,4.777A6.414,6.414,0,0,1,159.224,385.025Z" transform="translate(-134.684 -355.574)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_93" data-name="Path 93" d="M152.4,369.784a2.576,2.576,0,0,0,1.016,2.146,5.748,5.748,0,0,0,1.743.806v-5.663a2.834,2.834,0,0,0-2.081.75A2.742,2.742,0,0,0,152.4,369.784Z" transform="translate(-136.51 -356.759)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
</g>
</svg>
</div>
<p class="dsn:text-center dsn:pt-2">Brochures</p> 
</div>

<div class="dsn:flex dsn:flex-col dsn:justify-center">       

<div class="footer-circle">

<svg xmlns="http://www.w3.org/2000/svg" width="68.691" height="77.108" viewBox="0 0 68.691 77.108">
<g id="Group_400" data-name="Group 400" transform="translate(0.5 0.5)">
    <g id="Group_395" data-name="Group 395" transform="translate(0.006 24.743)">
    <path id="Path_80" data-name="Path 80" d="M137.669,351.632c-7.6-.464-15.945-1.375-19.125-3.168v7.2a.676.676,0,0,1,.034.17c.224.805,4.242,1.983,11.8,2.834A27.066,27.066,0,0,1,137.669,351.632Z" transform="translate(-118.544 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_81" data-name="Path 81" d="M172.672,351.633a27.074,27.074,0,0,1,7.293,7.036c7.562-.852,11.586-2.033,11.81-2.846a.659.659,0,0,1,.033-.163v-7.194C188.626,350.258,180.279,351.169,172.672,351.633Z" transform="translate(-124.123 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_396" data-name="Group 396" transform="translate(0.006 33.745)">
    <path id="Path_82" data-name="Path 82" d="M129.533,360.982c-4.752-.539-8.941-1.327-10.989-2.481v7.2a.681.681,0,0,1,.034.171c.18.649,2.842,1.54,7.813,2.307A26.723,26.723,0,0,1,129.533,360.982Z" transform="translate(-118.544 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_83" data-name="Path 83" d="M181.743,360.984a26.775,26.775,0,0,1,3.141,7.2c4.978-.77,7.644-1.665,7.826-2.32a.655.655,0,0,1,.033-.162v-7.2C190.693,359.656,186.5,360.444,181.743,360.984Z" transform="translate(-125.058 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_397" data-name="Group 397" transform="translate(0.006 42.747)">
    <path id="Path_84" data-name="Path 84" d="M125.425,376.271a27.027,27.027,0,0,1,.62-5.715,24.875,24.875,0,0,1-7.5-2.019v7.2a.683.683,0,0,1,.034.171c.17.612,2.517,1.438,6.939,2.173C125.476,377.48,125.425,376.882,125.425,376.271Z" transform="translate(-118.544 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_85" data-name="Path 85" d="M185.63,370.558a27.006,27.006,0,0,1,.62,5.713c0,.611-.051,1.209-.091,1.809,4.429-.736,6.78-1.568,6.951-2.185a.661.661,0,0,1,.033-.163v-7.194A24.932,24.932,0,0,1,185.63,370.558Z" transform="translate(-125.459 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_398" data-name="Group 398" transform="translate(0 51.746)">
    <path id="Path_86" data-name="Path 86" d="M125.635,380.528a23.93,23.93,0,0,1-7.1-1.958v7.486h.013c.133,1.2,3.787,2.283,9.636,3.076A26.709,26.709,0,0,1,125.635,380.528Z" transform="translate(-118.537 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_87" data-name="Path 87" d="M185.794,380.53a26.751,26.751,0,0,1-2.552,8.6c5.851-.794,9.5-1.876,9.636-3.077h.014V378.57A23.826,23.826,0,0,1,185.794,380.53Z" transform="translate(-125.207 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <ellipse id="Ellipse_61" data-name="Ellipse 61" cx="33.842" cy="4.501" rx="33.842" ry="4.501" transform="translate(0.006)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_88" data-name="Path 88" d="M152.386,339.659c21.791,0,33.422-2.506,33.81-3.91a.659.659,0,0,1,.033-.163v-7.2c-6.382,3.6-33.532,3.646-33.843,3.646s-27.46-.049-33.842-3.646v7.2a.675.675,0,0,1,.034.17C118.965,337.153,130.6,339.659,152.386,339.659Z" transform="translate(-118.538 -321.652)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_89" data-name="Path 89" d="M152.386,342.074c-.31,0-27.46-.049-33.842-3.646v7.2a.683.683,0,0,1,.034.171c.3,1.091,7.544,2.861,21.14,3.579a26.918,26.918,0,0,1,25.326,0c13.6-.717,20.848-2.491,21.152-3.591a.651.651,0,0,1,.033-.162v-7.2C179.847,342.025,152.7,342.074,152.386,342.074Z" transform="translate(-118.538 -322.686)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_90" data-name="Path 90" d="M153.324,348.588a25.627,25.627,0,1,0,25.627,25.627A25.627,25.627,0,0,0,153.324,348.588Zm0,46.427a20.8,20.8,0,1,1,20.8-20.8A20.824,20.824,0,0,1,153.324,395.015Z" transform="translate(-119.481 -323.734)" fill="#fff" stroke="#333" stroke-width="1"/>
    <g id="Group_399" data-name="Group 399" transform="translate(14.483 31.12)">
    <path id="Path_91" data-name="Path 91" d="M157.223,378.839v6.309a4.04,4.04,0,0,0,1.834-.58A2.987,2.987,0,0,0,160.063,382a2.743,2.743,0,0,0-.941-2.195A6.852,6.852,0,0,0,157.223,378.839Z" transform="translate(-137.007 -357.972)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_92" data-name="Path 92" d="M154.044,355.574a19.361,19.361,0,1,0,19.36,19.361A19.382,19.382,0,0,0,154.044,355.574Zm5.18,29.451a9.459,9.459,0,0,1-4.324,1.323v3.244h-1.566v-3.212a10.984,10.984,0,0,1-4.744-1.388q-2.759-1.855-2.711-6.325h4.357a7.9,7.9,0,0,0,.63,2.727,3.319,3.319,0,0,0,2.468,1.4v-6.89l-1.307-.388A8.353,8.353,0,0,1,147.679,373a6.1,6.1,0,0,1-1.267-3.889,7.261,7.261,0,0,1,.492-2.727,6.365,6.365,0,0,1,3.929-3.7,11.727,11.727,0,0,1,2.5-.4v-2.145H154.9v2.178a8.024,8.024,0,0,1,4.111,1.292,6.339,6.339,0,0,1,2.811,5.6h-4.244a5.829,5.829,0,0,0-.478-2.1,2.479,2.479,0,0,0-2.2-1.258V372a20.176,20.176,0,0,1,5.141,2.34,5.712,5.712,0,0,1,2.169,4.777A6.414,6.414,0,0,1,159.224,385.025Z" transform="translate(-134.684 -355.574)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_93" data-name="Path 93" d="M152.4,369.784a2.576,2.576,0,0,0,1.016,2.146,5.748,5.748,0,0,0,1.743.806v-5.663a2.834,2.834,0,0,0-2.081.75A2.742,2.742,0,0,0,152.4,369.784Z" transform="translate(-136.51 -356.759)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
</g>
</svg>
</div>
<p class="dsn:text-center dsn:pt-2">Test Soak</p> 
</div>

<div class="dsn:flex dsn:flex-col dsn:justify-center">       

<div class="footer-circle">

<svg xmlns="http://www.w3.org/2000/svg" width="68.691" height="77.108" viewBox="0 0 68.691 77.108">
<g id="Group_400" data-name="Group 400" transform="translate(0.5 0.5)">
    <g id="Group_395" data-name="Group 395" transform="translate(0.006 24.743)">
    <path id="Path_80" data-name="Path 80" d="M137.669,351.632c-7.6-.464-15.945-1.375-19.125-3.168v7.2a.676.676,0,0,1,.034.17c.224.805,4.242,1.983,11.8,2.834A27.066,27.066,0,0,1,137.669,351.632Z" transform="translate(-118.544 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_81" data-name="Path 81" d="M172.672,351.633a27.074,27.074,0,0,1,7.293,7.036c7.562-.852,11.586-2.033,11.81-2.846a.659.659,0,0,1,.033-.163v-7.194C188.626,350.258,180.279,351.169,172.672,351.633Z" transform="translate(-124.123 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_396" data-name="Group 396" transform="translate(0.006 33.745)">
    <path id="Path_82" data-name="Path 82" d="M129.533,360.982c-4.752-.539-8.941-1.327-10.989-2.481v7.2a.681.681,0,0,1,.034.171c.18.649,2.842,1.54,7.813,2.307A26.723,26.723,0,0,1,129.533,360.982Z" transform="translate(-118.544 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_83" data-name="Path 83" d="M181.743,360.984a26.775,26.775,0,0,1,3.141,7.2c4.978-.77,7.644-1.665,7.826-2.32a.655.655,0,0,1,.033-.162v-7.2C190.693,359.656,186.5,360.444,181.743,360.984Z" transform="translate(-125.058 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_397" data-name="Group 397" transform="translate(0.006 42.747)">
    <path id="Path_84" data-name="Path 84" d="M125.425,376.271a27.027,27.027,0,0,1,.62-5.715,24.875,24.875,0,0,1-7.5-2.019v7.2a.683.683,0,0,1,.034.171c.17.612,2.517,1.438,6.939,2.173C125.476,377.48,125.425,376.882,125.425,376.271Z" transform="translate(-118.544 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_85" data-name="Path 85" d="M185.63,370.558a27.006,27.006,0,0,1,.62,5.713c0,.611-.051,1.209-.091,1.809,4.429-.736,6.78-1.568,6.951-2.185a.661.661,0,0,1,.033-.163v-7.194A24.932,24.932,0,0,1,185.63,370.558Z" transform="translate(-125.459 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_398" data-name="Group 398" transform="translate(0 51.746)">
    <path id="Path_86" data-name="Path 86" d="M125.635,380.528a23.93,23.93,0,0,1-7.1-1.958v7.486h.013c.133,1.2,3.787,2.283,9.636,3.076A26.709,26.709,0,0,1,125.635,380.528Z" transform="translate(-118.537 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_87" data-name="Path 87" d="M185.794,380.53a26.751,26.751,0,0,1-2.552,8.6c5.851-.794,9.5-1.876,9.636-3.077h.014V378.57A23.826,23.826,0,0,1,185.794,380.53Z" transform="translate(-125.207 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <ellipse id="Ellipse_61" data-name="Ellipse 61" cx="33.842" cy="4.501" rx="33.842" ry="4.501" transform="translate(0.006)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_88" data-name="Path 88" d="M152.386,339.659c21.791,0,33.422-2.506,33.81-3.91a.659.659,0,0,1,.033-.163v-7.2c-6.382,3.6-33.532,3.646-33.843,3.646s-27.46-.049-33.842-3.646v7.2a.675.675,0,0,1,.034.17C118.965,337.153,130.6,339.659,152.386,339.659Z" transform="translate(-118.538 -321.652)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_89" data-name="Path 89" d="M152.386,342.074c-.31,0-27.46-.049-33.842-3.646v7.2a.683.683,0,0,1,.034.171c.3,1.091,7.544,2.861,21.14,3.579a26.918,26.918,0,0,1,25.326,0c13.6-.717,20.848-2.491,21.152-3.591a.651.651,0,0,1,.033-.162v-7.2C179.847,342.025,152.7,342.074,152.386,342.074Z" transform="translate(-118.538 -322.686)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_90" data-name="Path 90" d="M153.324,348.588a25.627,25.627,0,1,0,25.627,25.627A25.627,25.627,0,0,0,153.324,348.588Zm0,46.427a20.8,20.8,0,1,1,20.8-20.8A20.824,20.824,0,0,1,153.324,395.015Z" transform="translate(-119.481 -323.734)" fill="#fff" stroke="#333" stroke-width="1"/>
    <g id="Group_399" data-name="Group 399" transform="translate(14.483 31.12)">
    <path id="Path_91" data-name="Path 91" d="M157.223,378.839v6.309a4.04,4.04,0,0,0,1.834-.58A2.987,2.987,0,0,0,160.063,382a2.743,2.743,0,0,0-.941-2.195A6.852,6.852,0,0,0,157.223,378.839Z" transform="translate(-137.007 -357.972)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_92" data-name="Path 92" d="M154.044,355.574a19.361,19.361,0,1,0,19.36,19.361A19.382,19.382,0,0,0,154.044,355.574Zm5.18,29.451a9.459,9.459,0,0,1-4.324,1.323v3.244h-1.566v-3.212a10.984,10.984,0,0,1-4.744-1.388q-2.759-1.855-2.711-6.325h4.357a7.9,7.9,0,0,0,.63,2.727,3.319,3.319,0,0,0,2.468,1.4v-6.89l-1.307-.388A8.353,8.353,0,0,1,147.679,373a6.1,6.1,0,0,1-1.267-3.889,7.261,7.261,0,0,1,.492-2.727,6.365,6.365,0,0,1,3.929-3.7,11.727,11.727,0,0,1,2.5-.4v-2.145H154.9v2.178a8.024,8.024,0,0,1,4.111,1.292,6.339,6.339,0,0,1,2.811,5.6h-4.244a5.829,5.829,0,0,0-.478-2.1,2.479,2.479,0,0,0-2.2-1.258V372a20.176,20.176,0,0,1,5.141,2.34,5.712,5.712,0,0,1,2.169,4.777A6.414,6.414,0,0,1,159.224,385.025Z" transform="translate(-134.684 -355.574)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_93" data-name="Path 93" d="M152.4,369.784a2.576,2.576,0,0,0,1.016,2.146,5.748,5.748,0,0,0,1.743.806v-5.663a2.834,2.834,0,0,0-2.081.75A2.742,2.742,0,0,0,152.4,369.784Z" transform="translate(-136.51 -356.759)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
</g>
</svg>
</div>
<p class="dsn:text-center dsn:pt-2">FREE Consult</p> 
</div>

<div class="dsn:flex dsn:flex-col dsn:justify-center">       

<div class="footer-circle">

<svg xmlns="http://www.w3.org/2000/svg" width="68.691" height="77.108" viewBox="0 0 68.691 77.108">
<g id="Group_400" data-name="Group 400" transform="translate(0.5 0.5)">
    <g id="Group_395" data-name="Group 395" transform="translate(0.006 24.743)">
    <path id="Path_80" data-name="Path 80" d="M137.669,351.632c-7.6-.464-15.945-1.375-19.125-3.168v7.2a.676.676,0,0,1,.034.17c.224.805,4.242,1.983,11.8,2.834A27.066,27.066,0,0,1,137.669,351.632Z" transform="translate(-118.544 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_81" data-name="Path 81" d="M172.672,351.633a27.074,27.074,0,0,1,7.293,7.036c7.562-.852,11.586-2.033,11.81-2.846a.659.659,0,0,1,.033-.163v-7.194C188.626,350.258,180.279,351.169,172.672,351.633Z" transform="translate(-124.123 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_396" data-name="Group 396" transform="translate(0.006 33.745)">
    <path id="Path_82" data-name="Path 82" d="M129.533,360.982c-4.752-.539-8.941-1.327-10.989-2.481v7.2a.681.681,0,0,1,.034.171c.18.649,2.842,1.54,7.813,2.307A26.723,26.723,0,0,1,129.533,360.982Z" transform="translate(-118.544 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_83" data-name="Path 83" d="M181.743,360.984a26.775,26.775,0,0,1,3.141,7.2c4.978-.77,7.644-1.665,7.826-2.32a.655.655,0,0,1,.033-.162v-7.2C190.693,359.656,186.5,360.444,181.743,360.984Z" transform="translate(-125.058 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_397" data-name="Group 397" transform="translate(0.006 42.747)">
    <path id="Path_84" data-name="Path 84" d="M125.425,376.271a27.027,27.027,0,0,1,.62-5.715,24.875,24.875,0,0,1-7.5-2.019v7.2a.683.683,0,0,1,.034.171c.17.612,2.517,1.438,6.939,2.173C125.476,377.48,125.425,376.882,125.425,376.271Z" transform="translate(-118.544 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_85" data-name="Path 85" d="M185.63,370.558a27.006,27.006,0,0,1,.62,5.713c0,.611-.051,1.209-.091,1.809,4.429-.736,6.78-1.568,6.951-2.185a.661.661,0,0,1,.033-.163v-7.194A24.932,24.932,0,0,1,185.63,370.558Z" transform="translate(-125.459 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_398" data-name="Group 398" transform="translate(0 51.746)">
    <path id="Path_86" data-name="Path 86" d="M125.635,380.528a23.93,23.93,0,0,1-7.1-1.958v7.486h.013c.133,1.2,3.787,2.283,9.636,3.076A26.709,26.709,0,0,1,125.635,380.528Z" transform="translate(-118.537 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_87" data-name="Path 87" d="M185.794,380.53a26.751,26.751,0,0,1-2.552,8.6c5.851-.794,9.5-1.876,9.636-3.077h.014V378.57A23.826,23.826,0,0,1,185.794,380.53Z" transform="translate(-125.207 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <ellipse id="Ellipse_61" data-name="Ellipse 61" cx="33.842" cy="4.501" rx="33.842" ry="4.501" transform="translate(0.006)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_88" data-name="Path 88" d="M152.386,339.659c21.791,0,33.422-2.506,33.81-3.91a.659.659,0,0,1,.033-.163v-7.2c-6.382,3.6-33.532,3.646-33.843,3.646s-27.46-.049-33.842-3.646v7.2a.675.675,0,0,1,.034.17C118.965,337.153,130.6,339.659,152.386,339.659Z" transform="translate(-118.538 -321.652)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_89" data-name="Path 89" d="M152.386,342.074c-.31,0-27.46-.049-33.842-3.646v7.2a.683.683,0,0,1,.034.171c.3,1.091,7.544,2.861,21.14,3.579a26.918,26.918,0,0,1,25.326,0c13.6-.717,20.848-2.491,21.152-3.591a.651.651,0,0,1,.033-.162v-7.2C179.847,342.025,152.7,342.074,152.386,342.074Z" transform="translate(-118.538 -322.686)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_90" data-name="Path 90" d="M153.324,348.588a25.627,25.627,0,1,0,25.627,25.627A25.627,25.627,0,0,0,153.324,348.588Zm0,46.427a20.8,20.8,0,1,1,20.8-20.8A20.824,20.824,0,0,1,153.324,395.015Z" transform="translate(-119.481 -323.734)" fill="#fff" stroke="#333" stroke-width="1"/>
    <g id="Group_399" data-name="Group 399" transform="translate(14.483 31.12)">
    <path id="Path_91" data-name="Path 91" d="M157.223,378.839v6.309a4.04,4.04,0,0,0,1.834-.58A2.987,2.987,0,0,0,160.063,382a2.743,2.743,0,0,0-.941-2.195A6.852,6.852,0,0,0,157.223,378.839Z" transform="translate(-137.007 -357.972)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_92" data-name="Path 92" d="M154.044,355.574a19.361,19.361,0,1,0,19.36,19.361A19.382,19.382,0,0,0,154.044,355.574Zm5.18,29.451a9.459,9.459,0,0,1-4.324,1.323v3.244h-1.566v-3.212a10.984,10.984,0,0,1-4.744-1.388q-2.759-1.855-2.711-6.325h4.357a7.9,7.9,0,0,0,.63,2.727,3.319,3.319,0,0,0,2.468,1.4v-6.89l-1.307-.388A8.353,8.353,0,0,1,147.679,373a6.1,6.1,0,0,1-1.267-3.889,7.261,7.261,0,0,1,.492-2.727,6.365,6.365,0,0,1,3.929-3.7,11.727,11.727,0,0,1,2.5-.4v-2.145H154.9v2.178a8.024,8.024,0,0,1,4.111,1.292,6.339,6.339,0,0,1,2.811,5.6h-4.244a5.829,5.829,0,0,0-.478-2.1,2.479,2.479,0,0,0-2.2-1.258V372a20.176,20.176,0,0,1,5.141,2.34,5.712,5.712,0,0,1,2.169,4.777A6.414,6.414,0,0,1,159.224,385.025Z" transform="translate(-134.684 -355.574)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_93" data-name="Path 93" d="M152.4,369.784a2.576,2.576,0,0,0,1.016,2.146,5.748,5.748,0,0,0,1.743.806v-5.663a2.834,2.834,0,0,0-2.081.75A2.742,2.742,0,0,0,152.4,369.784Z" transform="translate(-136.51 -356.759)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
</g>
</svg>
</div>
<p class="dsn:text-center dsn:pt-2">Buyer's Guide</p> 
</div>

<div class="dsn:flex dsn:flex-col dsn:justify-center">       

<div class="footer-circle">

<svg xmlns="http://www.w3.org/2000/svg" width="68.691" height="77.108" viewBox="0 0 68.691 77.108">
<g id="Group_400" data-name="Group 400" transform="translate(0.5 0.5)">
    <g id="Group_395" data-name="Group 395" transform="translate(0.006 24.743)">
    <path id="Path_80" data-name="Path 80" d="M137.669,351.632c-7.6-.464-15.945-1.375-19.125-3.168v7.2a.676.676,0,0,1,.034.17c.224.805,4.242,1.983,11.8,2.834A27.066,27.066,0,0,1,137.669,351.632Z" transform="translate(-118.544 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_81" data-name="Path 81" d="M172.672,351.633a27.074,27.074,0,0,1,7.293,7.036c7.562-.852,11.586-2.033,11.81-2.846a.659.659,0,0,1,.033-.163v-7.194C188.626,350.258,180.279,351.169,172.672,351.633Z" transform="translate(-124.123 -348.464)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_396" data-name="Group 396" transform="translate(0.006 33.745)">
    <path id="Path_82" data-name="Path 82" d="M129.533,360.982c-4.752-.539-8.941-1.327-10.989-2.481v7.2a.681.681,0,0,1,.034.171c.18.649,2.842,1.54,7.813,2.307A26.723,26.723,0,0,1,129.533,360.982Z" transform="translate(-118.544 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_83" data-name="Path 83" d="M181.743,360.984a26.775,26.775,0,0,1,3.141,7.2c4.978-.77,7.644-1.665,7.826-2.32a.655.655,0,0,1,.033-.162v-7.2C190.693,359.656,186.5,360.444,181.743,360.984Z" transform="translate(-125.058 -358.501)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_397" data-name="Group 397" transform="translate(0.006 42.747)">
    <path id="Path_84" data-name="Path 84" d="M125.425,376.271a27.027,27.027,0,0,1,.62-5.715,24.875,24.875,0,0,1-7.5-2.019v7.2a.683.683,0,0,1,.034.171c.17.612,2.517,1.438,6.939,2.173C125.476,377.48,125.425,376.882,125.425,376.271Z" transform="translate(-118.544 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_85" data-name="Path 85" d="M185.63,370.558a27.006,27.006,0,0,1,.62,5.713c0,.611-.051,1.209-.091,1.809,4.429-.736,6.78-1.568,6.951-2.185a.661.661,0,0,1,.033-.163v-7.194A24.932,24.932,0,0,1,185.63,370.558Z" transform="translate(-125.459 -368.537)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <g id="Group_398" data-name="Group 398" transform="translate(0 51.746)">
    <path id="Path_86" data-name="Path 86" d="M125.635,380.528a23.93,23.93,0,0,1-7.1-1.958v7.486h.013c.133,1.2,3.787,2.283,9.636,3.076A26.709,26.709,0,0,1,125.635,380.528Z" transform="translate(-118.537 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_87" data-name="Path 87" d="M185.794,380.53a26.751,26.751,0,0,1-2.552,8.6c5.851-.794,9.5-1.876,9.636-3.077h.014V378.57A23.826,23.826,0,0,1,185.794,380.53Z" transform="translate(-125.207 -378.57)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
    <ellipse id="Ellipse_61" data-name="Ellipse 61" cx="33.842" cy="4.501" rx="33.842" ry="4.501" transform="translate(0.006)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_88" data-name="Path 88" d="M152.386,339.659c21.791,0,33.422-2.506,33.81-3.91a.659.659,0,0,1,.033-.163v-7.2c-6.382,3.6-33.532,3.646-33.843,3.646s-27.46-.049-33.842-3.646v7.2a.675.675,0,0,1,.034.17C118.965,337.153,130.6,339.659,152.386,339.659Z" transform="translate(-118.538 -321.652)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_89" data-name="Path 89" d="M152.386,342.074c-.31,0-27.46-.049-33.842-3.646v7.2a.683.683,0,0,1,.034.171c.3,1.091,7.544,2.861,21.14,3.579a26.918,26.918,0,0,1,25.326,0c13.6-.717,20.848-2.491,21.152-3.591a.651.651,0,0,1,.033-.162v-7.2C179.847,342.025,152.7,342.074,152.386,342.074Z" transform="translate(-118.538 -322.686)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_90" data-name="Path 90" d="M153.324,348.588a25.627,25.627,0,1,0,25.627,25.627A25.627,25.627,0,0,0,153.324,348.588Zm0,46.427a20.8,20.8,0,1,1,20.8-20.8A20.824,20.824,0,0,1,153.324,395.015Z" transform="translate(-119.481 -323.734)" fill="#fff" stroke="#333" stroke-width="1"/>
    <g id="Group_399" data-name="Group 399" transform="translate(14.483 31.12)">
    <path id="Path_91" data-name="Path 91" d="M157.223,378.839v6.309a4.04,4.04,0,0,0,1.834-.58A2.987,2.987,0,0,0,160.063,382a2.743,2.743,0,0,0-.941-2.195A6.852,6.852,0,0,0,157.223,378.839Z" transform="translate(-137.007 -357.972)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_92" data-name="Path 92" d="M154.044,355.574a19.361,19.361,0,1,0,19.36,19.361A19.382,19.382,0,0,0,154.044,355.574Zm5.18,29.451a9.459,9.459,0,0,1-4.324,1.323v3.244h-1.566v-3.212a10.984,10.984,0,0,1-4.744-1.388q-2.759-1.855-2.711-6.325h4.357a7.9,7.9,0,0,0,.63,2.727,3.319,3.319,0,0,0,2.468,1.4v-6.89l-1.307-.388A8.353,8.353,0,0,1,147.679,373a6.1,6.1,0,0,1-1.267-3.889,7.261,7.261,0,0,1,.492-2.727,6.365,6.365,0,0,1,3.929-3.7,11.727,11.727,0,0,1,2.5-.4v-2.145H154.9v2.178a8.024,8.024,0,0,1,4.111,1.292,6.339,6.339,0,0,1,2.811,5.6h-4.244a5.829,5.829,0,0,0-.478-2.1,2.479,2.479,0,0,0-2.2-1.258V372a20.176,20.176,0,0,1,5.141,2.34,5.712,5.712,0,0,1,2.169,4.777A6.414,6.414,0,0,1,159.224,385.025Z" transform="translate(-134.684 -355.574)" fill="#fff" stroke="#333" stroke-width="1"/>
    <path id="Path_93" data-name="Path 93" d="M152.4,369.784a2.576,2.576,0,0,0,1.016,2.146,5.748,5.748,0,0,0,1.743.806v-5.663a2.834,2.834,0,0,0-2.081.75A2.742,2.742,0,0,0,152.4,369.784Z" transform="translate(-136.51 -356.759)" fill="#fff" stroke="#333" stroke-width="1"/>
    </g>
</g>
</svg>
</div>
<p class="dsn:text-center dsn:pt-2">Financing</p> 
</div>
</div> 
</div>
</div>
</div>
    <div class="footer-main bgImage">
        <div class="dsn:md:px-10 dsn:py-20 dsn:container dsn:mx-auto dsn:block dsn:md:flex dsn:px-0 dsn:pb-10 dsn:relative dsn:z-10 dsn:md:justify-center dsn:md:gap-20 dsn:text-white">
            <div class="dsn:w-full dsn:md:w-1/3">
                <img src="https://valleyhotspring.designstudio.host/wp-content/uploads/2025/03/murrieta-valley-hss.jpg" alt="location image vallery hot springs">
                <h2 class="dsn:py-5 dsn:max-w-full dsn:md:max-w-3/4">Valley Hot Spring Spas & BBQ Islands of Murrieta</h2>
                <div class="dsn:flex dsn:gap-10 dsn:pt-2">
                   
                    <div>
                        <h3>Address:</h3>
                        <p>25098 Madison Ave.</p>
                        <p>Murrieta, CA 92562</p>
                        <div class="dsn:flex dsn:gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path id="phone-solid" d="M19.263.951,15.2.013a.944.944,0,0,0-1.074.543L12.251,4.931a.935.935,0,0,0,.27,1.094l2.367,1.937a14.477,14.477,0,0,1-6.922,6.922L6.029,12.517a.936.936,0,0,0-1.094-.27L.56,14.122A.949.949,0,0,0,.013,15.2l.937,4.062a.937.937,0,0,0,.914.727A18.123,18.123,0,0,0,19.99,1.865.936.936,0,0,0,19.263.951Z" transform="translate(0.01 0.011)" fill="#fff"/>
                        </svg>
                        <p class="dsn:p-0"><a href="tel:951-696-3115" class="dsn:text-blue-400">951-696-3115</a></p>
                        </div>
                        <div class="dsn:flex dsn:gap-5 dsn:pt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 15 20">
                            <path id="map-marker-alt-solid" d="M6.729,19.6C1.054,11.368,0,10.524,0,7.5a7.5,7.5,0,1,1,15,0c0,3.024-1.054,3.868-6.729,12.1a.938.938,0,0,1-1.542,0ZM7.5,10.625A3.125,3.125,0,1,0,4.375,7.5,3.125,3.125,0,0,0,7.5,10.625Z" fill="#fff"/>
                        </svg>
                        <p class="dsn:p-0"><a href="#" class="dsn:text-blue-400">Get Directions</a></p>
                        </div>
                    </div>
                    <div>
                        <h3>Hours:</h3>
                        <p>Mon-Fri: 10am - 6pm</p>
                        <p>Saturday: 10am - 4pm</p>
                        <p>Sunday: 12pm - 5pm</p>
                    </div>
                </div>
            </div>

            <div class="dsn:w-full dsn:md:w-1/3">
                <img src="https://valleyhotspring.designstudio.host/wp-content/uploads/2025/03/temecula-valley-hss.jpg" alt="location image vallery hot springs">
                <h2 class="dsn:py-5 dsn:max-w-full dsn:md:max-w-3/4">Temecula Valley Hot Spring Spas & BBQ Islands (BBQ Island Super Store)</h2>
                <div class="dsn:flex dsn:gap-10 dsn:pt-2">
                   
                    <div>
                        <h3>Address:</h3>
                        <p>25098 Madison Ave.</p>
                        <p>Murrieta, CA 92562</p>
                        <div class="dsn:flex dsn:gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path id="phone-solid" d="M19.263.951,15.2.013a.944.944,0,0,0-1.074.543L12.251,4.931a.935.935,0,0,0,.27,1.094l2.367,1.937a14.477,14.477,0,0,1-6.922,6.922L6.029,12.517a.936.936,0,0,0-1.094-.27L.56,14.122A.949.949,0,0,0,.013,15.2l.937,4.062a.937.937,0,0,0,.914.727A18.123,18.123,0,0,0,19.99,1.865.936.936,0,0,0,19.263.951Z" transform="translate(0.01 0.011)" fill="#fff"/>
                        </svg>
                        <p class="dsn:p-0"><a href="tel:951-696-3115" class="dsn:text-blue-400">951-696-3115</a></p>
                        </div>
                        <div class="dsn:flex dsn:gap-5 dsn:pt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 15 20">
                            <path id="map-marker-alt-solid" d="M6.729,19.6C1.054,11.368,0,10.524,0,7.5a7.5,7.5,0,1,1,15,0c0,3.024-1.054,3.868-6.729,12.1a.938.938,0,0,1-1.542,0ZM7.5,10.625A3.125,3.125,0,1,0,4.375,7.5,3.125,3.125,0,0,0,7.5,10.625Z" fill="#fff"/>
                        </svg>
                        <p class="dsn:p-0"><a href="#" class="dsn:text-blue-400">Get Directions</a></p>
                        </div>
                    </div>
                    <div>
                        <h3>Hours:</h3>
                        <p>Mon-Fri: 10am - 6pm</p>
                        <p>Saturday: 10am - 4pm</p>
                        <p>Sunday: 12pm - 5pm</p>
                    </div>
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
 <div id="footer-copyright" class="copyright dsn:py-10">
 <div class="dsn:flex dsn:py-2 dsn:container dsn:mx-auto dsn:gap-5 dsn:justify-center dsn:items-center dsn:flex-wrap dsn:w-full dsn:text-white">
    <a href="#">
        facebook icon
    </a>
    <a href="#">
        facebook icon
    </a>
    <a href="#">
        facebook icon
    </a>
    <a href="#">
        facebook icon
    </a>
    <a href="#">
        facebook icon
    </a>
    <a href="#">
        facebook icon
    </a>
 </div>
 <div class="dsn:flex dsn:py-2 dsn:container dsn:mx-auto dsn:gap-5 dsn:justify-center dsn:items-center dsn:flex-wrap dsn:w-full dsn:text-white">
            <a href="#">
                Privacy Policy
            </a>
            <a href="#">
                Terms and Conditions
            </a>
            <a href="#">
                Accessibility Statement
            </a>
            <a href="#">
                FAQ
            </a>
            <a href="#">
                Hot Tub Health Benefits
            </a>
        </div>
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
