<?php
defined( 'ABSPATH' ) or die( 'Vulpix, use Flamethrower!' );
/**
 * Post list template
 *
 * @package Vulpix
 * @since Vulpix 1.0.0
 */
?>
<article class="post-list">
    <div class="col-6 post-list__thumbnail-container">
        <?php vpx_the_post_thumbnail(); ?>
    </div>
    <div class="col-6 post-list__details">
        <?php
        the_category();
        vpx_the_post_thumbnail_title( 'h3' );
        vpx_the_post_meta();
        ?>
    </div>
</article>