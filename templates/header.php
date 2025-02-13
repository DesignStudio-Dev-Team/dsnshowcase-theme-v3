<!DOCTYPE html>
<html id="dsnHTML" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<?php 
    $header = get_field('header');

    if($header) {
        if($header == 1) {
            get_template_part('templates/header_1');
        }
        if($header == 2) {
            get_template_part('templates/header_2');
        }
        if($header == 3) {
            get_template_part('templates/header_3');
        }
        if($header == 4) {
            get_template_part('templates/header_4');
        }
        if($header == 5) {
            get_template_part('templates/header_5');
        }
    } else {
        get_template_part('templates/header_1');
    }
   
    
    ?>
