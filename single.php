<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GreenZeta
 */

get_header();
// Get the post for use in the header
the_post();
?>
	<?php get_template_part( 'template-parts/banner' ); ?>
	<?php get_template_part( 'template-parts/headline' ); ?>
	
	<main id="primary" class="site-main">

		<?php
		// Reset after retrieving the post for the header
		rewind_posts();
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle"><i class="fas fa-angle-left"></i></span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-title">%title</span> <span class="nav-subtitle"><i class="fas fa-angle-right"></i></span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
