<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'credit_form'): ?>
  <section class="credit-form py-4" <?= idTag(get_sub_field('credit_form_anchor')); ?>>
    <div class="container">
      <div class="row d-flex flex-column flex-lg-row">
        <div class="col-12 col-lg-3 p-5 rounded-2" style="background: url(<?php esc_url(the_sub_field('credit_form_left_col_img')); ?>), <?php echo get_theme_mod('primary') ?>;
                background-size: cover !important;
                background-position: center !important;
                background-repeat: no-repeat !important;">
          <h2 class="text-light">
            <?php the_sub_field('credit_form_title'); ?>
          </h2>
          <p class="text-light">
            <?php the_sub_field('credit_form_text'); ?>
          </p>
          <div>
            <a class="text-light text-decoration-underline" title="<?php the_sub_field('credit_form_note_text'); ?>"
              href="<?php esc_url(the_sub_field('credit_form_note_url')); ?>">
              <?php the_sub_field('credit_form_note_text'); ?>
            </a>
          </div>
        </div>
        <div class="col-12 col-lg-9 p-0 px-md-4  rounded-2 ">
          <?= do_shortcode('[contact-form-7 id="700" title="credit-form"]') ?>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>
<script>
  const formatter = new Intl.NumberFormat('pl-PL', {
    style: 'currency',
    currency: 'PLN',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
    useGrouping: true,
  });
  function getFromRange(val) {
    document.getElementById("creditValue").value = formatter.format(val);
  }
  (function () {
    'use strict';
    window.addEventListener('load', function () {
      var forms = document.getElementsByClassName('needs-validation');
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>


<!-- 
<input oninput="getFromRange(this.value)" min="0" max="1000000" step="1000" value="0" type="range"
                  class="form-range py-3 d-none d-md-block" id="creditValueRange" required> -->