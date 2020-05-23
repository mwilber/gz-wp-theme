<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreenZeta
 */

$post_slug = get_post_field( 'post_name', get_post() );
$post_type = get_post_field( 'post_type', get_post() );
?>

<aside id="secondary" class="widget-area">
	<?php if($post_type == "update"): ?>
		<h3 style="color:red;">Update Sidebar</h3>
	<?php elseif($post_type == "project"): ?>
		<h3 style="color:red;">Project Sidebar</h3>
	<?php elseif(!is_archive() && $post_type == "portfolio"): ?>
		<?php if(get_field('live_site')): ?>
		<a href="<?php the_field('live_site'); ?>" class="button primary live-site">
			Live Site
		</a>
		<?php endif; ?>
	<?php elseif($post_slug == "about"): ?>
		<a href="mailto:<?php the_field('email_address', 'option'); ?>" class="button primary email">
			<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg>
			<?php the_field('email_address', 'option'); ?>
		</a>
		<?php if( have_rows('profile_pages', 'option') ): ?>
			<?php while ( have_rows('profile_pages', 'option') ) : the_row(); ?>
				<a href="<?php the_sub_field('url'); ?>" class="button profile" style="background-color:<?php the_sub_field('color'); ?>">
					<?php the_sub_field('icon'); ?>
					<?php the_sub_field('label'); ?>
				</a>
			<?php endwhile; ?>
		<?php endif; ?>

	<?php endif; ?>
	<?php 
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' ); 
		}
	?>
</aside><!-- #secondary -->
