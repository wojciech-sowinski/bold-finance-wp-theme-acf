<?php
/**
 * Template Name: Not found
 * Description: Page template 404 Not found.
 *
 */

get_header();

$search_enabled = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>
<style>

.content.error404::before{
	content:'404';
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	font-size: 600px;
	text-align: center;
	z-index: -1;
	color:<?= get_theme_mod('primary_btn_color'); ?>18;
	font-weight:700;

}

@media (max-width:792px){
	.content.error404::before{
		font-size: 200px;
	}
}

.content.error404{
	overflow: hidden;
}


</style>
<div id="post-0" class="content error404 not-found d-flex flex-column justify-content-center align-content-center gap-3 position-relative" style="min-height:50vh;">

	<div class="text-center">
	<h1 class="entry-title fw-bold my-3"><?php esc_html_e( 'Not found', 'boldfinance' ); ?></h1>
	<div class="entry-content my-3" style="min-heigt:100vh;">
		<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'boldfinance' ); ?></p>
		<div>
			<?php
				if ( '1' === $search_enabled ) :
					get_search_form();
				endif;
			?>
		</div>
	</div><!-- /.entry-content -->
	<div class=" my-3">
		<a href="<?= esc_url(site_url()); ?>" class="btn btn-primary">
			<?= __('Return to home page','boldfinance') ?>
		</a>
	</div>
	</div>

</div><!-- /#post-0 -->
<?php
get_footer();
