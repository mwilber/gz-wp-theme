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

set_query_var( 'bannerImage', false );
set_query_var( 'headlineSuperTitle', preg_replace('/<p>(.*?)<\/p>/i', '$1', get_the_title()) );
set_query_var( 'headlineTitle', 'Web Experiments and Original Works' );
set_query_var( 'headlineIcon', 'hidden' );

$projects = get_terms( array( 'taxonomy' => 'project', 'post_types' => 'update', 'orderby' => 'post_date', 'order' => 'DESC' ) );
// $projects = get_terms( array(
//     'taxonomy' => 'project',
//     'hide_empty' => true,
// ) );
global $wpdb;
wp_reset_query();
?>
	<header class="page-header">
        <?php get_template_part( 'template-parts/banner' ); ?>
        <?php get_template_part( 'template-parts/headline' ); ?>
	</header><!-- .page-header -->
	
	<main id="primary" class="site-main">

		<?php for( $idx=0; $idx<count($projects); $idx++ ):

			$project = $projects[$idx]; 

			if( get_field('banner','term_'.$project->term_id)) 
				set_query_var( 'bannerImage', get_field('banner','term_'.$project->term_id)['sizes']['large'] );
			else
				set_query_var( 'bannerImage', false );

			if( get_field('background_color','term_'.$project->term_id)) 
				set_query_var( 'bannerColor', get_field('background_color','term_'.$project->term_id) );
			else
				set_query_var( 'bannerColor', false );

			if( get_field('featured_image', 'term_'.$project->term_id) ) 
				set_query_var( 'headlineIcon', get_field('featured_image', 'term_'.$project->term_id)['sizes']['thumbnail'] );
			else
				set_query_var( 'headlineIcon', false );

			if( get_field('production_title', 'term_'.$project->term_id) ) 
				set_query_var( 'headlineSuperTitle', get_field('production_title', 'term_'.$project->term_id) );
			else
				set_query_var( 'headlineSuperTitle', false );

			if( get_field('tag_line', 'term_'.$project->term_id) ) 
				set_query_var( 'headlineTitle', get_field('tag_line', 'term_'.$project->term_id) );
			else
				set_query_var( 'headlineTitle', false );



			
		?>


			<article id="post-<?php echo $project->term_id; ?>">
			<a href="<?php echo get_term_link($project->term_id); ?>">
				
				<?php get_template_part( 'template-parts/banner' ); ?>
				<?php get_template_part( 'template-parts/headline' ); ?>

					<div class="entry-content">
					<p><?php echo get_field('description', 'term_'.$project->term_id);?></p>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php greenzeta_entry_footer(); ?>
					</footer><!-- .entry-footer -->
			</a>
			</article><!-- #post-<?php the_ID(); ?> -->

		<?php endfor; ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
