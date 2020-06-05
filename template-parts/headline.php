<header class="entry-header">
	<div class="post-thumbnail">
		<?php if($post->post_type == 'post'): ?>
			<?php echo get_avatar($post->post_author, 150); ?>
		<?php else: ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
	</div>
	<div class="entry-headline">
		<?php if(get_field('super_headline')): ?>
			<h2 class="entry-super-title"><?php the_field('super_headline'); ?></h2>
		<?php elseif(get_field('client')): ?>
			<h2 class="entry-super-title"><?php the_field('client'); ?></h2>
		<?php else: ?>
			<?php if( !is_home() ): // Don't display super in articles listing ?>
				<h2 class="entry-super-title"><?php greenzeta_posted_on(); ?></h2>
			<?php endif; ?>
		<?php endif; ?>
		<?php if(get_field('headline')): ?>
			<h1 class="entry-title"><?php the_field('headline'); ?></h1>
		<?php else: ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>
	</div>
</header><!-- .entry-header -->