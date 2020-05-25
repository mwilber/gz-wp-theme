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
			<span>Live Site</span>
		</a>
		<?php endif; ?>
	<?php elseif($post_slug == "about"): ?>
		<a href="mailto:<?php the_field('email_address', 'option'); ?>" class="button primary email">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <span><?php the_field('email_address', 'option'); ?></span>
		</a>
		<?php if( have_rows('profile_pages', 'option') ): ?>
			<?php while ( have_rows('profile_pages', 'option') ) : the_row(); ?>
				<a href="<?php the_sub_field('url'); ?>" class="button profile <?php the_sub_field('icon_color'); ?>" style="background-color:<?php the_sub_field('color'); ?>">
					<?php the_sub_field('icon'); ?>
					<span><?php the_sub_field('label'); ?></span>
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
