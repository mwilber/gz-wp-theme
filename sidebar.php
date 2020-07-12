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

    $projects = wp_get_post_terms( get_the_ID(), 'project' );
	if(count($projects) > 0){
        $relatedProject = $projects[0];
        $relatedArticle = new WP_Query( array(
            'post_type' => 'post',
            'tax_query' => array(
                array (
                    'taxonomy' => 'project',
                    'field' => 'term_id',
                    'terms' => $relatedProject->term_id),
                )
            ),
        );
        $relatedUpdate = new WP_Query( array(
            'post_type' => 'update',
            'tax_query' => array(
                array (
                    'taxonomy' => 'project',
                    'field' => 'term_id',
                    'terms' => $relatedProject->term_id),
                )
            ),
        );
    } 

    if(have_posts()){
        $currentPostId = get_the_ID();
    }
?>

<aside id="secondary" class="widget-area">
	<?php if($post_type == "post"): ?>
		<h3 style="color:red;">Post Sidebar</h3>
	<?php elseif($post_type == "update"): ?>
		<h3 style="color:red;">Update Sidebar</h3>
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
		<h3 style="color:red;">Project Sidebar</h3>
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
	?>
    <!-- Begin related content -->
    <h3>Related Content</h3>
    <?php $relatedCount = 0; if(isset($relatedProject)): ?>
        <?php 
        //print_r($relatedProject); 
        if( get_field('banner','term_'.$relatedProject->term_id)) 
            set_query_var( 'bannerImage', get_field('banner','term_'.$relatedProject->term_id)['sizes']['large'] );
        else
            set_query_var( 'bannerImage', false );

        if( get_field('background_color','term_'.$relatedProject->term_id)) 
            set_query_var( 'bannerColor', get_field('background_color','term_'.$relatedProject->term_id) );
        else
            set_query_var( 'bannerColor', false );

        if( get_field('featured_image', 'term_'.$relatedProject->term_id) ) 
            set_query_var( 'headlineIcon', get_field('featured_image', 'term_'.$relatedProject->term_id)['sizes']['thumbnail'] );
        else
            set_query_var( 'headlineIcon', false );

        if( get_field('production_title', 'term_'.$relatedProject->term_id) ) 
            set_query_var( 'headlineSuperTitle', get_field('production_title', 'term_'.$relatedProject->term_id) );
        else
            set_query_var( 'headlineSuperTitle', false );

        if( get_field('tag_line', 'term_'.$relatedProject->term_id) ) 
            set_query_var( 'headlineTitle', get_field('tag_line', 'term_'.$relatedProject->term_id) );
        else
            set_query_var( 'headlineTitle', false );
        ?>
        <article id="post-<?php echo $relatedProject->term_id; ?>">
			<a href="<?php echo get_term_link($relatedProject->term_id); ?>">
				
				<?php get_template_part( 'template-parts/banner' ); ?>
				<?php get_template_part( 'template-parts/headline' ); ?>

			</a>
        </article>
        <?php $relatedCount++; ?>
        <?php if($relatedArticle->have_posts()):
            $relatedArticle->the_post(); 
            if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
            set_query_var( 'headlineSuperTitle', 'Article' );
            set_query_var( 'headlineTitle', get_the_title() );
        ?>
            <article id="post-<?php the_ID(); ?>">
                <a <?php if(get_field('external_content')){ echo 'href="'.get_field('external_content').'" target="_blank"'; }else{ echo 'href="'.get_permalink().'"'; }?>>
                    <?php get_template_part( 'template-parts/banner' ); ?>
                    <?php get_template_part( 'template-parts/headline' ); ?>

                </a>
            </article>
            <?php $relatedCount++; ?>
        <?php endif; ?> 
        <?php if($relatedUpdate->have_posts()):
            while ( $relatedUpdate->have_posts() && $relatedCount < 4 ) :
                $relatedUpdate->the_post(); 
                if($currentPostId != get_the_ID()):
                    if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
                    set_query_var( 'headlineSuperTitle', get_the_date() );
                    set_query_var( 'headlineTitle', get_the_title() );
                    set_query_var( 'bannerImage', get_the_post_thumbnail_url(get_the_ID(), 'medium') );
        ?>
                    <article id="post-<?php the_ID(); ?>">
                        <a <?php if(get_field('external_content')){ echo 'href="'.get_field('external_content').'" target="_blank"'; }else{ echo 'href="'.get_permalink().'"'; }?>>
                            <?php get_template_part( 'template-parts/banner' ); ?>
                            <?php get_template_part( 'template-parts/headline' ); ?>

                        </a>
                    </article>
                    <?php $relatedCount++; ?>
                <?php endif; ?> 
            <?php endwhile; ?> 
        <?php endif; ?> 
    <?php endif; ?> 

</aside><!-- #secondary -->
