<?php
/**
 * Block Name: Surrounding Tabs
 *
 */

  $surrounding_tabs = get_field('surrounding_tabs');
  $tabs = $surrounding_tabs['tabs'];
?>

<div class="section-surrounding-tabs">
  <div class="container">
      <div class="outer-tab-name">
        <div class="row justify-content-center justify-content-lg-start border-tab">
          <div class="col-11 col-md-12">
            <div class="owl-carousel owl-theme surrounding-tab-carousel">
              <?php foreach($tabs as $key => $tab): ?>
                <div class="wrapper text-center <?php echo ($key == 0 ? "active" : "")?>" data-tab="tab-<?php echo $key; ?>">
                  <h5 class="tab-name"><?php echo $tab['tab_name']; ?></h5>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="container outer-content">
    <div class="row">
      <div class="col-12">
        <div class="wrapper">
          <?php foreach($tabs as $key => $tab):
            $count = count($tab['image_carousel']);
            ?>
            <div class="inner-wrapper tab-<?php echo $key; ?> <?php echo ($key == 0 ? "active fadeshow" : "")?>">
              <div class="wrapper-img count-<?php echo $count?>">
                <?php foreach($tab['image_carousel'] as $key => $boximg): ?>
                  <div class="image">
                    <div class="col-12 px-0">
                      <div class="wrap-imgtxt">
                        <div class="content-overlay"></div>
                        <div class="owl-carousel owl-theme img-carousel">
                          <?php foreach($boximg['image'] as $key => $imggalery): ?>
                            <div class="item">
                              <img src="<?php echo esc_url($imggalery['url']); ?>"/>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="wrapper-bio">
                          <p class="sub-place m-0"><?php echo $boximg['sub_place']; ?></span></p>
                          <p class="name-place m-0"><?php echo $boximg['place_name']; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
