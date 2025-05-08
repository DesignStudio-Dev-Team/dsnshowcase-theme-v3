<?php
if(function_exists('get_field')) {
    $footer = get_field('footer');
}
if($footer) {
    if($footer == 1) {
        get_template_part('templates/footer_1');
    }
    if($footer == 2) {
        get_template_part('templates/footer_2');
    }
    if($footer == 3) {
        get_template_part('templates/footer_3');
    }
    if($footer == 4) {
        get_template_part('templates/footer_4');
    }
    if($footer == 5) {
        get_template_part('templates/footer_5');
    }
} else {
    get_template_part('templates/footer_1');
}
?>
<?php wp_footer(); ?>
</body>
</html>