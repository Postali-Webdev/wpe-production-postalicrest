<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $links_block_layout = get_field('links_block_layout');
    $links_block_headline = get_field('links_block_headline');
    $links_block_subheadline = get_field('links_block_subheadline');
?>

<?php if ($links_block_layout == 'slim') { ?>

<div class="link-block links-slim">
    <div class="columns">
        <div class="column-full block">
            <h2><?php echo $links_block_headline; ?></h2>
            <?php if( have_rows('links_slim') ): ?>
            <ul class="links">
            <?php while( have_rows('links_slim') ): the_row(); 
                $link = get_sub_field('link');
                    if ( $link ) { ?>
                    <li><a target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></li>
                <?php }     
            endwhile; ?>
            </ul>
            <?php endif; ?> 
        </div>
    </div>
</div>

<?php } ?>

<?php if ($links_block_layout == 'full') { ?>

<div class="link-block links-full">
    <div class="columns">
        <div class="column-full block">
            <h2><?php echo $links_block_headline; ?></h2>
            <p class="subhead"><?php echo $links_block_subheadline; ?></p>
            <?php if( have_rows('links_full') ): ?>

                <?php $count = count(get_field('links_full')); ?>   
            <div class="links boxes-<?php echo $count; ?>">
            <?php while( have_rows('links_full') ): the_row(); ?>  
                <div class="link-box">
                <?php 
                $image = get_sub_field('link_image');
                $link = get_sub_field('link');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
                    <div class="spacer-30"></div>
                    <h3><?php the_sub_field('link_headline'); ?></h3>
                    <p><?php the_sub_field('link_copy'); ?></p>

                    <?php if ( $link ) { ?>
                        <a class="link-button" href="<?php echo $link['url']; ?>"  target="<?php echo $link['target']; ?>">
                    <?php } ?>
                        <span class="text"><?php echo $link['title']; ?></span> <span class="icon-crest-arrow-right"></span>
                    </a>
                </div>
                
            <?php endwhile; ?>
            </div>
            <?php endif; ?> 

            <?php if(get_field('links_cta_button_text')) { ?>
            <div class="spacer-60"></div>
            <a href="<?php the_field('links_cta_button_link'); ?>" class="btn"><?php the_field('links_cta_button_text'); ?></a>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>