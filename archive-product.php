<?php
/**
 * Template Name: archive-products
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
get_header();
?>

<header>


</header>
<?php
while (the_flexible_field("elastic_sections")):
    get_template_part('template-flexible/' . get_row_layout());
endwhile;
?>
<section>
    <?php
    get_template_part('template-parts/newsletter', 'template');
    ?>
</section>
<?php get_footer();