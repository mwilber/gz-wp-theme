<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

get_header();

set_query_var( 'bannerImage', false );
set_query_var( 'headlineSuperTitle', 'Portfolio' );
set_query_var( 'headlineTitle', preg_replace('/<p>(.*?)<\/p>/i', '$1', get_the_archive_description()) );
set_query_var( 'headlineIcon', 'hidden' );
?>

    <header class="page-header">
        <?php get_template_part( 'template-parts/banner' ); ?>
        <?php get_template_part( 'template-parts/headline' ); ?>
    </header><!-- .page-header -->

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/archive', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
