<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

	if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
	if(get_field('super_headline')){
		set_query_var( 'headlineSuperTitle', get_field('super_headline') );
	}else{
        set_query_var( 'headlineSuperTitle', false );
    }
    set_query_var( 'headlineTitle', null );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<a <?php if(get_field('external_content')){ echo 'href="'.get_field('external_content').'" target="_blank"'; }else{ echo 'href="'.get_permalink().'"'; }?>>
	
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
