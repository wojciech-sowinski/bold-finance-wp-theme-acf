<?php
get_header();


?>

<section class="container pt-2 pb-2 ">
  <div class="row p-0 flex-column-reverse flex-lg-row-reverse"
    style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
    <?php $product_header_img = get_field('product_header_img'); ?>
    <?php if ($product_header_img): ?>
      <div class="col-12 col-lg-6 p-0 bg-img-cover"
        style="background-image:url(<?php echo esc_url($product_header_img['url']); ?>); padding:150px 0 !important;">
      </div>
    <?php endif; ?>
    <div class="col-12 col-lg-6 bg-primary text-light d-flex flex-column justify-content-start align-items-start">
      <div class="col-12 p-1 px-md-5 py-md-4 ">
        <div>
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs "', '</p>');
          }
          ?>
        </div>
        <div>
          <h1 class="py-2 text-center text-lg-start ">
            <?php the_field('product_name'); ?>
          </h1>
          <p class="py-2 text-center text-lg-start ">
            <?php the_field('product_excerpt'); ?>
          </p>
          <div class="py-2 d-flex  flex-column flex-md-row  justify-content-center justify-content-lg-start align-items-center gap-5">
            <?php $btnText = get_field('product_cta_header_btn_text'); ?>
            <?php $product_cta_header_btn_url = get_field('product_cta_header_btn_url'); ?>
            <?php if ($product_cta_header_btn_url): ?>
              <?php $post = $product_cta_header_btn_url; ?>
              <?php setup_postdata($post); ?>
              <a class="btn btn-secondary" href="<?php the_permalink(); ?>"><?php echo $btnText ?></a>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php if (have_rows('product_add_attachments')): ?>
              <?php while (have_rows('product_add_attachments')):
                the_row(); ?>
                <?php $product_add_attachments_link = get_sub_field('product_add_attachments_link'); ?>
                <?php if ($product_add_attachments_link): ?>
                  <?php $post = $product_add_attachments_link; ?>
                  <?php setup_postdata($post); ?>
                  <a class="text-white text-decoration-underline" title="<?php the_sub_field('product_attachment'); ?>"
                    href="<?php the_permalink(); ?>"><?php the_sub_field('product_attachment'); ?></a>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (have_rows('product_tab')): ?>
  <section class="container pt-2 pb-2 ">
    <div class="container">
      <div class="row">
        <ul class="nav nav-tabs d-flex justify-content-center mt-3 mb-5 align-items-center" id="nav-tabs-dot" role="tablist">
          <?php while (have_rows('product_tab')):
            the_row(); ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php if (get_row_index() == 1):
                echo 'active';
              endif ?>" id="product<?php echo get_row_index(); ?>-tab" data-bs-toggle="tab"
                data-bs-target="#product<?php echo get_row_index(); ?>" type="button" role="tab" aria-controls="home"
                aria-selected="true"> <?php the_sub_field('product_tab_title'); ?>
              </button>
            </li>
          <?php endwhile; ?>
          <?php $ctaBtnText = get_field( 'product_cta_nav_btn_text' ); ?>
          <?php $product_cta_nav_btn_url = get_field('product_cta_nav_btn_url'); ?>
          <?php if ($product_cta_nav_btn_url): ?>
            <?php $post = $product_cta_nav_btn_url; ?>
            <?php setup_postdata($post); ?>
            <a title="<?php echo $ctaBtnText; ?>" class="btn btn-primary mx-5 mb-2" href="<?php the_permalink(); ?>"><?php echo $ctaBtnText; ?></a>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </ul>
      </div>
      <div class="row">
        <?php while (have_rows('product_tab')):
          the_row(); ?>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show <?php if (get_row_index() == 1):
              echo 'active';
            endif ?>" id="product<?php echo get_row_index(); ?>" role="tabpanel">
              <h2>
                <?php the_sub_field('product_tab_title'); ?>
              </h2>
              <p>
                <?php the_sub_field('product_tab_excerption'); ?>
              </p>
              <div>
                <?php if (have_rows('elastic_sections')): ?>
                  <?php while (have_rows('elastic_sections')):
                    the_row(); ?>
                    <?php get_template_part('template-flexible/' . get_row_layout()); ?>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php
while (the_flexible_field("elastic_sections")):
  get_template_part('template-flexible/' . get_row_layout());
endwhile;
get_footer();