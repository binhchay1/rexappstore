<?php if ( have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( have_posts() ) : the_post();
		array_push($ids, get_the_ID());
	endwhile; // end of the loop.
	$ids = implode(',', $ids);
?>

	<?php

	echo do_shortcode('[blog_posts style="normal" type="row" columns="2" ids="'.$ids.'" columns__md="1" posts="5" readmore="Read more" readmore_color="primary" readmore_style="link" show_date="text" excerpt_length="25" show_category="text" image_height="68%" image_size="original" class="isures-global--blogpost"]');
	?>

<?php flatsome_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>
