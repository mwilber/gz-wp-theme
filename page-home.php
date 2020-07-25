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

	function SetQueryVarsForTax($tax){
		if( get_field('banner','term_'.$tax->term_id)) 
			set_query_var( 'bannerImage', get_field('banner','term_'.$tax->term_id)['sizes']['large'] );
		else
			set_query_var( 'bannerImage', false );

		if( get_field('background_color','term_'.$tax->term_id)) 
			set_query_var( 'bannerColor', get_field('background_color','term_'.$tax->term_id) );
		else
			set_query_var( 'bannerColor', false );

		set_query_var( 'headlineIcon', false );

		if( get_field('production_title', 'term_'.$tax->term_id) ) 
			set_query_var( 'headlineSuperTitle', get_field('production_title', 'term_'.$tax->term_id) );
		else
			set_query_var( 'headlineSuperTitle', false );

		if( get_field('tag_line', 'term_'.$tax->term_id) ) 
			set_query_var( 'headlineTitle', get_field('tag_line', 'term_'.$tax->term_id) );
		else
			set_query_var( 'headlineTitle', false );
	}

	function SetQueryVarsForArticle($article){

		if( get_field('banner', $article->ID)) 
			set_query_var( 'bannerImage', get_field('banner', $article->ID)['sizes']['large'] );
		else
			set_query_var( 'bannerImage', false );

		set_query_var( 'headlineIcon', false );
		set_query_var( 'headlineSuperTitle', 'Featured Article' );
		set_query_var( 'headlineTitle', $article->post_title );
	}

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

			<?php SetQueryVarsForTax($heroTax); ?>
			<article id="post-<?php echo $heroTax->term_id; ?>" class="hero">
				<a href="<?php echo get_term_link($heroTax->term_id); ?>">
					<?php get_template_part( 'template-parts/banner' ); ?>
					<?php get_template_part( 'template-parts/headline' ); ?>
				</a>
			</article>

			<?php for( $fidx=0; $fidx<2; $fidx++ ): ?>

				<?php $featuredTax = $featuredTaxes[$fidx]; $featuredArticle = $featuredArticles[$fidx]; ?>

			<?php //foreach( $featuredTaxes as $featuredTax ): ?>
				<?php SetQueryVarsForTax($featuredTax); ?>
				<article id="post-<?php echo $featuredTax->term_id; ?>">
					<a href="<?php echo get_term_link($featuredTax->term_id); ?>">
						<?php get_template_part( 'template-parts/banner' ); ?>
						<?php get_template_part( 'template-parts/headline' ); ?>
					</a>
				</article>
			<?php //endforeach; ?>


			<?php //foreach( $featuredArticles as $featuredArticle ): ?>
				<?php SetQueryVarsForArticle($featuredArticle); ?>
				<article id="post-<?php echo $featuredArticle->ID; ?>">
					<a <?php if(get_field('external_content', $featuredArticle->ID)){ echo 'href="'.get_field('external_content').'" target="_blank"'; }else{ echo 'href="'.get_permalink().'"'; }?>>
						<?php get_template_part( 'template-parts/banner' ); ?>
						<?php get_template_part( 'template-parts/headline' ); ?>
					</a>
				</article>
			<?php //endforeach; ?>

			<?php endfor; ?>

		</div> <!-- end .hero-group -->

		<h2>Portfolio</h2>

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

		<h2>Updates</h2>

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
