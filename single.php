<?php
defined( 'ABSPATH' ) or die( 'Vulpix, use Flamethrower!' );
/**
 * Single template
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#common-wordpress-template-files
 * @package Vulpix
 * @since Vulpix 1.0.0
 */
get_header();
?>
<main role="main" class="container">
    <div class="grid">
        <article <?php echo post_class(); ?>>
            <?php
            while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/content/template', 'post-header' );
                ?>
                <div class="col-sm-10 offset-1 col-md-8 offset-md-2">
                    <?php the_content(); ?>
                </div>
                <?php
            }
            ?>
        </article>
	</div>
    <?php get_template_part( 'template-parts/content/template', 'post-footer' ); ?>
</main>
<?php
get_footer();
