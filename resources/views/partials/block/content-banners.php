<?php
/**
 * Block Name: Banners
 *
 * Banners
 */

// get image field (array)
$banner_type = get_field('banner_type');
$overlay = get_field('enable_overlay');
$remove_margin = get_field('remove_margin');
$remove_padding = get_field('remove_padding');
$background_position = get_field('background_position');
$headline = get_field('headline');
$description = get_field('description');
$cta_name = get_field('cta_name');
$cta_link = get_field('cta_link');
$countdown_time = get_field('countdown_time');
$background_image = get_field('background_image');
$video_upload = get_field('video_upload');
$video_upload_tab = get_field('video_upload_tab');
$video_upload_mobile = get_field('video_upload_mobile');
$video_embed_id = get_field('video_embed', false, false);
$small_headline = get_field('small_headline');
$parallax = get_field('enable_parallax');

// create id attribute for specific styling
$id = $banner_type . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

$class = 'col-12';

if ($banner_type == 'basic' || $banner_type == 'video-bg' || $banner_type == 'photo-bg') {
    $class = 'col-12 text-center';
}

if ($banner_type == 'quote' || $banner_type == 'with-carousel') {
    $class = 'col-12 col-md-6 col-lg-6';
}

if ($banner_type == 'impact-headline' || $banner_type == 'countdown') {
    $class .= ' text-center';
}

$class2 = '';
if($overlay) {
    $class2 .= $overlay[0].' ';
}
if($remove_margin) {
    $class2 .= $remove_margin[0];
}
if($remove_padding) {
    $class2 .= ' '.$remove_padding[0];
}
if($small_headline) {
    $class2 .= ' '.$small_headline[0];
}
?>

<section id="<?php echo $id; ?>" class="banners <?php echo $block['className'].' banners-' . $banner_type . ' ' . $align_class . ' ' . $class2; ?>">
    <?php if ($banner_type == 'video-bg'): ?>
        <?php if ($video_upload): ?>
            <div id="hpVid">
                <video id="introBGVideo" class="lazy <?php echo ($video_upload_tab) ? 'load-tab-vid' : ''; echo ($video_upload_mobile) ? ' load-mobile-vid' : '' ?>" data-src="<?php echo $video_upload['url'] ?>" onloadeddata="this.play();" preload="auto" muted playsinline autoplay loop="loop">
                    <source src="" type="video/mp4">
                    bgvideo
                </video>

              <?php if ($video_upload_tab): ?>
                <video id="vid-tab" class="intro-bg-vid tab" onloadeddata="this.play();" data-src="<?php echo $video_upload_tab['url'] ?>" preload="auto" muted playsinline autoplay loop="loop">
                  <source src="" type="video/mp4">
                  bgvideo
                </video>
              <?php endif; ?>

              <?php if ($video_upload_mobile): ?>
                <video id="vid-mobile" class="intro-bg-vid mobile" onloadeddata="this.play();" data-src="<?php echo $video_upload_mobile['url'] ?>" preload="auto" muted playsinline autoplay loop="loop">
                  <source src="" type="video/mp4">
                  bgvideo
                </video>
              <?php endif; ?>
            </div>
        <?php else: ?>
            <?php
                $parts = parse_url($video_embed_id);
                parse_str($parts['query'], $query);
            ?>
            <div class="yt-overlay"></div>
            <div id="player-slider"></div>

