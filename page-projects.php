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

$projects = get_terms( array( 'taxonomy' => 'project', 'post_types' => 'update', 'orderby' => 'post_date', 'order' => 'DESC' ) );
// $projects = get_terms( array(
//     'taxonomy' => 'project',
//     'hide_empty' => true,
// ) );
global $wpdb;
wp_reset_query();
?>
	<main id="primary" class="site-main">

		<header class="page-header">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</header>

		<?php for( $idx=0; $idx<count($projects); $idx++ ):
			//include( locate_template( 'template-parts/archive.php', false, false ) ); 
			$term = $projects[$idx]; ?>


			<article id="post-<?php echo $term->term_id; ?>">
			<a href="<?php echo get_term_link($term->term_id); ?>">
				
				<div class="banner" style="background-image: url('<?php if(get_field('banner', 'term_'.$term->term_id)){ echo get_field('banner', 'term_'.$term->term_id)['sizes']['large']; } ?>');"></div>

				<header class="entry-header">
					<div class="post-thumbnail">
						<img src="<?php echo get_field('featured_image', 'term_'.$term->term_id);  ?>"/>
					</div>
					<div class="entry-headline">
						<h2 class="entry-super-title"><?php echo get_field('production_title', 'term_'.$term->term_id);?></h2>
						<h1 class="entry-title"><?php echo get_field('tag_line', 'term_'.$term->term_id);?></h1>
					</div>
				</header><!-- .entry-header -->

					<div class="entry-content">
					<?php echo get_field('description', 'term_'.$term->term_id);?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php greenzeta_entry_footer(); ?>
					</footer><!-- .entry-footer -->
			</a>
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php
				// $args = array(
				// 	'post_type'=>array('tessera'),
				// 	'posts_per_page'=>4,
				// 	'tax_query' => array(
				// 		array(
				// 			'taxonomy' => 'tessellation',
				// 			'terms' => $originals[$idx]->slug ,
				// 			'field' => 'slug',
				// 		)
				// 	),
				// );
				// $query = new WP_Query( $args );
				// wp_reset_query();
				// while ( $query->have_posts() ): $query->the_post();

				// 	//get_template_part( 'template-parts/content', 'tessera-square' );

				// endwhile;
			?>
		<?php endfor; ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
