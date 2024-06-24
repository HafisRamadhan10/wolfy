<?php
/**
 * Block Name: Gallery
 *
 */

$title = get_field('title');
$gallery = get_field('gallery');
?>

<div class="gallery px-4 px-md-0 mb-5">
  <div class="container">
    <div class="wrapper">
          <h2 class="title" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"><?php echo $title; ?></h2>

          <div class="media-details">
            <div class="row">
              <?php foreach($gallery as $item): ?>
                <div class="col-md-4 mb-3">
                <?php if ($item['choose_image_or_file'] == 'image') { ?>
                  <div class="wrap-img">
                    <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['title'] ?>">
                  </div>
                <?php } elseif ($item['choose_image_or_file'] == 'file') { ?>
                  <div class="wrap-img">
                    <video preload="auto" autoplay controls>
                      <source src="<?php echo $item['file']['url'] ?>" type="video/mp4">
                    </video>
                  </div>
                <?php } ?>
              </div>
              <?php endforeach; ?>

            </div>
          </div>
        </div>
  </div>
</div>
