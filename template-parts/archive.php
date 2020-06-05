<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<a href="<?php echo get_permalink(); ?>">
	<?php if( get_field('banner')): ?>
        <div class="banner" style="background-image: url('<?php echo get_field('banner')['sizes']['large']; ?>');"></div>
    <?php else: ?>
        <div class="banner"></div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/headline' ); ?>

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php greenzeta_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</a>
</article><!-- #post-<?php the_ID(); ?> -->
