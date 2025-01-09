<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="text-2xl font-bold"><?php the_title(); ?></h2>
    <div class="text-gray-600 mb-2">By <?php the_author(); ?> on <?php the_date(); ?></div>
    <div class="prose"><?php the_content(); ?></div>
</article>