<!--            <script>-->
<!--                var player = '';-->
<!---->
<!--                if (typeof onYouTubePlayerAPIReady !== "function") {-->
<!--                    function onYouTubePlayerAPIReady() {-->
<!--                        player = new YT.Player('player-slider', {-->
<!--                            width: '640',-->
<!--                            height: '360',-->
<!--                            videoId: '--><?php //echo $query['v'] ?>//',
//                            playerVars: {
////                                playlist: '<?php ////echo $query['v'] ?>////',
//                                loop: 1,
//                                autoplay: 1,
//                                controls: 0,
//                                showinfo: 0,
//                                rel: 0,
//                                enablejsapi: 1,
//                                wmode: 'transparent',
//                                mute: 1
//                            },
//                            events: {
//                                onReady: onPlayerReady,
//                                onStateChange: onStateChange
//                            }
//                        });
//                    }
//
//                    function onPlayerReady(event) {
//                        player.mute();
////                        event.target.setVolume(80);
////                        event.target.playVideo();
//                    }
//
//                    function onStateChange(e) {
//                        if (e.data === YT.PlayerState.ENDED) {
////                            player.playVideo();
//                            player.seekTo(0);
//                        }
//                    }
//                }
//            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($banner_type == 'with-carousel'): ?>
        <?php if (have_rows('carousel')): ?>
            <div class="owl-carousel owl-theme banner-carousel">
                <?php while (have_rows('carousel')):the_row(); ?>
                    <div class="item">
                        <?php
                        $headline_carousel = get_sub_field('headline');
                        $description_carousel = get_sub_field('description');
                        $cta_name_carousel = get_sub_field('cta_name');
                        $cta_link_carousel = get_sub_field('cta_link');
                        $background_image_carousel = get_sub_field('background_image');
                        $open_in_new_tab = get_sub_field('open_in_new_tab');
                        ?>
                        <img class="img-bg" src="<?php echo $background_image_carousel ? $background_image_carousel['url'] : '' ?>"
                             alt="<?php echo $background_image_carousel ? $background_image_carousel['alt'] : '' ?>" loading="lazy" />

                        <div class="container custom-container-small">
                            <div class="row align-items-center banner-height">
                                <div class="<?php echo $class ?>">
                                    <h1 class="banner-title"><?php echo $headline_carousel ?></h1>

                                    <div class="banner-desc mb-2"><?php echo $description_carousel ?></div>
                                    <?php if ($cta_link_carousel): ?>
                                        <a class="btn-main mt-4 banner-cta"
                                           href="<?php echo $cta_link_carousel ?>" target="<?php echo is_array($open_in_new_tab) ? $open_in_new_tab[0] : '_self' ?>"><?php echo $cta_name_carousel ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if ($background_image): ?>
            <?php if(isset($parallax[0]) && ($parallax[0] == 'yes')) { ?>
                <div class="img-bg parallax-on" style="background: url('<?php echo $background_image ? $background_image['url'] : '' ?>') repeat top; background-size: cover;" data-paroller-factor="0.64"
                     data-paroller-direction="vertical"></div>
            <?php } else { ?>
                <img class="img-bg <?php echo 'bg-pos-'.$background_position ?>" src="<?php echo $background_image ? $background_image['url'] : '' ?>"
                     alt="<?php echo $background_image ? $background_image['alt'] : '' ?>" loading="lazy"/>
            <?php } ?>
        <?php endif; ?>

        <?php if (($headline)): ?>

            <?php
                $container_class = ' custom-container-small';
                if (($banner_type == 'video-bg') || ($banner_type == 'photo-bg')) {
                    $container_class = '';
                }
            ?>
            <?php $open_in_new_tab = get_field('open_in_new_tab') ?>
            <div class="container<?php echo $container_class ?>">
                <?php $text_align = get_field('text_align') ?>
                <div class="row align-items-center banner-height <?php echo $text_align == 'right' ? 'justify-content-end' : '' ?> <?php echo $text_align ? 'text-'.$text_align : '' ?> <?php echo $banner_type == 'news-banner' ? 'justify-content-center' : '' ?>">
                    <div class="<?php echo $class ?>">
                        <h1 class="banner-title <?php echo $banner_type == 'news-banner' ? 'text-center' : '' ?>"><?php echo $headline ?></h1>

                        <?php if ($description){ ?>
                        <div class="banner-desc mb-2"><?php echo $description ?></div>
                        <?php } ?>

                        <?php $show_video_on_modal = get_field('show_video_on_modal'); ?>
                        <?php if ((isset($show_video_on_modal[0])) && ($show_video_on_modal[0] == 'yes')) { ?>
                            <?php if ($video_upload): ?>
                                <button data-toggle="modal" data-src="<?php echo $video_upload['url'] ?>" data-target="#videoModal" class="btn-main mt-4 banner-cta video-btn">Watch Video</button>
                            <?php else: ?>
                                <button data-toggle="modal" data-src="<?php echo $video_embed_id ?>" data-target="#videoModal" class="btn-main mt-4 banner-cta video-btn">Watch Video</button>
                            <?php endif; ?>
                        <?php } else { ?>
                            <?php if($cta_link): ?>
                            <a class="btn-main mt-4 banner-cta"
                               href="<?php echo $cta_link ?>" target="<?php echo is_array($open_in_new_tab) ? $open_in_new_tab[0] : '_self' ?>"><?php echo $cta_name ?></a>
                            <?php endif; ?>
                        <?php } ?>

                        <?php if ($banner_type == 'countdown' || $banner_type == 'cd-headline'): ?>
                            <div id="countdown"></div>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery('#countdown').countdown('<?php echo $countdown_time ?>', function (event) {
                                        jQuery(this).html(event.strftime('<div class="time-block"><span class="numbers">%D</span><span class="time-label">days</span></div><div class="separator">:</div><div class="time-block"><span class="numbers">%H</span><span class="time-label">hours</span></div><div class="separator">:</div><div class="time-block"><span class="numbers">%M</span><span class="time-label">minutes</span></div><div class="separator">:</div><div class="time-block"><span class="numbers">%S</span><span class="time-label">seconds</span></div>'));
                                    });
                                });
                            </script>
                        <?php endif; ?>
                    </div>

                    <?php if ($banner_type == 'news-banner'): ?>
                        <?php
                        $except = '';
                        $query = new WP_Query([
                            'post_type' => 'post',
                            'posts_per_page' => 1,
                            'meta_query' => array(
                                'relation' => 'OR',
                                array (
                                    'key' => 'featured_news',
                                    'value' => 'yes',
                                    'compare' => 'LIKE'
                                )
                            )
                        ]);

                        if($query->have_posts()) {
                            echo "<div class='col-md-9'>";
                            while($query->have_posts()) { $query->the_post(); global $except; $except = get_the_ID(); ?>
                                <div class='featured-news mb-5'>
                                    <div class='row justify-content-center'>
                                        <div class='col-md-12'>
                                            <article class="container p-0">
                                                <div class='row'>
                                                    <div class="col-lg-auto mr-lg-4 left-box">
                                                        <?php if ((has_post_thumbnail()) && (is_single() == false)): ?>
                                                            <?php
                                                            $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                                                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                                            ?>
                                                            <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?>" alt="<?php echo $alt ?>" loading="lazy" />
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class='col-lg align-self-center right-box'>
                                                        <header>
                                                            <h2 class="entry-title"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h2>
                                                        </header>
                                                        <div class="entry-summary">
                                                            <?php echo wp_trim_words(get_the_content(), 20) ?>
                                                        </div>

                                                        <?php if(get_field('source_link')): ?>
                                                            <p class="source">Source: <a href="<?php echo get_field('source_link') ?>"><?php echo get_field('source_link') ?></a></p>
                                                        <?php endif; ?>

                                                        <a class="btn-main banner-cta" href="<?php echo get_permalink() ?>">READ MORE</a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            echo "</div>";
                        }

                        wp_reset_query();
                        ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($show_video_on_modal[0] == 'yes'): ?>
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body">
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="" id="video" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</section>
