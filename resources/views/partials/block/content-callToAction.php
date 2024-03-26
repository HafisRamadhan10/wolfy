<?php
/**
 * Block Name: Call To Action
 *
 */

$call_to_action_type = get_field('call_to_action_type');
$cta_headline = get_field('cta_headline');
$gravity_form_id = get_field('gravity_form_id');
$cta = get_field('cta');
$margin = get_field('negative-margin');
$id = 'cta-' . $block['id'];

if (($call_to_action_type == 'box') || ($call_to_action_type == 'basic')) { ?>
    <section id="<?php echo $id; ?>" class="cta <?php if ($margin) {
        foreach ($margin as $result) {
            echo $result . " ";
        }
    }
    echo $call_to_action_type == 'basic' ? 'h-100' : '';

    ?>">
        <?php if (have_rows('cta')) : ?>
            <div class="row <?php echo $call_to_action_type == 'basic' ? 'h-100 align-items-center' : '' ?>">
                <?php while (have_rows('cta')) : the_row(); ?>
                    <div class="mb-2 mb-sm-0 col-sm">
                        <?php $open_in_new_tab = get_sub_field('open_in_new_tab') ?>
                        <a class="cta__content d-flex h-100 flex-column <?php echo $call_to_action_type == 'basic' ? 'simple-rounded' : '' ?>" href="<?php the_sub_field('url'); ?>"
                           style="background-image: url('');" target="<?php echo is_array($open_in_new_tab) ? $open_in_new_tab[0] : '_self' ?>">
                            <img src="<?php echo get_sub_field('background_image')['sizes']['medium_large']; ?>"
                                 alt="bg-img">

                            <div class="cta__content--inner h-100">
                                <?php if ($call_to_action_type == 'box') :?>
                                    <h4><?php the_sub_field('headline'); ?></h4>
                                <?php else: ?>
                                    <h2><?php the_sub_field('headline'); ?></h2>
                                <?php endif; ?>

                                <?php if ($call_to_action_type == 'box') :?>
                                    <?php the_sub_field('content'); ?>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </section>
<?php } else { ?>
    <section id="<?php echo $id; ?>" class="cta cta-form alignfull reverse-color <?php if ($margin) {
        foreach ($margin as $result) {
            echo $result . " ";
        }
    } ?>">
        <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
                <h2 class="m-0"><?php echo $cta_headline ?></h2>
                <?php gravity_form($gravity_form_id, false, false, false, '', true, 12); ?>
            </div>
        </div>
    </section>
<?php } ?>
