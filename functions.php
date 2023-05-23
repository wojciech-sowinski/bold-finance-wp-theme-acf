<?php

include 'templates/sliders.php';
include 'templates/buttons.php';
/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer.php';
if (is_readable($theme_customizer)) {
	require_once $theme_customizer;
}

if (!function_exists('boldfinance_setup_theme')) {
	/**
	 * General Theme Settings.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	function boldfinance_setup_theme()
	{
		// Make theme available for translation: Translations can be filed in the /languages/ directory.
		load_theme_textdomain('boldfinance', __DIR__ . '/languages');

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 *
		 * @since v1.0
		 */
		global $content_width;
		if (!isset($content_width)) {
			$content_width = 800;
		}

		// Theme Support.
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');
		// Add support for full and wide alignment.
		add_theme_support('align-wide');
		// Add support for Editor Styles.
		add_theme_support('editor-styles');
		// Enqueue Editor Styles.
		add_editor_style('style-editor.css');

		// Default attachment display settings.
		update_option('image_default_align', 'none');
		update_option('image_default_link_type', 'none');
		update_option('image_default_size', 'large');

		// Custom CSS styles of WorPress gallery.
		add_filter('use_default_gallery_style', '__return_false');
	}
	add_action('after_setup_theme', 'boldfinance_setup_theme');

	// Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
	remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
	remove_action('enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory');
}

if (!function_exists('wp_body_open')) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since v2.2
	 *
	 * @return void
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
}

if (!function_exists('boldfinance_add_user_fields')) {
	/**
	 * Add new User fields to Userprofile:
	 * get_user_meta( $user->ID, 'facebook_profile', true );
	 *
	 * @since v1.0
	 *
	 * @param array $fields User fields.
	 *
	 * @return array
	 */
	function boldfinance_add_user_fields($fields)
	{
		// Add new fields.
		$fields['facebook_profile'] = 'Facebook URL';
		$fields['twitter_profile'] = 'Twitter URL';
		$fields['linkedin_profile'] = 'LinkedIn URL';
		$fields['xing_profile'] = 'Xing URL';
		$fields['github_profile'] = 'GitHub URL';

		return $fields;
	}
	add_filter('user_contactmethods', 'boldfinance_add_user_fields');
}

/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 *
 * @return bool
 */
function is_blog()
{
	global $post;
	$posttype = get_post_type($post);

	return ((is_archive() || is_author() || is_category() || is_home() || is_single() || (is_tag() && ('post' === $posttype))) ? true : false);
}

/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 *
 * @param bool $open    Comments open/closed.
 * @param int  $post_id Post ID.
 *
 * @return bool
 */
function boldfinance_filter_media_comment_status($open, $post_id = null)
{
	$media_post = get_post($post_id);

	if ('attachment' === $media_post->post_type) {
		return false;
	}

	return $open;
}
add_filter('comments_open', 'boldfinance_filter_media_comment_status', 10, 2);

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Post Edit Link.
 *
 * @return string
 */
function boldfinance_custom_edit_post_link($link)
{
	return str_replace('class="post-edit-link"', 'class="post-edit-link badge bg-secondary"', $link);
}
add_filter('edit_post_link', 'boldfinance_custom_edit_post_link');

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Comment Edit Link.
 */
function boldfinance_custom_edit_comment_link($link)
{
	return str_replace('class="comment-edit-link"', 'class="comment-edit-link badge bg-secondary"', $link);
}
add_filter('edit_comment_link', 'boldfinance_custom_edit_comment_link');

/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 *
 * @param string $html Inner HTML.
 *
 * @return string
 */
function boldfinance_oembed_filter($html)
{
	return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'boldfinance_oembed_filter', 10);

