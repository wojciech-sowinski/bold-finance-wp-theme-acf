<section class="newsletter-section bg-primary text-light px-2 py-5 px-md-5 py-md-5 "
    <?= idTag(get_sub_field('newsletter_anchor')) ?>>
    <div class="container px-md-5 ">
        <div class="row px-md-5">
            <div class="col-12 col-md-10 col-xxl-8 mx-auto">
                <div>
                    <h2 class="text-center text-md-start d-flex justify-content-between">
                        Newsletter
                        <i class="icon-send fs-1"></i>
                    </h2>
                </div>
                <p class="text-center text-md-start">
                    Jeżeli chcesz otrzymywać informacje o nowościach i promocjach zapisz sie do newslettera.
                </p>
                <div>
                    <?= do_shortcode('[contact-form-7 id="750" title="newsletter"]') ?>
                </div>
            </div>
        </div>
    </div>
</section>