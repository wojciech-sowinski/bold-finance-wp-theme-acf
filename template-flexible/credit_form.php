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
  <section class="credit-form bg-white mb-4 py-4" <?= idTag(get_sub_field('credit_form_anchor')); ?>>
    <div class="container">
      <div class="row d-flex flex-column flex-lg-row <?php if (get_sub_field('credit_form_hide_column')) {
        echo 'col-12';
      }
      ; ?>">
        <?php if (!get_sub_field('credit_form_hide_column')) {
          ?>
          <div class="col-12 col-lg-3 p-5 rounded-2 d-flex flex-column justify-content-between" style="background: url(<?php esc_url(the_sub_field('credit_form_left_col_img')); ?>), <?php echo get_theme_mod('primary') ?>;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;">
            <div>
              <h2 class="text-light">
                <?php the_sub_field('credit_form_title'); ?>
              </h2>
              <p class="text-light">
                <?php the_sub_field('credit_form_text'); ?>
              </p>
              <div class="py-3">
                <a class="text-light text-decoration-underline" title="<?php the_sub_field('credit_form_note_text'); ?>"
                  href="<?php esc_url(the_sub_field('credit_form_note_url')); ?>">
                  <?php the_sub_field('credit_form_note_text'); ?>
                </a>
              </div>
            </div>
            <div class="text-light">
              <div>
                <a class=" py-2 d-flex align-items-center gap-1 text-light"
                  href="tel: <?php the_field('header_info_tel', 'option'); ?>">
                  <i class="icon-phone px-2"></i>
                  <span>
                    <?php the_field('header_info_tel', 'option'); ?>
                  </span>
                </a>
              </div>
              <div>
                <a class=" py-2 d-flex align-items-center  gap-1 text-light"
                  href="mailto: <?php the_field('header_info_email', 'option'); ?>">
                  <i class="icon-mail px-2"></i>
                  <span>
                    <?php the_field('header_info_email', 'option'); ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <?php
        }
        ; ?>
        <div class="col-12 <?php if (!get_sub_field('credit_form_hide_column')) {
          echo 'col-lg-9';
        }
        ?> p-1 px-md-4  rounded-2 position-relative">
          <?= do_shortcode('[contact-form-7 id="700" title="credit-form"]') ?>
          <div id="mail_sended_info" class="d-none p-3">
            <div class="send-icon">
              <i class="icon-checked"></i>
            </div>
            <p>
              <span>Dziękujemy za wypełnienie formularza.</span>
              <span>Postaramy się jak najszybciej z Państwem skontaktować.</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php


$options = [];
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
    $options[] = get_the_title();
    wp_reset_postdata();
  }
  ;
}
;
?>

<script>
  var formRange = document.querySelector('.form-range');
  formRange.max = <?= get_sub_field('credit_form_max_credit_value'); ?>;
  formRange.step = 10;

  var privacyLink = document.querySelector('.privacy-link');
  privacyLink.href = "<?= esc_url(get_page_link(get_option('wp_page_for_privacy_policy'))); ?>"

  var selectOptions = <?php echo json_encode($options); ?>;
  const productInput = document.getElementById('product_input')

  productInput.innerHTML = '';

  selectOptions.forEach((option, index) => {
    const childOption = document.createElement('option');
    childOption.innerText = option;
    childOption.value = option;
    if (index == 0) {
      childOption.selected = true
    }
    productInput.appendChild(childOption)
  });

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


  document.addEventListener('wpcf7submit', function (event) {
    if (event.detail.status == "mail_failed") {
      const sendMsg = document.getElementById('mail_sended_info');
      sendMsg.classList.remove('d-none')
      sendMsg.classList.add('d-flex')
    } if (event.detail.status == "mail_sent") {
      const sendMsg = document.getElementById('mail_sended_info');
      sendMsg.classList.remove('d-none')
      sendMsg.classList.add('d-flex')
    }
  }, false);

</script>



