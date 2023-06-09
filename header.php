<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<?php
$navbar_scheme = get_theme_mod('navbar_scheme', 'navbar-light bg-light'); // Get custom meta-value.
$navbar_position = get_theme_mod('navbar_position', 'static'); // Get custom meta-value.

$search_enabled = get_theme_mod('search_enabled', '1'); // Get custom meta-value.
?>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a href="#main" class="visually-hidden-focusable">
		<?php esc_html_e('Skip to main content', 'boldfinance'); ?>
	</a>

	<div id="wrapper">

	<?php if ( get_field( 'hide_footer_header' ) == 0 ){?>
		<header>
			<div class="container-flexi header-info-bar">
				<div class="container py-2">
					<div class="row d-none d-md-flex">
						<div class="col-6 px-0">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'header-top-menu',
									'container' => '',
									'menu_class' => 'list-unstyled d-flex flex-row gap-3 flex-shrink m-0 p-0',
									'add_li_class' => 'list-group-item text-capitalize'
								)
							);
							?>
						</div>
						<div class=" col-6 px-0 d-flex gap-3 justify-content-end">
							<?php
							if (!empty(get_field('header_info_tel', 'option'))) {
								?>
								<div>
									<a class="d-flex align-items-center gap-1" href="tel: <?php the_field('header_info_tel', 'option'); ?>">
											<?php $header_info_tel_icon = get_field('header_info_tel_icon', 'option'); ?>
											<?php if ($header_info_tel_icon): ?>
												<img class="text-icon" src="<?php echo esc_url($header_info_tel_icon['url']); ?>"
													alt="<?php echo esc_attr($header_info_tel_icon['alt']); ?>" />
											<?php endif; ?>
										<span>
											<?php the_field('header_info_tel', 'option'); ?>
										</span>
									</a>
								</div>

								<?php
							}
							if (!empty(get_field('header_info_email', 'option'))) {
								?>
								<div>
									<a class="d-flex align-items-center  gap-1" href="mailto: <?php the_field('header_info_email', 'option'); ?>">
											<?php $header_info_email_icon = get_field('header_info_email_icon', 'option'); ?>
											<?php if ($header_info_email_icon): ?>
												<img class="text-icon" height="100%" width="auto"
													src="<?php echo esc_url($header_info_email_icon['url']); ?>"
													alt="<?php echo esc_attr($header_info_email_icon['alt']); ?>" />
											<?php endif; ?>
										<span>
											<?php the_field('header_info_email', 'option'); ?>
										</span>
									</a>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<nav id="header" class="navbar navbar-expand-md <?php echo esc_attr($navbar_scheme);
			if (isset($navbar_position) && 'fixed_top' === $navbar_position): echo ' fixed-top';
			elseif (isset($navbar_position) && 'fixed_bottom' === $navbar_position):
				echo ' fixed-bottom';
			endif;
			if (is_home() || is_front_page()):
				echo ' home';
			endif; ?>">
				<div class="container px-0 d-flex flex-column px-2">
					<div class="row w-100 d-flex justify-content-between py-3">
						<a class="navbar-brand w-auto" href="<?php echo esc_url(home_url()); ?>"
							title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
							<?php
							$header_logo = get_theme_mod('header_logo'); // Get custom meta-value.
							
							if (!empty($header_logo)):
								?>
								<img src="<?php echo esc_url($header_logo); ?>"
									alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" />
								<?php
							else:
								echo esc_attr(get_bloginfo('name', 'display'));
							endif;
							?>
						</a>
						<div class="w-auto p-0 d-flex align-items-center d-none d-md-block">
							<a class="btn btn-primary w-auto ">
								Wypełnij formularz
							</a>
						</div>
						<button class="navbar-toggler w-auto" type="button" data-bs-toggle="collapse"
							data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
							aria-label="<?php esc_attr_e('Toggle navigation', 'boldfinance'); ?>">
							<span class="navbar-toggler-icon"></span>
						</button>
					</div>
					<div class="row w-100">
						<div id="navbar" class="collapse navbar-collapse px-0">
							<?php
							// Loading WordPress Custom Menu (theme_location).
							wp_nav_menu(
								array(
									'menu_class' => 'navbar-nav me-auto gap-2 px-4 py-4  py-md-0 px-md-0 gap-md-5 ',
									'container' => '',
									'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
									'walker' => new WP_Bootstrap_Navwalker(),
									'theme_location' => 'main-menu',
									'add_link_class' => 'px-0'
								)
							);

							if ('1' === $search_enabled):
								?>
								<form class="search-form my-2 my-lg-0" role="search" method="get"
									action="<?php echo esc_url(home_url('/')); ?>">
									<div class="input-group">
										<input type="text" name="s" class="form-control"
											placeholder="<?php esc_attr_e('Search', 'boldfinance'); ?>"
											title="<?php esc_attr_e('Search', 'boldfinance'); ?>" />
										<button type="submit" name="submit" class="btn btn-outline-secondary">
											<?php esc_html_e('Search', 'boldfinance'); ?>
										</button>
									</div>
								</form>
								<?php
							endif;
							?>
						</div><!-- /.navbar-collapse -->
					</div>
				</div><!-- /.container -->
			</nav><!-- /#header -->
		</header>

		<?php 
		}
		
		?>


		<main id="main" class="container-fluid m-0 p-0" <?php if (isset($navbar_position) && 'fixed_top' === $navbar_position): echo ' style="padding-top: 100px;"'; elseif (isset($navbar_position) && 'fixed_bottom' === $navbar_position):
			echo ' style="padding-bottom: 100px;"';
		endif; ?>>
			