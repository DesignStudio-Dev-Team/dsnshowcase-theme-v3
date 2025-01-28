<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="dsn:text-2xl dsn:font-bold"><?php the_title(); ?></h2>
    <div class="dsn:text-gray-600 dsn:mb-2">By <?php the_author(); ?> on <?php the_date(); ?></div>
    <div class="dsn-prose"><?php the_content(); ?></div>
</article>