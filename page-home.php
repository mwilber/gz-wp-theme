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

	function SetQueryVarsForPortfolio($article){

		if( get_field('banner', $article->ID)) 
			set_query_var( 'bannerImage', get_field('banner', $article->ID)['sizes']['large'] );
		else
			set_query_var( 'bannerImage', false );

		set_query_var( 'headlineIcon', false );

		if(get_field('client', $article->ID)){
			set_query_var( 'headlineSuperTitle', get_field('client', $article->ID) );
		}else{
			set_query_var( 'headlineSuperTitle', false );
		}

		set_query_var( 'headlineTitle', $article->post_title );
	}

	$heroTax = get_field('hero');
	$featuredTaxes = get_field('featured_projects');
	$featuredArticles = get_field('featured_articles');
	$featuredPortfolios = get_field('featured_portfolio');
	$args = array(
		'post_type'=>array('update'),
		'posts_per_page'=>8,
	);
	$updates = new WP_Query( $args );

	// Set up featured content data
	$featuredContent = array();

	array_push($featuredContent, [
		'id' => $heroTax->term_id,
		'className' => 'hero',
		'link' => get_term_link($heroTax->term_id),
		'bannerColor' => get_field('background_color','term_'.$heroTax->term_id),
		'bannerImage' => get_field('banner','term_'.$heroTax->term_id)['sizes']['large'] ,
		'headlineSuperTitle' => get_field('production_title', 'term_'.$heroTax->term_id),
		'headlineTitle' => get_field('tag_line', 'term_'.$heroTax->term_id)
	]);

	for($idx=0; $idx<2; $idx++){
        $contentId = $featuredArticles[$idx]->ID;
        if(get_field('external_content', $contentId)){
            $articleLink = get_field('external_content', $contentId);
        }else{
            $articleLink = get_permalink($contentId);
        }
		array_push($featuredContent, [
			'id' => $contentId,
			'className' => '',
			'link' => $articleLink,
			'bannerColor' => false,
			'bannerImage' => get_field('banner', $contentId)['sizes']['large'] ,
			'headlineSuperTitle' => get_field('client', $contentId),
			'headlineTitle' => get_the_title($contentId)
		]);

		if(count($featuredContent) >= 5) break; 

		for($jdx=0; $jdx<2; $jdx++){
			$contentId = $featuredTaxes[$jdx]->term_id;
			array_push($featuredContent, [
				'id' => $contentId,
				'className' => '',
				'link' => get_term_link($contentId),
				'bannerColor' => get_field('background_color','term_'.$contentId),
				'bannerImage' => get_field('banner','term_'.$contentId)['sizes']['large'] ,
				'headlineSuperTitle' => get_field('production_title', 'term_'.$contentId),
				'headlineTitle' => get_field('tag_line', 'term_'.$contentId)
			]);
		}
	}
	
	if( get_field('banner')) set_query_var( 'bannerImage', get_field('banner')['sizes']['large'] );
	if(get_field('super_headline')){
		set_query_var( 'headlineSuperTitle', get_field('super_headline') );
	}
	if(get_field('headline')){
		set_query_var( 'headlineTitle', get_field('headline') );
	}
	set_query_var( 'headlineIcon', 'hidden' );
?>

	<header class="page-header">
		<?php get_template_part( 'template-parts/banner' ); ?>
		<?php get_template_part( 'template-parts/headline' ); ?>
	</header>

	<main id="primary" class="site-main">

		<div class="hero-group">

			<?php foreach($featuredContent as $content): 
					set_query_var( 'bannerColor', $content['bannerColor'] );
					set_query_var( 'bannerImage', $content['bannerImage'] );
					set_query_var( 'headlineSuperTitle', $content['headlineSuperTitle'] );
					set_query_var( 'headlineTitle', $content['headlineTitle'] );
			?>
				<article id="post-<?php echo $content['id']; ?>" class="<?php echo $content['className']; ?>">
					<a href="<?php echo $content['link']; ?>" <?php echo (strpos($content['link'], 'greenzeta.com') === false) ? 'target="_blank"' : '' ?>>
						<?php get_template_part( 'template-parts/banner' ); ?>
						<?php get_template_part( 'template-parts/headline' ); ?>
					</a>
				</article>
			<?php endforeach; ?>

		</div> <!-- end .hero-group -->

		<header class="entry-header">
			<div class="entry-headline">
				<h2 class="entry-super-title">Portfolio</h2>
				<h1 class="entry-title">Featured Work</h1>
			</div>
		</header>

		<div class="portfolio-group">

			<?php foreach( $featuredPortfolios as $featuredPortfolio ): ?>
				<?php SetQueryVarsForPortfolio($featuredPortfolio); ?>
				<article id="post-<?php echo $featuredPortfolio->ID; ?>">
					<a href="<?php echo get_permalink($featuredPortfolio->ID); ?>">
						<?php get_template_part( 'template-parts/banner' ); ?>
						<?php get_template_part( 'template-parts/headline' ); ?>
					</a>
				</article> 
			<?php endforeach; ?>

		</div>

		<header class="entry-header">
			<div class="entry-headline">
				<h2 class="entry-super-title">Projects</h2>
				<h1 class="entry-title">Recent Updates</h1>
			</div>
		</header>

		<div class="update-group">

		<?php
			while ( $updates->have_posts() ) :
				$updates->the_post();
				get_template_part( 'template-parts/archive', get_post_type() );
			endwhile;
		?>

		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
