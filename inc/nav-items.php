<?php 

/* add_filter('nav_menu_css_class' , 'dsn_nav_class' , 10 , 2);

function dsn_nav_class($classes, $item){
    $classes[] = 'dsn-w-full dsn-flex dsn-items-center dsn-text-center hover:dsn-bg-white hover:dsn-text-[#076594]';
    return $classes;
} */

add_filter( 'nav_menu_css_class', 'dsn_add_class_nav_primary', 10, 3 );
function dsn_add_class_nav_primary( $atts, $item, $args ) {
    if ( (int) $item->menu_item_parent === 0 ) {
        $class         = 'dsn-w-full mega-menu dsn-text-center dsn-text-white hover:dsn-bg-white hover:dsn-text-[#076594] dsn-relative';
        $atts['class'] = $class;
    } else {
		$class         = 'dsn-block dsn-text-left dsn-w-full dsn-relative';
        $atts['class'] = $class;
	}

    return $atts;
}

function add_menu_link_class( $atts, $item, $args ) {
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 ); 


function dsn_submenu_css_class( $classes ) {
	
    $classes[] = 'dsn-hidden dsn-absolute dsn-left-auto dsn-right-auto dsn-top-0 dsn-bg-white dsn-px-6 dsn-py-8 dsn-flex dsn-items-center dsn-gap-6';
    return $classes;
	 
}
add_filter( 'nav_menu_submenu_css_class', 'dsn_submenu_css_class' );

?>