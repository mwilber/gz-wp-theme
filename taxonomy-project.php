<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

	$project = get_term_by('slug', $term, 'project');
	$screenshots = get_field('screen_shots','term_'.$project->term_id);

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


	// Get most recent posts for this project term
	// $args = array(
	// 	'posts_per_page' => 20,
	// 	'tax_query' => array(
	// 		array(
	// 			'taxonomy' => 'project',
	// 			'field' => 'name',
	// 			'terms' => $project->name
	// 			)
	// 		)
	// 	);
	// $query = new WP_Query($args);


	get_header();
?>

	<?php get_template_part( 'template-parts/banner' ); ?>
	<?php get_template_part( 'template-parts/headline' ); ?>

	<main id="primary" class="site-main<?php if( $screenshots ) echo ' screenshots'; ?>">

	<div class="entry-content">
		<?php echo get_field('description', 'term_'.$project->term_id);?>
	</div><!-- .entry-content -->
	<?php if( $screenshots ): ?>
		<div id="screenshots" class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach( $screenshots as $image ): ?>
					<div class="swiper-slide">
						<!--<a href="<?php echo $image['url']; ?>">-->
							<span class="image-holder"><img src="<?php echo $image['sizes']['medium']; ?>" /></span>
						<!--</a>-->
					</div>
				<?php endforeach; ?>
			</div>
			<!-- If we need pagination -->
			<div class="swiper-pagination"></div>
			
			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	<?php endif; ?>
	<h2 class="section-head">Updates</h2>
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

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
