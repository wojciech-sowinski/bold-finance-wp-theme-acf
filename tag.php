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

		$args = array(
			'public' => true,
			'_builtin' => false
		);

		$postTypes = get_post_types($args);

		foreach ($postTypes as $postType) {

			$postFullName = get_post_type_object($postType)->labels->singular_name;

			$paged = $_GET["tagpage"] ? $_GET["tagpage"] : 1;
			$postQuery = new WP_Query([
				'post_type' => $postType,
				'tag' => single_tag_title('', false),
				'paged' => $paged,
				'order' => 'DESC',
				'post_per_page' => 3
			]);

			if ($postQuery->have_posts()) { ?>
				<section class="container py-4 news-tag-blocks">
					<div class="row py-3 fw-semibold">
						<h2 class="m-0 fw-semibold">
							<?php echo $postFullName; ?>
						</h2>
					</div>
					<div class="row py-3">
						<?php
						while ($postQuery->have_posts()) {
							$postQuery->the_post(); ?>
							<div class="col-12 col-md-4">
								<div class="content shadow h-100">
									<div class="card-img-container">
										<?php the_post_thumbnail('medium_large', array('class' => 'img-cover')); ?>
									</div>
									<div class="p-3 d-flex flex-column justify-content-between news-paginate-block-content">
										<div>
											<h3 class="fw-bold py-2">
												<?php the_title(); ?>
											</h3>
											<p class="py-2">
												<?php
												?>
												<?php echo wp_trim_words(get_the_excerpt(), 10, '') ?>
											</p>
										</div>
										<div class="py-2">
											<a class="btn btn-primary btn-sm" title="Read more" href="<?php the_permalink(); ?>">Czytaj
												dalej</a>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</section>
				<?php
			}
		}
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