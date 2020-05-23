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

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'greenzeta' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			$greenzeta_description = get_bloginfo( 'description', 'display' );
			if ( $greenzeta_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $greenzeta_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			<div class="logo">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 11 100 100" style="enable-background:new 0 11 100 100;" xml:space="preserve">
				<style type="text/css">
					.st0{fill:#234914;}
				</style>
				<path class="st0" d="M46.6,25l0.6,1.2c-2.3,0.9-3.4,2.3-3.4,4.1c0,1.2,0.4,2.2,1.3,2.8c0.8,0.6,1.8,1,2.9,1c0.1,0,0.3,0,0.5,0
					c1.7-1.8,3.7-3.4,6-5c2.4-1.6,4.2-2.4,5.6-2.4c1.1,0,1.6,0.4,1.6,1.3c0,1.5-1.1,3-3.3,4.5c-2.2,1.5-5.2,2.5-9.1,3.1
					C43.1,42,40,49.5,40,58.2c0,3.6,0.7,6.2,2.1,8c1.4,1.8,3.9,2.7,7.5,2.7c0.4,0,1.3,0,2.7-0.1c1.6-0.1,2.7-0.1,3.3-0.1
					c2.7,0,4.7,0.9,5.9,2.6c1.2,1.8,1.8,3.9,1.8,6.4c0,3.7-0.9,6.5-2.8,8.7c-1.9,2.1-4.4,3.2-7.6,3.2c-3,0-4.5-1-4.5-3.1
					c0-1.6,0.8-2.4,2.4-2.4c0.5,0,1.3,0.2,2.6,0.6c1.1,0.3,2,0.5,2.8,0.5c1.4,0,2.6-0.6,3.4-1.7c0.8-1.1,1.3-2.4,1.3-3.8
					c0-1.6-0.5-2.7-1.4-3.4c-0.9-0.7-2.5-1.1-4.6-1.1c-0.5,0-1.7,0.1-3.5,0.2c-0.9,0-1.6,0.1-2.1,0.1c-8.3,0-12.5-5-12.5-15.1
					c0-9.3,3.4-17.5,10.1-24.7c-1.7,0-3.2-0.5-4.3-1.4c-1.1-0.9-1.7-2.1-1.7-3.7C40.9,27.8,42.8,26,46.6,25z"/>
				<path class="st0" d="M52.9,90.6c-4.5,0-5.5-2.2-5.5-4.1c0-2.2,1.2-3.4,3.4-3.4c0.6,0,1.4,0.2,2.9,0.6c1,0.3,1.8,0.5,2.5,0.5
					c1.1,0,2-0.4,2.6-1.3c0.7-1,1.1-2.1,1.1-3.2c0-1.2-0.3-2.1-1-2.6c-0.7-0.6-2.2-0.9-4-0.9c-0.3,0-0.8,0-1.5,0.1
					c-0.5,0-1.2,0.1-1.9,0.1c-0.5,0-1,0-1.3,0.1c-0.3,0-0.6,0-0.8,0c-9,0-13.5-5.4-13.5-16.1c0-8.8,3-16.9,9.1-23.9
					c-1.1-0.3-2.1-0.7-2.9-1.4c-1.4-1.1-2.1-2.6-2.1-4.5c0-3.2,2.2-5.4,6.4-6.6l0.8-0.2l1.5,2.9l-1,0.4c-1.9,0.7-2.8,1.8-2.8,3.2
					c0,0.9,0.3,1.6,0.9,2c0.5,0.4,1.3,0.8,2.3,0.8h0.1c1.5-1.6,3.4-3.1,5.9-4.8c2.7-1.8,4.6-2.6,6.2-2.6c2.3,0,2.6,1.6,2.6,2.3
					c0,1.8-1.3,3.6-3.7,5.3c-2.2,1.5-5.2,2.6-9.2,3.2C43.9,42.7,41,49.8,41,58.2c0,3.3,0.6,5.8,1.9,7.4c1.2,1.5,3.5,2.3,6.7,2.3
					c0.4,0,1.3,0,2.6-0.1c1.6-0.1,2.8-0.1,3.4-0.1c3,0,5.3,1,6.7,3c1.3,2,2,4.3,2,7c0,3.9-1,7-3,9.4C59.1,89.4,56.3,90.6,52.9,90.6z"/>
				</svg>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'greenzeta' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
			<?php if( have_rows('profile_pages', 'option') ): ?>
				<div class="menu">
					<ul class="profile-menu">
						<?php while ( have_rows('profile_pages', 'option') ) : the_row(); ?>
						<li>
							<a href="<?php the_sub_field('url'); ?>" class="button profile" style="background-color:<?php the_sub_field('color'); ?>">
								<?php the_sub_field('icon'); ?>
							</a>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif; ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
