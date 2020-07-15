<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreenZeta
 */

if($term){
	$project = get_term_by('slug', $term, 'project');
	$production_link = get_field('production_link', 'term_'.$project->term_id);
	$repo_link = get_field('repo_link', 'term_'.$project->term_id);
	$post_type = 'project';
}else{
	$post_slug = get_post_field( 'post_name', get_post() );
	$post_type = get_post_field( 'post_type', get_post() );
	$tags = wp_get_object_terms( $post->ID,  'post_tag' );
}

// Get posts related to project
function addRelatedContent(
	&$relatedContent,
	$bannerImage = false,
	$headlineTitle = false,
	$headlineSuperTitle = false,
	$bannerColor = '#cccccc'
){
	array_push($relatedContent, [
		'bannerColor' => $bannerColor,
		'bannerImage' => $bannerImage,
		'headlineSuperTitle' => $headlineSuperTitle,
		'headlineTitle' => $headlineTitle
	]);
}

$relatedContent = array();
$currentPostId = get_the_ID();
$totalRelatedContent = 5;


$projects = wp_get_post_terms( $currentPostId, 'project' );
if(count($projects) > 0){
	$relatedProject = $projects[0];

	// Always add a project link if found
	array_push($relatedContent, [
		'id' => $relatedProject->term_id,
		'className' => 'related-project',
		'link' => get_term_link($relatedProject->term_id),
		'bannerColor' => get_field('background_color','term_'.$relatedProject->term_id),
		'bannerImage' => get_field('featured_image', 'term_'.$relatedProject->term_id)['sizes']['medium'],
		'headlineSuperTitle' => get_field('production_title', 'term_'.$relatedProject->term_id),
		'headlineTitle' => get_field('tag_line', 'term_'.$relatedProject->term_id)
	]);

	// Look for articles related to the project
	$relatedArticle = new WP_Query( array(
		'post_type' => 'post',
		'post__not_in' => array( $currentPostId ),
		'posts_per_page' => $totalRelatedContent,
		'tax_query' => array(
			array (
				'taxonomy' => 'project',
				'field' => 'term_id',
				'terms' => $relatedProject->term_id),
			)
		)
	);

	if(count($relatedArticle->posts) > 0){
		$articleLink = get_permalink($relatedArticle->posts[0]->ID);
		if(get_field('external_content', $relatedArticle->posts[0]->ID)) $articleLink = get_field('external_content', $relatedArticle->posts[0]->ID);
		array_push($relatedContent, [
			'id' => $relatedArticle->posts[0]->ID,
			'className' => '',
			'link' => $articleLink,
			'bannerColor' => false,
			'bannerImage' => get_field('banner', $relatedArticle->posts[0]->ID)['sizes']['large'],
			'headlineSuperTitle' => 'Article',
			'headlineTitle' => get_the_title($relatedArticle->posts[0]->ID)
		]);
	}

	// Look for updates related to the project
	$relatedUpdate = new WP_Query( array(
		'post_type' => 'update',
		'post__not_in' => array( $currentPostId ),
		'posts_per_page' => $totalRelatedContent,
		'tax_query' => array(
			array (
				'taxonomy' => 'project',
				'field' => 'term_id',
				'terms' => $relatedProject->term_id),
			)
		)
	);

	if(count($relatedUpdate->posts) > 0){
		for($idx=0; $idx<count($relatedUpdate->posts); $idx++){
			$updateId = $relatedUpdate->posts[$idx]->ID;
			array_push($relatedContent, [
				'id' => $updateId,
				'className' => '',
				'link' => get_permalink($updateId),
				'bannerColor' => false,
				'bannerImage' => get_the_post_thumbnail_url($updateId, 'medium'),
				'headlineSuperTitle' => get_the_date('', $updateId),
				'headlineTitle' => get_the_title($updateId)
			]);
			// Stop if we've reached the max related content
			if( count($relatedContent) >= $totalRelatedContent ) break;
		}
	}

} 

