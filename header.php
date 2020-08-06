<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreenZeta
 */

$pageMeta = new stdClass();
$pageMeta->fb = new stdClass();
$pageMeta->tw = new stdClass();

$pageMeta->domain = "greenzeta.com";
$pageMeta->url = home_url( $wp->request );
$pageMeta->description = "Software by Matthew Wilber. Over 15 years of cutting edge web development. JavaScript, CSS, PHP, ASP.net";
$pageMeta->blogDesc = get_bloginfo('description');
$pageMeta->name = get_bloginfo('name');
$pageMeta->title = wp_title('-', false, 'right') . get_bloginfo('name');
$pageMeta->author = "Matthew Wilber";
$pageMeta->excerpt = get_the_excerpt();
$pageMeta->image = get_site_url(null, '/og_share.png');
$pageMeta->themeColor = "#7bb951";

$pageMeta->fb->appid = "309846011404";

$pageMeta->tw->creator = "@greenzeta";


// Use the page excerpt if it's a post page
if(is_single()) {
	$pageMeta->description = $pageMeta->excerpt;
	$pageMeta->image = get_the_post_thumbnail_url(get_the_ID(), 'large');
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<!-- Name of web application (only should be used if the website is used as an app) -->
	<meta name="application-name" content="<?php echo $pageMeta->name ?>">

	<!-- Theme Color for Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#<?php echo $pageMeta->themeColor ?>">

	<!-- Short description of the document (limit to 150 characters) -->
	<!-- This content *may* be used as a part of search engine results. -->
	<meta name="description" content="<?php echo $pageMeta->description ?>">
	<meta name="author" content="<?php echo $pageMeta->author ?>">

	<!-- Control the behavior of search engine crawling and indexing -->
	<meta name="robots" content="index,follow"><!-- All Search Engines -->
	<meta name="googlebot" content="index,follow"><!-- Google Specific -->

	<!-- facebook -->
	<meta property="fb:app_id" content="<?php echo $pageMeta->fb->appid ?>">
	<meta property="og:url" content="<?php echo $pageMeta->url ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $pageMeta->title ?>">
	<meta property="og:image" content="<?php echo $pageMeta->image ?>">
	<meta property="og:description" content="<?php echo $pageMeta->description ?>">
	<meta property="og:site_name" content="<?php echo $pageMeta->name ?>">
	<meta property="og:locale" content="en_US">
	<meta property="article:author" content="<?php echo $pageMeta->author ?>">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="<?php echo $pageMeta->tw->creator ?>">
	<meta name="twitter:creator" content="<?php echo $pageMeta->tw->creator ?>">
	<meta name="twitter:url" content="<?php echo $pageMeta->url ?>">
	<meta name="twitter:title" content="<?php echo $pageMeta->title ?>">
	<meta name="twitter:description" content="<?php echo $pageMeta->description ?>">
	<meta name="twitter:image" content="<?php echo $pageMeta->image ?>">
	<meta name="twitter:domain" content="<?php echo $pageMeta->domain ?>">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76054-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-76054-2');
	</script>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="background">
	<div class="panel left"></div>
	<div class="panel right"></div>
	<div class="saucer-container">
		<img class="saucer right" src="<?php echo get_template_directory_uri() ?>/images/saucer_right.png">
		<img class="saucer left" src="<?php echo get_template_directory_uri() ?>/images/saucer_left.png">
	</div>
	<img class="city right" src="<?php echo get_template_directory_uri() ?>/images/city_right.png">
	<img class="city left" src="<?php echo get_template_directory_uri() ?>/images/city_left.png">
	<div class="zeta-container-outer">
		<div class="floor"></div>
		<!-- <div class="zeta folded">Arms Folded</div>
		<div class="zeta pointer">Pointer</div>
		<div class="zeta carry">Carry</div>
		<div class="zeta pennant">Pennant</div>
		<div class="zeta running">Running</div>
		<div class="zeta laptop">laptop</div> -->
		<img class="zeta artist" src="<?php echo get_template_directory_uri() ?>/images/zeta_artist.png">
		<img class="zeta laptop" src="<?php echo get_template_directory_uri() ?>/images/zeta_laptop.png">
	</div>
	<div class="zeta-container-inner">
		<img class="zeta pointer" src="<?php echo get_template_directory_uri() ?>/images/zeta_pointer.png">
		<img class="zeta carry" src="<?php echo get_template_directory_uri() ?>/images/zeta_handful.png">
		<img class="zeta folded" src="<?php echo get_template_directory_uri() ?>/images/zeta_armsfolded.png">
		<img class="zeta pennant" src="<?php echo get_template_directory_uri() ?>/images/zeta_pennant.png">
		<img class="zeta VR" src="<?php echo get_template_directory_uri() ?>/images/zeta_VR.png">
	</div>
	
</div>
<header id="masthead" class="site-header">
	<div class="site-branding">
		<?php
		$greenzeta_description = get_bloginfo( 'description', 'display' );
		if ( $greenzeta_description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php echo $greenzeta_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<svg version="1.1" id="gz-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 11 100 100" style="enable-background:new 0 11 100 100;" xml:space="preserve">
			<path fill="#234914" d="M52.9,90.6c-4.5,0-5.5-2.2-5.5-4.1c0-2.2,1.2-3.4,3.4-3.4c0.6,0,1.4,0.2,2.9,0.6c1,0.3,1.8,0.5,2.5,0.5
				c1.1,0,2-0.4,2.6-1.3c0.7-1,1.1-2.1,1.1-3.2c0-1.2-0.3-2.1-1-2.6c-0.7-0.6-2.2-0.9-4-0.9c-0.3,0-0.8,0-1.5,0.1
				c-0.5,0-1.2,0.1-1.9,0.1c-0.5,0-1,0-1.3,0.1c-0.3,0-0.6,0-0.8,0c-9,0-13.5-5.4-13.5-16.1c0-8.8,3-16.9,9.1-23.9
				c-1.1-0.3-2.1-0.7-2.9-1.4c-1.4-1.1-2.1-2.6-2.1-4.5c0-3.2,2.2-5.4,6.4-6.6l0.8-0.2l1.5,2.9l-1,0.4c-1.9,0.7-2.8,1.8-2.8,3.2
				c0,0.9,0.3,1.6,0.9,2c0.5,0.4,1.3,0.8,2.3,0.8h0.1c1.5-1.6,3.4-3.1,5.9-4.8c2.7-1.8,4.6-2.6,6.2-2.6c2.3,0,2.6,1.6,2.6,2.3
				c0,1.8-1.3,3.6-3.7,5.3c-2.2,1.5-5.2,2.6-9.2,3.2C43.9,42.7,41,49.8,41,58.2c0,3.3,0.6,5.8,1.9,7.4c1.2,1.5,3.5,2.3,6.7,2.3
				c0.4,0,1.3,0,2.6-0.1c1.6-0.1,2.8-0.1,3.4-0.1c3,0,5.3,1,6.7,3c1.3,2,2,4.3,2,7c0,3.9-1,7-3,9.4C59.1,89.4,56.3,90.6,52.9,90.6z"/>
			</svg>
		</a>
	</div><!-- .site-branding -->

	<nav id="site-navigation" class="main-navigation">
		<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'greenzeta' ); ?></button> -->
		<button class="hamburger menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<div class="menu-group-container">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
			<?php if( have_rows('profile_pages', 'option') ): ?>
				<div class="menu-main-profile-container">
					<ul class="menu profile-menu">
						<?php while ( have_rows('profile_pages', 'option') ) : the_row(); ?>
						<li>
							<a href="<?php the_sub_field('url'); ?>" target="_blank" class="button profile <?php the_sub_field('icon_color'); ?>" style="background-color:<?php the_sub_field('color'); ?>">
								&nbsp;<?php the_sub_field('icon'); ?>
							</a>
						</li>
						<?php endwhile; ?>
						<?php while ( have_rows('dev_profile_pages', 'option') ) : the_row(); ?>
						<li>
							<a href="<?php the_sub_field('url'); ?>" target="_blank" class="button profile <?php the_sub_field('icon_color'); ?>" style="background-color:<?php the_sub_field('color'); ?>">
								&nbsp;<?php the_sub_field('icon'); ?>
							</a>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</nav><!-- #site-navigation -->
</header><!-- #masthead -->
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'greenzeta' ); ?></a>

