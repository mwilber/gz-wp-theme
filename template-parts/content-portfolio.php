<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

$images = get_field('screen_shots');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'greenzeta' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'greenzeta' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<div id="screenshots" class="swiper-container">
		<div class="swiper-wrapper">
				<?php if( get_field('case_video') ): ?>
					<div class="swiper-slide">
						
						<video 
							controls
							width="960" 
							height="540" 
							type="video/mp4" 
							poster="<?php echo get_field('case_poster') ?>" 
							src="<?php echo get_field('case_video') ?>" 
							style="width: 100%; height: auto;">
						</video>
						<a class="video-play-button fas fa-caret-right" href="#"></a>
					</div>
				<?php endif; ?>
				<?php if( $images ): ?>
					<?php foreach( $images as $image ): ?>
						<div class="swiper-slide">
							<a href="<?php echo $image['url']; ?>">
								<?php echo $image['caption']; ?>
								<img src="<?php echo $image['url']; ?>" />
							</a>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

		<!-- If we need navigation buttons -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>

	<footer class="entry-footer">
		<?php greenzeta_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
