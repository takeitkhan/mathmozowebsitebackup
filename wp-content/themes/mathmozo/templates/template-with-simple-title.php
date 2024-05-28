<?php
/*
  Template Name: Simple Title
*/
get_header();?>

    <?php while (have_posts()) : the_post() ?>
        <?php //include get_template_directory().'/inc/page_header.php'?>
        <div class="row justify-content-center m-0 xcontent-space-0 xcontent-space-md-1 xpt-lg-1 py-5">
            <div class="col-lg-9 px-lg-0">
            <h1 class="mb-f20">
                <?php echo get_the_title();?>
            </h1>
            <?php the_content();?>
            </div>
        </div>
    <?php endwhile; ?>

<?php get_footer();?>
