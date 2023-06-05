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


          <form
            class="needs-validation shadow p-4 d-flex flex-column gap-4 border border-primary border-4 border-top-0 border-bottom-0 border-end-0"
            novalidate>
            <div class="form-group d-flex flex-column flex-lg-row">
              <div class="col-12 col-lg-3">
                <label class="col-3 w-auto py-3" for="creditValue" class="form-label">Jaka kwota Cię interesuje?</label>
              </div>
              <div class="col-12 col-lg-9 d-flex ">
                <input oninput="getFromRange(this.value)" min="0" max="1000000" step="1000" value="0" type="range"
                  class="form-range py-3 d-none d-md-block" id="creditValueRange" required>
                <input class="w-100 w-md-25 ms-0 ms-md-4  py-3 text-start text-md-center form-control fw-semibold"
                  name="creditValue" type="text" value="0 zł" id="creditValue">
              </div>
            </div>
            <div class="form-group d-flex flex-column flex-lg-row">
              <div class="col-12 col-lg-3">
                <label for="product_input" class="form-label d-none d-md-block py-3">Wybierz produkt</label>
              </div>
              <div class="col-12 col-lg-9">
                <select name="selected_product" id="product_input" class="form-control form-select  py-3 fw-semibold">
                  <?php
                  $query = new WP_Query(
                    array(
                      'post_type' => 'product',
                      'orderby ' => 'name',
                      'order' => 'ASC'
                    )
                  );
                  $posts = $query->get_posts();
                  if ($posts) {
                    foreach ($posts as $post) {
                      setup_postdata($post);
                      the_title(); ?>
                      <option>
                        <?php the_title(); ?>
                      </option>
                      <?php
                      wp_reset_postdata();
                    }
                    ;
                  }
                  ;
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group d-flex flex-column flex-lg-row">
              <div class="col-12 col-lg-3">
                <label for="client_name" class="form-label d-none d-md-block py-3">Nazwa firmy</label>
              </div>
              <div class="col-12 col-lg-9">
                <input type="text" class="form-control  py-3" id="client_name" placeholder="Nazwa firmy" required>
                <div class="invalid-feedback">
                  Wpisz nazwę firmy
                </div>
              </div>
            </div>
            <div class="form-group d-flex flex-column flex-lg-row">
              <div class="col-12 col-lg-3">
                <label for="phone" class="form-label d-none d-md-block py-3">Numer telefon / Adres e-mail</label>
              </div>
              <div class="col-12 col-lg-9 d-flex gap-4 flex-column flex-lg-row">
                <div>
                  <input id="phone" type="text" class="form-control  py-3" placeholder="Numer telefonu" required>
                  <div class="invalid-feedback">
                    Wpisz numer telefonu
                  </div>
                </div>
                <div>
                  <input id="email" type="email" class="form-control  py-3" placeholder="Adres e-mail" required>
                  <div class="invalid-feedback">
                    Wpisz adres e-mail
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group d-flex flex-row flex-wrap ">
              <input class="form-check-input   me-2" type="checkbox" id="consent"
                style="width:15px !important;height:15px !important" required>
              <label for="consent" class="form-check-label col-11" for="gridCheck">
                Wyrażam zgodę na przetwarzanie moich danych osobowych w celu kontaktu z Administratorem poprzez
                formularz
                kontaktowy na zasadach określonych w
                <a title="Privat Policy" href="#">Polityce Prywatności.</a>
              </label>
              <div class="invalid-feedback col-12">
                Zaznacz treść zgody
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary">Wyślij formularz</button>
            </div>
          </form>
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



