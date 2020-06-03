<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GreenZeta
 */

$images = get_field('screen_shots');
			$tags = wp_get_object_terms( $post->ID,  'post_tag' );


?>

<article style="width:100%; position: relative;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

			
<div id="screenshots" class="glide">
<div class="glide__track" data-glide-el="track">
<ul class="glide__slides">
	<?php if( get_field('case_video') ): ?>
		<li class="glide__slide">
                     <video 
                            controls
                            class="cfm-videoplayer-desktop" 
                            width="960" 
                            height="540" 
                            type="video/mp4" 
                            poster="<?php echo get_field('case_poster') ?>" 
                            src="<?php echo get_field('case_video') ?>" 
                            style="width: 100%; height: auto;">
                        </video>
		</li>
	<?php endif; ?>
	<?php if( $images ): ?>
		<?php foreach( $images as $image ): ?>
			<li class="glide__slide">
			<a href="<?php echo $image['sizes']['full']; ?>">
				<?php echo $image['caption']; ?>
				<img src="<?php echo $image['sizes']['large']; ?>" />
			</a>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
</div>
<div class="glide__arrows" data-glide-el="controls">
    <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
    <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
  </div>

</div>
			


	<footer class="entry-footer">
		<?php greenzeta_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
