<?php
/**
 * Block Name: Quote Carousel
 *
 */

// create id attribute for specific styling
$id = $banner_type . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>

<?php if(have_rows('quote_carousel')): ?>
<section id="<?php echo $id; ?>" class="quote-carousel-section <?php echo $align_class; ?>">
  <div class="container">
    <div class="owl-carousel owl-theme quote-carousel">
      <?php while(have_rows('quote_carousel')):the_row(); ?>
        <div class="item">
          <?php
          $headline = get_sub_field('headline');
          $quote_content = get_sub_field('quote_content');
          $author = get_sub_field('author');
          $image = get_sub_field('image');
          $location = get_sub_field('location');
          ?>
          <div class="container">
            <div class="row align-items-center">
              <?php if ($image) :?>
                <div class="col-12 col-sm-auto mb-3">
                  <img src="<?php echo esc_url($image['url']) ?>" class="img-fluid" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
              <?php endif; ?>

              <div class="col-12 <?php echo $image ? 'col-sm-auto' : '' ?>">
                <p class="author"><?php echo $author ?></p>
                <?php if ($location) : ?>
                  <p class="location mb-0"><?php echo $location ?></p>
                <?php endif; ?>
              </div>
              <div class="col-12 mt-4">
                <p class="headline "><?php echo $headline ?></p>
              </div>
              <div class="col-12 mt-4">
                <p class="quote-text"><?php echo $quote_content ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php endif; ?>
