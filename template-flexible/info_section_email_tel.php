<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'info_section_email_tel'): ?>
    <section <?= idTag(get_sub_field('info_section_email_tel_anchor')); ?> class="py-4 info_section_email_tel">
        <div class="container border border-primary border-4 border-top-0 border-bottom-0 border-end-0 px-3 my-5 shadow">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 col-lg-12 col-xl-3 d-flex justify-content-center justify-content-xl-end">
                    <?php $info_section_email_tel_img = get_sub_field('info_section_email_tel_img'); ?>
                    <?php $size = 'full'; ?>
                    <?php if ($info_section_email_tel_img): ?>
                        <?php echo wp_get_attachment_image($info_section_email_tel_img, $size,false,array('class'=>'img-fluid')); ?>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border border-4 border-primary py-5 res-border">
                    <a class="h2 fw-semibold text-decoration-none text-dark d-flex justify-content-center"
                        href="tel:<?php the_sub_field('info_section_email_tel_tel_number'); ?>">
                        <i class="icon-phone mx-2"></i>
                        <?php the_sub_field('info_section_email_tel_tel_number'); ?>
                    </a>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border border-4 border-primary py-5 res-border">
                    <a class="h2 fw-semibold text-decoration-none text-dark d-flex justify-content-center"
                        href="mailto:<?php the_sub_field('info_section_email_tel_email'); ?>">
                        <i class="icon-mail mx-2"></i>
                        <?php the_sub_field('info_section_email_tel_email'); ?>
                    </a>
                </div>
            </div>
            <?php if (!empty(get_sub_field('info_section_email_tel_note'))): ?>
                <div class="row pt-5 pb-3">
                    <p class="note text-justify ">
                        <?php the_sub_field('info_section_email_tel_note'); ?>
                    </p>
                </div>
            <?php endif ?>
        </div>
    </section>
<?php endif; ?>