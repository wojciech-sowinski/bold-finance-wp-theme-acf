<?php
/**
 * The Template used to display Tag Archive pages.
 */

get_header();

if (have_posts()):
	?>
	<header class="page-header  bg-primary p-5 text-white">
		<h1 class="page-title">
			<?php printf(esc_html__('Wyniki dla tagu: %s', 'boldfinance'), single_tag_title('', false)); ?>
		</h1>
		<?php
		$tag_description = tag_description();
		if (!empty($tag_description)):
			echo apply_filters('tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>');
		endif;
		?>
	</header>
	<main>
		<?php
			while (have_posts()):
				the_post();

// var_dump(have_posts(  ));

				the_title();

			endwhile;
			?>
	</main>
	<?php
	// get_template_part( 'archive', 'loop' );
else:
	// 404.
	get_template_part('content', 'none');
endif;

wp_reset_postdata(); // End of the loop.

get_footer();