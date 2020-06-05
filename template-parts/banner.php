<?php if( get_field('banner')): ?>
	<div class="banner" style="background-image: url('<?php echo get_field('banner')['sizes']['large']; ?>');"></div>
<?php else: ?>
	<div class="banner" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
<?php endif; ?>