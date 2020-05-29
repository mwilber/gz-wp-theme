<header class="entry-header">
    <?php greenzeta_post_thumbnail(); ?>
    <div class="entry-headline">
        <?php if(get_field('super_headline')): ?>
            <h2 class="entry-super-title"><?php the_field('super_headline'); ?></h2>
        <?php elseif(get_field('client')): ?>
            <h2 class="entry-super-title"><?php the_field('client'); ?></h2>
        <?php endif; ?>
        <?php if(get_field('headline')): ?>
            <h1 class="entry-title"><?php the_field('headline'); ?></h1>
        <?php else: ?>
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <?php endif; ?>
    </div>
</header><!-- .entry-header -->