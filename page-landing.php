<?php
/**
 * Template Name: Landing_apge (Full width)
 * Description: LandingPage template full width.
 *
 */

get_header();
?>
<div id="landing-page-wrap">
    <section id="landing-page">
        <div class="row position-relative pe-0 pe-lg-5">
            <div class="col-10 col-md-7 img-bg-landing">
            </div>
            <div class="col-2 col-md-5 griadent">
            </div>
            <div id="landing-page-content" class="p-0 m-0 py-lg-5 px-lg-5 d-flex flex-column align-items-end">
                <div
                    class="row border-left-primary bg-white col-12 col-md-8  d-flex flex-column flex-xl-row-reverse py-5 px-3">
                    <div class="col-12 col-xl-3 d-flex justify-content-start justify-content-xl-center py-3">
                        <?php $landing_page_logo = get_field('landing-page-logo'); ?>
                        <?php $size = 'full'; ?>
                        <?php if ($landing_page_logo): ?>
                            <a title='<?= __('Back to home', 'boldfinance') ?>' href="<?= get_site_url() ?>">
                                <?php echo wp_get_attachment_image($landing_page_logo, $size, false, array('class' => 'small-logo')); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-9">
                        <?php if (get_field('landing-page-title')) {
                            ?>
                            <h1 class="h3">
                                <?= get_field('landing-page-title');
                                ?>
                            </h1>
                            <?php
                        } ?>
                        <?php if (
                            get_field('landing-page-excerpt')
                        ) {
                            ?>
                            <p>
                                <?= get_field('landing-page-excerpt');
                                ?>
                            </p>
                            <?php
                        } ?>
                    </div>
                </div>
                <div class="row  mb-3 col-12 col-md-8 border-left-primary-parent ">
                    <?php
                    while (the_flexible_field("elastic_sections")):
                        get_template_part('template-flexible/' . get_row_layout());
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .griadent {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        background: linear-gradient(180deg, var(--bf_gradient_top) 0%, var(--bf_gradient_bottom) 100%);
    }

    .img-bg-landing {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background-image: url('<?= the_field('landing-page-bg-img'); ?>');
        background-size: cover;
        background-repeat: no-repeat;
    }

    #landing-page>div.row {
        min-height: 100vh;
    }

    #landing-page-content {
        z-index: 9999;
        position: relative;
        right: 0;
    }

    #landing-page-content>div>* {}

    .border-left-primary {
        border-left: 4px solid var(--bf_primary);
    }

    .border-left-primary-parent>* {
        border-left: 4px solid var(--bf_primary);
    }
</style>
<?php get_footer();