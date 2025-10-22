<?php 
/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */
?>

<div class="accordions-block">
    <?php if( have_rows('accordions') ): ?>
    <?php while( have_rows('accordions') ): the_row(); ?>  
    <div class="accordion">
        <div class="accordion_title">
            <h3><?php the_sub_field('accordion_title'); ?></h3><span></span>
        </div>
        <div class="accordion_content">
            <?php the_sub_field('accordion_content'); ?>
        </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?> 
</div>

