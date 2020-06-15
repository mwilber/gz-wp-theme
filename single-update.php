<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GreenZeta
 */

	// Get the post for use in the layout header
	the_post();

	// generate a regex pattern for all registered shortcodes
	$pattern = get_shortcode_regex();
	$project = false;
	$projects = wp_get_post_terms( get_the_ID(), 'project' );
	if(count($projects) > 0) $project = $projects[0];
	$hashtags = wp_get_post_terms( get_the_ID(), 'post_tag' );
	$unused_hash = array();

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

	get_header();
?>
	<?php get_template_part( 'template-parts/banner' ); ?>
	<?php get_template_part( 'template-parts/headline' ); ?>
	
	<main id="primary" class="site-main">

		<?php
		// Reset after retrieving the post for the header
		rewind_posts();
		while ( have_posts() ) : 
			the_post();
			$local_shortcodes = array();
			$post_content = get_the_content();
			$post_text = preg_replace_callback( 
				"/$pattern/s", 
				function ($match) use (&$local_shortcodes) {
					array_push($local_shortcodes, $match[0]);
					return '';
				}, $post_content );
			// Convert the in-content hashtags to links
			foreach( $hashtags as $hashtag ){
				if (stripos($post_content, '#'.$hashtag->name) !== false) {
					$post_content = str_ireplace('#'.$hashtag->name, '<a href="'.get_term_link($hashtag->term_id).'">#'.$hashtag->name.'</a>', $post_content);
				}else{
					array_push($unused_hash, $hashtag);
				}
			} ?>
			
			<div class="entry-content">

				<p><?php greenzeta_posted_on(); ?></p>
				<p>
					<?php echo $post_text; //do_shortcode($post_content); ?>

					<span class="hashtags">
						<?php foreach( $unused_hash as $hashtag ): ?>
							<a href="<?php echo get_term_link($hashtag->term_id); ?>">#<?php echo $hashtag->name; ?></a>&nbsp;	
						<?php endforeach; ?>
					</span>
				</p>

				<?php if ( !has_shortcode($post->post_content, 'video') && !has_shortcode($post->post_content, 'codepen_embed') && has_post_thumbnail()) : ?>
					<img src="<?php echo the_post_thumbnail_url('full'); ?>" class="post-thumbnail"/>
				<?php else: ?>
					<?php echo do_shortcode(implode(" ", $local_shortcodes)); ?>
				<?php endif; ?>

			</div>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
