<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'editor_wyswig'): ?>
  <section class="note-section px-2 py-4">
    <div class="container">
      <div class="row">
        <?php 
        
        the_sub_field('editor_wyswig_editor')
        
        ?>
    </div>
  </section>
<?php endif; ?>