if (!function_exists('boldfinance_content_nav')) {
	/**
	 * Display a navigation to next/previous pages when applicable.
	 *
	 * @since v1.0
	 *
	 * @param string $nav_id Navigation ID.
	 */
	function boldfinance_content_nav($nav_id)
	{
		global $wp_query;

		if ($wp_query->max_num_pages > 1) {
			?>
			<div id="<?php echo esc_attr($nav_id); ?>" class="d-flex mb-4 justify-content-between">
				<div>
					<?php next_posts_link('<span aria-hidden="true">&larr;</span> ' . esc_html__('Older posts', 'boldfinance')); ?>
				</div>
				<div>
					<?php previous_posts_link(esc_html__('Newer posts', 'boldfinance') . ' <span aria-hidden="true">&rarr;</span>'); ?>
				</div>
			</div><!-- /.d-flex -->
			<?php
		} else {
			echo '<div class="clearfix"></div>';
		}
	}

	/**
	 * Add Class.
	 *
	 * @since v1.0
	 *
	 * @return string
	 */
	function posts_link_attributes()
	{
		return 'class="btn btn-secondary btn-lg"';
	}
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes');
}

/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 *
 * @return void
 */
function boldfinance_widgets_init()
{
	// Area 1.
	register_sidebar(
		array(
			'name' => 'Primary Widget Area (Sidebar)',
			'id' => 'primary_widget_area',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	// Area 2.
	register_sidebar(
		array(
			'name' => 'Secondary Widget Area (Header Navigation)',
			'id' => 'secondary_widget_area',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	// Area 3.
	register_sidebar(
		array(
			'name' => 'Third Widget Area (Footer)',
			'id' => 'third_widget_area',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}
add_action('widgets_init', 'boldfinance_widgets_init');

if (!function_exists('boldfinance_article_posted_on')) {
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function boldfinance_article_posted_on()
	{
		printf(
			wp_kses_post(__('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author-meta vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'boldfinance')),
			esc_url(get_the_permalink()),
			esc_attr(get_the_date() . ' - ' . get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date() . ' - ' . get_the_time()),
			esc_url(get_author_posts_url((int) get_the_author_meta('ID'))),
			sprintf(esc_attr__('View all posts by %s', 'boldfinance'), get_the_author()),
			get_the_author()
		);
	}
}

/**
 * Template for Password protected post form.
 *
 * @since v1.0
 *
 * @return string
 */
function boldfinance_password_form()
{
	global $post;
	$label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

	$output = '<div class="row">';
	$output .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">';
	$output .= '<h4 class="col-md-12 alert alert-warning">' . esc_html__('This content is password protected. To view it please enter your password below.', 'boldfinance') . '</h4>';
	$output .= '<div class="col-md-6">';
	$output .= '<div class="input-group">';
	$output .= '<input type="password" name="post_password" id="' . esc_attr($label) . '" placeholder="' . esc_attr__('Password', 'boldfinance') . '" class="form-control" />';
	$output .= '<div class="input-group-append"><input type="submit" name="submit" class="btn btn-primary" value="' . esc_attr__('Submit', 'boldfinance') . '" /></div>';
	$output .= '</div><!-- /.input-group -->';
	$output .= '</div><!-- /.col -->';
	$output .= '</form>';
	$output .= '</div><!-- /.row -->';

	return $output;
}
add_filter('the_password_form', 'boldfinance_password_form');


if (!function_exists('boldfinance_comment')) {
	/**
	 * Style Reply link.
	 *
	 * @since v1.0
	 *
	 * @param string $class Link class.
	 *
	 * @return string
	 */
	function boldfinance_replace_reply_link_class($class)
	{
		return str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-outline-secondary", $class);
	}
	add_filter('comment_reply_link', 'boldfinance_replace_reply_link_class');

	/**
	 * Template for comments and pingbacks:
	 * add function to comments.php ... wp_list_comments( array( 'callback' => 'boldfinance_comment' ) );
	 *
	 * @since v1.0
	 *
	 * @param object $comment Comment object.
	 * @param array  $args    Comment args.
	 * @param int    $depth   Comment depth.
	 */
	function boldfinance_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type):
			case 'pingback':
			case 'trackback':
				?>
				<li class="post pingback">
					<p>
						<?php
						esc_html_e('Pingback:', 'boldfinance');
						comment_author_link();
						edit_comment_link(esc_html__('Edit', 'boldfinance'), '<span class="edit-link">', '</span>');
						?>
					</p>
					<?php
					break;
			default:
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<?php
								$avatar_size = ('0' !== $comment->comment_parent ? 68 : 136);
								echo get_avatar($comment, $avatar_size);

								/* Translators: 1: Comment author, 2: Date and time */
								printf(
									wp_kses_post(__('%1$s, %2$s', 'boldfinance')),
									sprintf('<span class="fn">%s</span>', get_comment_author_link()),
									sprintf(
										'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
										esc_url(get_comment_link($comment->comment_ID)),
										get_comment_time('c'),
										/* Translators: 1: Date, 2: Time */
										sprintf(esc_html__('%1$s ago', 'boldfinance'), human_time_diff((int) get_comment_time('U'), current_time('timestamp')))
									)
								);

								edit_comment_link(esc_html__('Edit', 'boldfinance'), '<span class="edit-link">', '</span>');
								?>
							</div><!-- .comment-author .vcard -->

							<?php if ('0' === $comment->comment_approved) { ?>
								<em class="comment-awaiting-moderation">
									<?php esc_html_e('Your comment is awaiting moderation.', 'boldfinance'); ?>
								</em>
								<br />
							<?php } ?>
						</footer>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>

						<div class="reply">
							<?php
							comment_reply_link(
								array_merge(
									$args,
									array(
										'reply_text' => esc_html__('Reply', 'boldfinance') . ' <span>&darr;</span>',
										'depth' => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							);
							?>
						</div><!-- /.reply -->
					</article><!-- /#comment-## -->
					<?php
					break;
		endswitch;
	}

	/**
	 * Custom Comment form.
	 *
	 * @since v1.0
	 * @since v1.1: Added 'submit_button' and 'submit_field'
	 * @since v2.0.2: Added '$consent' and 'cookies'
	 *
	 * @param array $args    Form args.
	 * @param int   $post_id Post ID.
	 *
	 * @return array
	 */
	function boldfinance_custom_commentform($args = array(), $post_id = null)
	{
		if (null === $post_id) {
			$post_id = get_the_ID();
		}

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$args = wp_parse_args($args);

		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true' required" : '');
		$consent = (empty($commenter['comment_author_email']) ? '' : ' checked="checked"');
		$fields = array(
			'author' => '<div class="form-floating mb-3">
							<input type="text" id="author" name="author" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_html__('Name', 'boldfinance') . ($req ? '*' : '') . '"' . $aria_req . ' />
							<label for="author">' . esc_html__('Name', 'boldfinance') . ($req ? '*' : '') . '</label>
						</div>',
			'email' => '<div class="form-floating mb-3">
							<input type="email" id="email" name="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_html__('Email', 'boldfinance') . ($req ? '*' : '') . '"' . $aria_req . ' />
							<label for="email">' . esc_html__('Email', 'boldfinance') . ($req ? '*' : '') . '</label>
						</div>',
			'url' => '',
			'cookies' => '<p class="form-check mb-3 comment-form-cookies-consent">
							<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="form-check-input" type="checkbox" value="yes"' . $consent . ' />
							<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'boldfinance') . '</label>
						</p>',
		);

		$defaults = array(
			'fields' => apply_filters('comment_form_default_fields', $fields),
			'comment_field' => '<div class="form-floating mb-3">
											<textarea id="comment" name="comment" class="form-control" aria-required="true" required placeholder="' . esc_attr__('Comment', 'boldfinance') . ($req ? '*' : '') . '"></textarea>
											<label for="comment">' . esc_html__('Comment', 'boldfinance') . '</label>
										</div>',
			/** This filter is documented in wp-includes/link-template.php */
			'must_log_in' => '<p class="must-log-in">' . sprintf(wp_kses_post(__('You must be <a href="%s">logged in</a> to post a comment.', 'boldfinance')), wp_login_url(esc_url(get_the_permalink(get_the_ID())))) . '</p>',
			/** This filter is documented in wp-includes/link-template.php */
			'logged_in_as' => '<p class="logged-in-as">' . sprintf(wp_kses_post(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'boldfinance')), get_edit_user_link(), $user->display_name, wp_logout_url(apply_filters('the_permalink', esc_url(get_the_permalink(get_the_ID()))))) . '</p>',
			'comment_notes_before' => '<p class="small comment-notes">' . esc_html__('Your Email address will not be published.', 'boldfinance') . '</p>',
			'comment_notes_after' => '',
			'id_form' => 'commentform',
			'id_submit' => 'submit',
			'class_submit' => 'btn btn-primary',
			'name_submit' => 'submit',
			'title_reply' => '',
			'title_reply_to' => esc_html__('Leave a Reply to %s', 'boldfinance'),
			'cancel_reply_link' => esc_html__('Cancel reply', 'boldfinance'),
			'label_submit' => esc_html__('Post Comment', 'boldfinance'),
			'submit_button' => '<input type="submit" id="%2$s" name="%1$s" class="%3$s" value="%4$s" />',
			'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
			'format' => 'html5',
		);

		return $defaults;
	}
	add_filter('comment_form_defaults', 'boldfinance_custom_commentform');
}

if (function_exists('register_nav_menus')) {
	/**
	 * Nav menus.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	register_nav_menus(
		array(
			'header-top-menu' => 'Górne menu w nagłówku',
			'main-menu' => 'Główne menu',
			'footer-menu-1' => 'Pierwsze menu w stopce',
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = __DIR__ . '/inc/wp-bootstrap-navwalker.php';
if (is_readable($custom_walker)) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp-bootstrap-navwalker-footer.php';
if (is_readable($custom_walker_footer)) {
	require_once $custom_walker_footer;
}

/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 *
 * @return void
 */
function boldfinance_scripts_loader()
{
	$theme_version = wp_get_theme()->get('Version');

	// 1. Styles.
	wp_enqueue_style('style', get_theme_file_uri('style.css'), array(), $theme_version, 'all');
	wp_enqueue_style('splideCss', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), $theme_version, 'all');
	wp_enqueue_style('main', get_theme_file_uri('assets/dist/main.css'), array(), $theme_version, 'all'); // main.scss: Compiled Framework source + custom styles.

	if (is_rtl()) {
		wp_enqueue_style('rtl', get_theme_file_uri('assets/dist/rtl.css'), array(), $theme_version, 'all');
	}

	// 2. Scripts.
	wp_enqueue_script('mainjs', get_theme_file_uri('assets/dist/main.bundle.js'), array(), $theme_version, true);
	wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), $theme_version, true);
	wp_enqueue_script('splideAutoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), $theme_version, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'boldfinance_scripts_loader');

function generate_theme_option_css()
{

	$primary = get_theme_mod('primary');
	$secondary = get_theme_mod('secondary');
	$primary_hover = get_theme_mod('primary_hover');
	$black = get_theme_mod('black');
	$white = get_theme_mod('white');

	$shadowCheck = get_theme_mod('shadow_check');
	$shadowHoverCheck = get_theme_mod('shadow_hover_check');

	?>
		<style>



.border-primary{
	border-color: <?php echo $primary ?> !important;
}




.control {
    font-family: arial;
    display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 5px;
    padding-top: 3px;
    cursor: pointer;
    font-size: 16px;
}
    .control input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
.control_indicator {
    position: absolute;
    top: 0px;
    left: 0;
    height: 15px;
    width: 15px;
    background: #ffffff;
    border: 1px solid #000000;
    border-radius: 2px;
}
.control:hover input ~ .control_indicator,
.control input:focus ~ .control_indicator {
    background: #cccccc;
}

.control input:checked ~ .control_indicator {
    background: #ffffff;
}
.control:hover input:not([disabled]):checked ~ .control_indicator,
.control input:checked:focus ~ .control_indicator {
    background: #0e6647d;
}
.control input:disabled ~ .control_indicator {
    background: #e6e6e6;
    opacity: 0.6;
    pointer-events: none;
}
.control_indicator:after {
    box-sizing: unset;
    content: '';
    position: absolute;
    display: none;
}
.control input:checked ~ .control_indicator:after {
    display: block;
}
.control-checkbox .control_indicator:after {
    left: 4px;
    top: 0px;
    width: 3px;
    height: 8px;
    border: solid #000000;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.control-checkbox input:disabled ~ .control_indicator:after {
    border-color: #7b7b7b;
}


input[type=range] {
  margin: 8px 0;
  background-color: transparent;
  -webkit-appearance: none;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  background: #e4e4e4;
  border: 0;
  width: auto;
  height: 4px;
  cursor: pointer;
}
input[type=range]::-webkit-slider-thumb {
  margin-top: -8px;
  width: 20px;
  height: 20px;
  background: #7000ff;
  border: 1px solid rgba(0, 0, 0, 0);
  border-radius: 20px;
  cursor: pointer;
  -webkit-appearance: none;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #e4e4e4;
}
input[type=range]::-moz-range-track {
  background: #e4e4e4;
  border: 0;
  width: auto;
  height: 4px;
  cursor: pointer;
}
input[type=range]::-moz-range-thumb {
  width: 20px;
  height: 20px;
  background: #7000ff;
  border: 1px solid rgba(0, 0, 0, 0);
  border-radius: 20px;
  cursor: pointer;
}
input[type=range]::-ms-track {
  background: transparent;
  border-color: transparent;
  border-width: 9px 0;
  color: transparent;
  width: auto;
  height: 4px;
  cursor: pointer;
}
input[type=range]::-ms-fill-lower {
  background: #e4e4e4;
  border: 0;
}
input[type=range]::-ms-fill-upper {
  background: #e4e4e4;
  border: 0;
}
input[type=range]::-ms-thumb {
  width: 20px;
  height: 20px;
  background: #7000ff;
  border: 1px solid rgba(0, 0, 0, 0);
  border-radius: 20px;
  cursor: pointer;
  margin-top: 0px;
  /*Needed to keep the Edge thumb centred*/
}
input[type=range]:focus::-ms-fill-lower {
  background: #e4e4e4;
}
input[type=range]:focus::-ms-fill-upper {
  background: #e4e4e4;
}
/*TODO: Use one of the selectors from https://stackoverflow.com/a/20541859/7077589 and figure out
how to remove the virtical space around the range input in IE*/
@supports (-ms-ime-align:auto) {
  /* Pre-Chromium Edge only styles, selector taken from hhttps://stackoverflow.com/a/32202953/7077589 */
  input[type=range] {
    margin: 0;
    /*Edge starts the margin from the thumb, not the track as other browsers do*/
  }
}



			.dot{
				background-color:<?php echo $primary ?>	!important;
				animation: fadeIn 1s ease 0s 1 normal forwards;
			}
			@keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}
			.bg-primary {
				background-color:<?php echo $primary ?>	!important;
			}
			.bg-secondary {
				background-color:<?php echo $secondary ?>!important;
			}

			.bg-light {
				background-color: <?php echo $white ?> !important;
			}

			.bg-dark {
				background-color:<?php echo $black ?>!important;
			}

			.text-primary {
				color:	<?php echo $primary ?>	!important;
			}

			.text-secondary {
				color:<?php echo $secondary ?>!important;
			}

			.text-light {
				color:<?php echo $white ?>!important;
			}

			.text-dark {
				color:<?php echo $black ?>!important;
			}

			.bg-primary{
				background-color: <?php echo $primary ?>!important;;
			}

			.btn {
				padding: 15px 20px 15px 20px !important;
				border-radius: 5px !important;
				border: 0px !important;
			}

			.btn-sm {
				font-size: 14px !important;
				padding: 10px 15px !important;
			}
			
			.btn-primary {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary ?> !important;
			}
			
			.btn-primary:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
			}
			
			.btn-outline {
				background-color: transparent !important;
				border: 1px solid <?php echo $black ?>	!important;
				color:<?php echo $black ?> !important;
			}

			.btn-outline:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
				border: 1px solid <?php echo $primary_hover ?>	!important;
			}
			.btn-outline-secondary {
				background-color: transparent !important;
				border: 1px solid <?php echo $secondary ?>	!important;
				color:<?php echo $secondary ?> !important;
			}

			.btn-outline-secondary:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
			}
			.btn-outline-white {
				background-color: <?php echo $white ?>	!important;
				border: 0px solid <?php echo $white ?>	!important;
				color:<?php echo $white ?> !important;
			}

			.btn-outline-white:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
			}

			.btn-secondary {
				color: <?php echo $black ?> !important;
				background-color: <?php echo $secondary ?> !important;
			}

			.btn-secondary:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
			}

			.btn-light {
				background-color: <?php echo $white ?> !important;
				color: <?php echo $black ?> !important;
			}

			.btn-light:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
			}

			.btn-dark {
				background-color: <?php echo $black ?> !important;
				color: <?php echo $white ?> !important;
			}

			.btn-dark:hover {
				color: <?php echo $white ?> !important;
				background-color: <?php echo $primary_hover ?> !important;
			}

			<?php 
			if ($shadowCheck) {?>
				.shadow{
				-webkit-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0.1) !important;
				-moz-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0.1) !important;
				box-shadow: 0px 5px 40px rgba(0, 0, 0, 0.1) !important;

			}
			<?php } else {?>
				.shadow{
					-webkit-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0) !important;
					-moz-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0) !important;
					box-shadow: 0px 5px 40px rgba(0, 0, 0, 0) !important;
	
				}
			<?php }	?>

			<?php 
			if ($shadowHoverCheck) {?>
				.shadow:hover{
				-webkit-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0.2) !important;
				-moz-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0.2) !important;
				box-shadow: 0px 5px 40px rgba(0, 0, 0, 0.2) !important;
			}
			<?php } else {?>
				.shadow:hover{
				-webkit-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0) !important;
				-moz-box-shadow: 0px 5px 40px rgba(0, 0, 0, 0) !important;
				box-shadow: 0px 5px 40px rgba(0, 0, 0, 0) !important;
			}
			<?php }	?>

			header .nav-link{
				border-bottom: 2px solid transparent;
				color: <?php echo $black ?> !important;
			}
			/* header .nav-link:hover{
				color: <?php echo $black ?> !important;
				border-bottom: 2px solid <?php echo $primary ?>;
			} */
			
			.icon-button{
				width: 36px !important;
				height:36px !important;
				background-color: <?php echo $secondary ?>;
				color: <?php echo $black ?>;
				border:0px solid transparent !important;
				border-radius:5px;
			}

			.icon-button svg path{
				fill:#000;
			}

			.icon-button:hover{
				
				background-color: <?php echo $primary ?>;
			}

			.icon-button svg path{
				fill:<?php echo $black ?>;
			}
			.icon-button:hover svg path{
				fill:<?php echo $white ?>;
			}

			footer{
				background-color: #F1F1F1 !important;
			}

			footer a{
				color:<?php echo $black ?> !important;
			}
			footer a:hover{
				color:<?php echo $black ?> !important;
			}


			.pagination .current{
				background-color: <?php echo $primary ?> !important;
				color:<?php echo $white ?> !important;
			}

			.tag-cloud-link{
				width:auto;
				background-color: <?php echo $secondary ?> !important;
				color: <?php echo $black ?> !important;
				padding:10px 15px 10px 15px;
				font-size:14px !important;
				font-weight:600;
				transition:.3s;
				border-radius:5px;
			}

			.tag-cloud-link:hover{
				background-color: <?php echo $primary ?> !important;
				color:<?php echo $white ?> !important;
			}

			.res-border{
				border-top: 0 solid <?php echo $primary ?> !important;
				border-left: 4px solid <?php echo $primary ?>  !important;
				border-bottom: 0  !important;
				border-right: 0 !important;
			}
			
			@media (max-width: 1200px) {
				.res-border{
							border-top: 0px solid <?php echo $primary ?> !important;
							border-left: 0px solid <?php echo $primary ?> !important;
							border-bottom: 0 !important;
							border-right: 0 !important;
						}
			}

		</style>
		<?php
}

add_action('wp_head', 'generate_theme_option_css');



function generateId(){
	$length = 10;
    $randomBytes = random_bytes($length);
    $randomId = '';

    for ($i = 0; $i < $length; $i++) {
        $randomId .= chr(ord('a') + (ord($randomBytes[$i]) % 26));
    }

	return $randomId;
};


function boldf_add_custom_types( $query ) {
    if( is_tag() && $query->is_main_query() ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );

        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'boldf_add_custom_types' );



function idTag($id = null) {
	if($id){
		echo 'id="'.$id.'"';
	}
};


//templates 


