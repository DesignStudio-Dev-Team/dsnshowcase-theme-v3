<?php 

add_filter('nav_menu_css_class' , 'dsn_nav_class' , 10 , 2);

function dsn_nav_class($classes, $item){
    $classes[] = 'dsn-w-full dsn-flex dsn-items-center dsn-text-center hover:dsn-bg-white hover:dsn-text-[#076594]';
    return $classes;
}

function add_menu_link_class( $atts, $item, $args ) {
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 ); 


function dsn_submenu_css_class( $classes ) {
    $classes[] = 'dsn-hidden dsn-absolute dsn-left-auto dsn-right-auto dsn-top-0 dsn-bg-white dsn-px-4 dsn-py-8';
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'dsn_submenu_css_class' );

?>