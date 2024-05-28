<?php
/*
  Template Name: Title With Summary
*/
get_header();?>

<?php while (have_posts()) : the_post() ?>
    <?php include get_template_directory().'/inc/page_header.php'?>
    <div class="row justify-content-center m-0 content-space-0 content-space-md-1 pt-lg-1">
        <div class="col-lg-9 px-lg-0">
            <?php the_content();?>
        </div>
    </div>;?>
<?php endwhile; ?>
<?php get_footer();?>
