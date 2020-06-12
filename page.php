<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

	get_header();

	if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
	if(get_field('super_headline')){
		set_query_var( 'headlineSuperTitle', get_field('super_headline') );
	}
	if(get_field('headline')){
		set_query_var( 'headlineTitle', get_field('headline') );
	}
?>

	<?php get_template_part( 'template-parts/banner' ); ?>
	<?php get_template_part( 'template-parts/headline' ); ?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
