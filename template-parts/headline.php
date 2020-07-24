<header class="entry-header">
    <?php if(!isset($headlineIcon) || (isset($headlineIcon) && $headlineIcon != 'hidden')): ?>
    <div class="post-thumbnail">
        <?php if($headlineIcon != false): ?>
            <img src="<?php echo $headlineIcon ?>" />
        <?php else: ?>
            <?php the_post_thumbnail(); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
	<div class="entry-headline">
		<?php if(isset($headlineSuperTitle)): ?>
			<h2 class="entry-super-title"><?php echo $headlineSuperTitle ?></h2>
		<?php endif; ?>
		
		<?php if(isset($headlineTitle)): ?>
			<h1 class="entry-title"><?php echo $headlineTitle ?></h1>
		<?php else: ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>
		
	</div>
</header><!-- .entry-header -->
