<?php
/**
 * Template part for displaying archive post link
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

	if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
	if(get_field('client')){
		set_query_var( 'headlineSuperTitle', get_field('client') );
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<a href="<?php echo get_permalink(); ?>">

	<?php get_template_part( 'template-parts/banner' ); ?>
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
