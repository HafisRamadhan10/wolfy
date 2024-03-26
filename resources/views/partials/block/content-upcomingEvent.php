<?php
/**
 * Block Name: Upcoming Events
 *
 */

?>
<?php
$block_title = get_field('block_title');
$block_description = get_field('block_description');
$number_of_events = get_field('number_of_events');
?>
<div class="event-wrap">
    <?php
    date_default_timezone_set(get_option('timezone_string'));

    $the_query = new WP_Query(array(
        'post_status' => 'publish',
        'post_type' => array(\Tribe__Events__Main::POSTTYPE, 'revision'),
        'posts_per_page' => $number_of_events,
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_query' => array(
            array(
                'key' => '_EventStartDate',
                'value' => date("Y-m-d H:i:s"),
                'compare' => '>='
            ),
        ),
    ));
    ?>
    <h2><?php echo $block_title ?></h2>
    <?php echo $block_description ?>
    <div class="events">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="row content-event">
                <div class="left-col pr-sm-0 col-sm-3">
                    <div class="date-box">
                        <span class="month"><?php echo get_the_date('M').'.'; ?></span>
                        <span class="day"><?php echo get_the_date('d'); ?></span>
                    </div>
                </div>
                <div class="right-col col-sm-9">
                    <header>
                          <h2 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title() ?></a></h2>
                    </header>
                    <div class="entry-summary">
                        <?php if (tribe_get_start_date(get_the_id(), true, 'F d')) {?>
                        <p><i class="fa fa-calendar mr-2" aria-hidden="true"></i><?php echo tribe_get_start_date(get_the_id(), true, 'F d (g:ia)'); ?></p>
                        <?php }?>
                        <?php if (tribe_get_venue(get_the_id())) {?>
                        <p><i class="fa fa-map-marker mr-2" aria-hidden="true"></i><?php echo tribe_get_venue(get_the_id()); ?></p>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
