<?php
/**
 * Block Name: Experience
 *
 */

  $title = get_field('title');
  $experience = get_field('experience');
?>

<div class="section-experience">
    <div class="container custom-container-small">
      <h2 class="section-title text-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"><?php echo $title; ?></h2>
        <?php foreach($experience as $c => $item):
          $count = count($item['image']);
          ?>
          <div class="row justify-content-center justify-content-xl-between mb-5" data-aos="fade-up" data-aos-duration="1200">
          <div id="<?php echo $item['anchor_id']; ?>" class="item col-md-6 px-md-5 px-xl-2 <?php echo $c % 2 != 0 ? 'order-md-1' : '' ?>">
            <div class="owl-carousel owl-theme experience-carousel">
              <?php foreach($item['image'] as $key => $imggalery): ?>
                <div class="wrap-img">
                  <img src="<?php echo esc_url($imggalery['url']); ?>" />
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="content col-md-6 px-md-4 mt-4 mt-md-0 px-xl-5">
            <div class="content-wrapper">
              <h2><?php echo $item['name']; ?></h2>
              <?php echo $item['caption']; ?>
            </div>
            <div class="desc mt-4">
              <?php echo $item['description']; ?>
            </div>
          </div>
      </div>

      <?php endforeach; ?>
    </div>
</div>
he
