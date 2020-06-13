<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GreenZeta
 */

	

	// our callback function to check for the shortcode.
	// this is where you'd put code to set a flag for rendering the shortcode elsewhere
	// the complete tag is in $tag[0], which can be passed to do_shortcode later
	function wpd_check_shortcode( $tag ){
		//print_r($tag);
		// if( 'content_block' == $tag[2] ){
		// 	// convert string of attributes to array of key=>val pairs
		// 	$attributes = shortcode_parse_atts( $tag[3] );
		// 	if( array_key_exists( 'position', $attributes )
		// 		&& 'top' == $attributes['position'] ){
		// 			// move shortcode to sidebar here
		// 			// return empty to strip shortcode
		// 			return '';
		// 	}
		// }
		// return any non-matching shortcodes
		//return $tag[0];
		array_push($local_shortcodes, $tag[0]);
		echo "test";
		print_r($local_shortcodes);
		return '';
	}

	get_header();
	// Get the post for use in the layout header
	the_post();

	// generate a regex pattern for all registered shortcodes
	$pattern = get_shortcode_regex();

	if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
		set_query_var( 'headlineSuperTitle', 'blah' );

	$term = false;
	$projects = wp_get_post_terms( get_the_ID(), 'project' );
	if(count($projects) > 0) $term = $projects[0];
	$hashtags = wp_get_post_terms( get_the_ID(), 'post_tag' );
	$unused_hash = array();
	//print_r($project);
	//print_r($hashtags);

	if( get_field('banner','term_'.$term->term_id)) 
		set_query_var( 'bannerImage', get_field('banner','term_'.$term->term_id)['sizes']['large'] );
	else
		set_query_var( 'bannerImage', false );

	if( get_field('background_color','term_'.$term->term_id)) 
		set_query_var( 'bannerColor', get_field('background_color','term_'.$term->term_id) );
	else
		set_query_var( 'bannerColor', false );

	if( get_field('featured_image', 'term_'.$term->term_id) ) 
		set_query_var( 'headlineIcon', get_field('featured_image', 'term_'.$term->term_id)['sizes']['thumbnail'] );
	else
		set_query_var( 'headlineIcon', false );

	if( get_field('production_title', 'term_'.$term->term_id) ) 
		set_query_var( 'headlineSuperTitle', get_field('production_title', 'term_'.$term->term_id) );
	else
		set_query_var( 'headlineSuperTitle', false );

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



		<?php

			//if ( !has_shortcode($post->post_content, 'video') 
			//	&& !has_shortcode($post->post_content, 'codepen_embed') 
			//	&& has_post_thumbnail()){
			//		the_post_thumbnail('full', array( 'width' => '', 'height' => '' ));
			//}


			//the_post_navigation(
			//	array(
			//		'prev_text' => '<span class="nav-subtitle"><i class="fas fa-angle-left"></i></span> <span class="nav-title">%title</span>',
			//		'next_text' => '<span class="nav-title">%title</span> <span class="nav-subtitle"><i class="fas fa-angle-right"></i></span>',
			//	)
			//);

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
