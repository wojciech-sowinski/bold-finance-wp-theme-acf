
</main><!-- /#main -->
<footer id="footer">
	<div class="container py-5">
		<div class="row d-flex justify-content-between">
			<div class="col-12 col-md-6 col-lg-2">
				<?php $footer_logo_column_1 = get_field('footer_logo_column_1', 'option'); ?>
				<div class="mb-2">
					<?php if ($footer_logo_column_1): ?>
						<a href="<?php get_site_url() ?>">
							<img class="img-fluid pb-3" src="<?php echo esc_url($footer_logo_column_1['url']); ?>"
								alt="<?php echo esc_attr($footer_logo_column_1['alt']); ?>"
								title="<?php echo esc_attr($footer_logo_column_1['alt']); ?>" />
						</a>
					</div>
				<?php endif; ?>
				<?php if (have_rows('footer_link_column_1', 'option')): ?>
					<?php while (have_rows('footer_link_column_1', 'option')):
						the_row(); ?>
						<div class="mb-2">
							<a title="<?php the_sub_field('footer_link_text_column_1'); ?>"
								href="<?php the_sub_field('footer_link_url_column_1'); ?>"><?php the_sub_field('footer_link_text_column_1'); ?></a>
						</div>
					<?php endwhile; ?>
				
				<?php endif; ?>



			</div>
			<div class="col-12 col-md-6 col-lg-2">
				<div class="mb-2">
					<h2>
						<?php the_field('footer_title_column_2', 'option'); ?>
					</h2>
				</div>
				<?php if (have_rows('footer_link_column_2', 'option')): ?>
					<?php while (have_rows('footer_link_column_2', 'option')):
						the_row(); ?>
						<div class="mb-2">
							<a title="<?php the_sub_field('footer_link_text_column_2'); ?>"
								href="<?php the_sub_field('footer_link_url_column_2'); ?>">
								<?php the_sub_field('footer_link_text_column_2'); ?>
							</a>
						</div>
					<?php endwhile; ?>
				<?php else: ?>
					<?php // Nie znaleziono wierszy ?>
				<?php endif; ?>
			</div>
			<div class="col-12 col-md-6 col-lg-2">
				<div >
					<h2>
						<?php the_field('footer_title_column_3', 'option'); ?>
					</h2>
				</div>
				<?php if (have_rows('footer_link_column_3', 'option')): ?>
					<?php while (have_rows('footer_link_column_3', 'option')):
						the_row(); ?>
						<div class="mb-2">
							<a title="<?php the_sub_field('footer_link_text_column_3'); ?>"
								href="<?php the_sub_field('footer_link_url_column_3'); ?>">
								<?php the_sub_field('footer_link_text_column_3'); ?>

							</a>
						</div>
					<?php endwhile; ?>
				
				<?php endif; ?>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
				<div>
					<h2>
						<?php the_field('footer_title_column_4', 'option'); ?>
					</h2>
				</div>
				<div class="mb-2">
					<a href="tel:<?php the_field('footer_phone_column_4', 'option'); ?>">
						<?php $footer_phone_icon_column_4 = get_field('footer_phone_icon_column_4', 'option'); ?>
						<?php if ($footer_phone_icon_column_4): ?>
							<img class="text-icon" src="<?php echo esc_url($footer_phone_icon_column_4['url']); ?>"
								alt="<?php echo esc_attr($footer_phone_icon_column_4['alt']); ?>" />
						<?php endif; ?>
						<?php the_field('footer_phone_column_4', 'option'); ?>
					</a>
				</div>
				<div class="mb-2">
					<a href="mailto:<?php the_field('footer_email_column_4', 'option'); ?>">
						<?php $footer_email_icon_column_4 = get_field('footer_email_icon_column_4', 'option'); ?>
						<?php if ($footer_email_icon_column_4): ?>
							<img class="text-icon" src="<?php echo esc_url($footer_email_icon_column_4['url']); ?>"
								alt="<?php echo esc_attr($footer_email_icon_column_4['alt']); ?>" />
						<?php endif; ?>
						<?php the_field('footer_email_column_4', 'option'); ?></a>
				</div>
				<?php if (have_rows('footer_social_link_column_4', 'option')): ?>
					<?php while (have_rows('footer_social_link_column_4', 'option')):
						the_row(); ?>
						<div class="mb-2">
							<a title="<?php the_sub_field('footer_social_link_title_column_4'); ?>"
								href="<?php the_sub_field('footer_social_link_url_column_4'); ?>">
								<?php $footer_social_link_icon_column_4 = get_sub_field('footer_social_link_icon_column_4'); ?>
								<?php if ($footer_social_link_icon_column_4): ?>
									<img  class="text-icon" src="<?php echo esc_url($footer_social_link_icon_column_4['url']); ?>"
										alt="<?php echo esc_attr($footer_social_link_icon_column_4['alt']); ?>" />
								<?php endif; ?>
								<?php the_sub_field('footer_social_link_title_column_4'); ?>
							</a>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>



</footer><!-- /#footer -->
</div><!-- /#wrapper -->
<?php
wp_footer();
?>
</body>

</html>