// If our related content isn't maxed out, fill it up with portfolio posts
if( count($relatedContent) < $totalRelatedContent ){
	$terms = get_the_terms( $currentPostId, 'post_tag' );
	$term_list = wp_list_pluck( $terms, 'slug' );
	$relatedTag = new WP_Query( array(
		'post_type' => array('portfolio'),
		'posts_per_page' => $totalRelatedContent,
		'post_status' => 'publish',
		'post__not_in' => array( $currentPostId ),
		'orderby' => 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => $term_list
			)
		)
	) );

	if(count($relatedTag->posts) > 0){
		for($idx=0; $idx<count($relatedTag->posts); $idx++){
			$contentId = $relatedTag->posts[$idx]->ID;
			array_push($relatedContent, [
				'id' => $contentId,
				'className' => '',
				'link' => get_permalink($contentId),
				'bannerColor' => false,
				'bannerImage' => get_field('banner', $contentId)['sizes']['large'] ,
				'headlineSuperTitle' => get_field('client', $contentId),
				'headlineTitle' => get_the_title($contentId)
			]);
			// Stop if we've reached the max related content
			if( count($relatedContent) >= $totalRelatedContent ) break;
		}
	}

}
?>

<aside id="secondary" class="widget-area">
	<?php if($post_type == "post"): ?>
		
	<?php elseif($post_type == "update"): ?>
		
	<?php elseif($post_type == "project"): ?>
		<?php if(isset($production_link)): ?>
		<a href="<?php echo $production_link; ?>" class="button primary live-site" target="_blank">
			<i class="fas fa-external-link"></i>
			<span>Live Site</span>
		</a>
		<?php endif; ?>
		<?php if(isset($repo_link)): ?>
		<a href="<?php echo $repo_link; ?>" class="button primary repo-site" target="_blank">
			<i class="fas fa-external-link"></i>
			<span>Source Code</span>
		</a>
		<?php endif; ?>
	<?php elseif(is_archive() && $post_type == "portfolio"): ?>
		<?php 
			$posts_ids = get_posts('post_type=portfolio&posts_per_page=-1&fields=ids');
			$tags = get_tags( array(
			'object_ids' => $posts_ids,
			'orderby' => 'count',
			'number' => 0,
			'order' => 'DESC',
			) ); ?>
			<?php if( $tags ): ?>
			<div class="tag-list">
				<?php foreach( $tags as $tag ): if($tag->count > 3): ?>
					<a href="#tag-<?php echo($tag->slug) ?>" class="button tag">
						<?php echo get_field('icon',$tag->taxonomy . '_' . $tag->term_id); ?>
						<span><?php echo $tag->name ?></span>						
					</a>
						<?php endif; endforeach; ?>
			</div>
			<?php endif; ?>

	<?php elseif(!is_archive() && $post_type == "portfolio"): ?>
		<?php if(get_field('live_site')): ?>
		<a href="<?php the_field('live_site'); ?>" class="button primary live-site" target="_blank">
			<i class="fas fa-external-link"></i>
			<span>Live Site</span>
		</a>
		<?php endif; ?>
		<?php if( $tags ): ?>
				<?php foreach( $tags as $tag ): ?>
						<a href="<?php echo get_site_url(); ?>/portfolio#tag-<?php echo $tag->slug ?>" class="button">
							<?php echo get_field('icon',$tag->taxonomy . '_' . $tag->term_id); ?>
							<span><?php echo $tag->name ?></span>
						</a>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php elseif($post_slug == "about"): ?>
		<a href="mailto:<?php the_field('email_address', 'option'); ?>" class="button primary email">
			<i class="fas fa-envelope" aria-hidden="true"></i>
			<span><?php the_field('email_address', 'option'); ?></span>
		</a>
		<?php if( have_rows('profile_pages', 'option') ): ?>
			<?php while ( have_rows('profile_pages', 'option') ) : the_row(); ?>
				<a href="<?php the_sub_field('url'); ?>" class="button profile <?php the_sub_field('icon_color'); ?>" style="background-color:<?php the_sub_field('color'); ?>">
					<?php the_sub_field('icon'); ?>
					<span><?php the_sub_field('label'); ?></span>
				</a>
			<?php endwhile; ?>
		<?php endif; ?>

	<?php endif; ?>
	<?php 
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' ); 
		}

		//print_r($relatedContent);
	?>
	<!-- Begin related content -->
	<div class="related-content">

	<?php foreach($relatedContent as $content): 
			set_query_var( 'bannerColor', $content['bannerColor'] );
			set_query_var( 'bannerImage', $content['bannerImage'] );
			set_query_var( 'headlineSuperTitle', $content['headlineSuperTitle'] );
			set_query_var( 'headlineTitle', $content['headlineTitle'] );
	?>
		<article id="post-<?php echo $content['id']; ?>" class="<?php echo $content['className']; ?>">
			<a href="<?php echo $content['link']; ?>">

				<?php get_template_part( 'template-parts/banner' ); ?>
				<?php get_template_part( 'template-parts/headline' ); ?>

			</a>
		</article>
	<?php endforeach; ?>

	</div>
	

</aside><!-- #secondary -->
