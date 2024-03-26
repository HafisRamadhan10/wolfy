<?php
/**
 * Block Name: Accordions
 *
 */

$content_list = get_field('content_list');

$id = 'accordion-' . $block['id'];

if($content_list) { ?>
    <section class="accordion-wrap">
        <div class="row">
            <div class="col-12">
                <?php
                $a = 1;
                if($content_list): ?>
                    <div class="faq-section">
                        <?php
                        foreach ($content_list as $list):
                            ?>
                            <div class="accor-wrap" style="<?php echo $a > 3 ? 'display: none;' : '' ?>" data-tab="tab-<?php echo $a; ?>">
                                <button class="btn-accordion collapsed" type="button" data-toggle="collapse" data-target="#<?php echo $id; ?>-list<?php echo $a ?>"
                                        aria-expanded="false" aria-controls="list<?php echo $a ?>">
                                    <h2 class="accor-title"><span class="accor-text"><?php echo $list['title']; ?></span> <img src="<?php echo get_template_directory_uri().'/assets/images/arrow-down.png'?>" alt="arrowdown"></h2>
                                </button>
                                <div class="collapse" id="<?php echo $id; ?>-list<?php echo $a ?>">
                                    <div class="accor-content">
                                        <?php echo $list['description']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php $a++; ?>
                            <?php
                        endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
      <?php if (count($content_list) > 3) { ?>
        <div class="text-center">
          <a class="btn-main btn-main-long show-more-btn mt-4 mt-md-5" href="#">MORE</a>
        </div>
      <?php } ?>
    </section>
<?php } ?>
