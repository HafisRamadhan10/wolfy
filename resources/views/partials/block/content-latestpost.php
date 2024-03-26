<?php
/**
 * Block Name: Latest Post
 *
 */

// create id attribute for specific styling
$id = 'latest-post-' . $block['id'];

$show_border = get_field('show_border');
$show_picture = get_field('show_picture');

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>

<section id="<?php echo $id; ?>" class="latest-post <?php echo $block['className'] ?>">
    <div class="row">
        <?php
        global $except;
        $show_featured = get_field('show_featured');

        if(($show_featured !== '') && ($show_featured[0] == 'yes')) {
            $except = '';
            $query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 1,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'featured_news',
                        'value' => 'yes',
                        'compare' => 'LIKE'
                    )
                )
            ]);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $except = get_the_ID(); ?>
                    <div class='featured-news mb-5'>
                        <div class='row justify-content-center'>
                            <div class='col-md-12'>
                                <article class="container p-0">
                                    <div class='row align-items-center'>
                                        <div class="col-lg-auto mr-lg-4 left-box">
                                            <?php if ((has_post_thumbnail()) && (is_single() == false)) : ?>
                                                <?php
                                                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                                ?>
                                                <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?>" alt="<?php echo $alt ?>"/>
                                            <?php endif; ?>
                                        </div>
                                        <div class='col-lg right-box'>
                                            <header>
                                                <h2 class="entry-title"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h2>
                                            </header>
                                            <div class="entry-summary">
                                                <?php echo wp_trim_words(get_the_content(), 35) ?>
                                            </div>

                                            <?php if(get_field('source_link')) : ?>
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
            }
        }
        ?>
    </div>

    <div class="row">
        <div class="col-12 col-lg">
            <?php
            global $except;

            $section_title = get_field('section_title_post_list');

            if($section_title) {
                echo '<h2>'.$section_title.'</h2>';
            }

            if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
            elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
            else { $paged = 1; }

            $args = [
                'post_type' => 'post',
                'posts_per_page' => get_option( 'posts_per_page' ),
                'paged' => $paged
            ];

            if($except !== '') {
                $args['post__not_in'] = [$except];
            }
            $query_blog = new WP_Query($args);

            $class2 = '';

            if(($show_border !== '') && ($show_border[0] == 'yes')) {
                $class2 = ' bordered';
            }
            ?>

            <div class="blog-list<?php echo $class2 ?>">
                <?php while ($query_blog->have_posts()) : $query_blog->the_post() ?>
                    <article <?php post_class() ?>>
                        <div class="row">
                            <?php if ((has_post_thumbnail()) && (is_single() == false)) : ?>
                                <?php
                                $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                $class3 = '';

                                if(!$show_picture) {
                                    $class3 = ' d-none';
                                }
                                ?>

                                <div class="col-md-auto mb-3 mb-md-0 mr-md-4<?php echo $class3 ?>">
                                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small-thumb') ?>" alt="<?php echo $alt ?>" />
                                </div>
                            <?php endif; ?>

                            <div class="col-md position-relative right-box">
                                <header>
                                    <h2 class="entry-title"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h2>

                                </header>
                                <div class="entry-summary">
                                    <?php echo wp_trim_words(get_the_content(), 35) ?>
                                </div>

                                <?php if(get_field('source_link', get_the_ID())): ?>
                                    <p class="source">Source: <a href="<?php echo get_field('source_link', get_the_ID()) ?>"><?php echo get_field('source_link', get_the_ID()) ?></a></p>
                                <?php endif; ?>

                                <a class="btn-main banner-cta" href="<?php echo get_permalink() ?>">READ MORE</a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php
                echo paginate_links( array(
                    'format'  => 'page/%#%',
                    'current' => $paged,
                    'total'   => $query_blog->max_num_pages,
                    'mid_size'        => 2,
                    'prev_text'       => __('<i class="fas fa-caret-left"></i>'),
                    'next_text'       => __('<i class="fas fa-caret-right"></i>')
                ) );
                ?>
            </div>
        </div>

        <?php
        $show_sidebar = get_field('show_sidebar');
        if(($show_sidebar !== '') && ($show_sidebar[0] == 'yes')) {
        ?>
        <div class="col-12 col-lg-3 sidebar">
            <div class="featured-post-box mt-4 mt-md-0">
                <h2 class="text-center box-title">Featured Posts</h2>
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'order' => 'DESC',
                    'orderby' => 'date'
                );
                $query = new WP_Query($args);
                if($query->have_posts()){
                    echo "<ul>";
                    while($query->have_posts()) {
                        $query->the_post();
                        echo "<li><a class='featured-post-link' href='".get_the_permalink()."'>".get_the_title()."</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<ul><li class='text-center'><a class='featured-post-link' href=''>Oops! There's no post yet.</a></li></ul>";
                }
                wp_reset_query();
                ?>
            </div>
            <div class="tags-box">
                <h2 class="text-center">Tags</h2>
                <?php
                if(is_single()) {
                    global $post;
                    $posttags = wp_get_post_tags($post->ID);
                    if ($posttags) {
                        $html = '';
                        foreach($posttags as $tag) {
                            $tag_link = get_tag_link( $tag->term_id );
                            $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                            $html .= "{$tag->name}</a>";
                        }
                        echo $html;
                    } else {
                        echo "<ul><li class='text-center'><a class='featured-post-link' href=''>Oops! There's no tag yet.</a></li></ul>";
                    }
                } else {
                    $tags = get_tags(['hide_empty'=> true]);
                    if($tags){
                        $html = '';
                        foreach($tags as $tag) {
                            $tag_link = get_tag_link( $tag->term_id );
                            $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                            $html .= "{$tag->name}</a>";
                        }
                        echo $html;
                    } else {
                        echo "<ul><li class='text-center'><a class='featured-post-link' href=''>Oops! There's no tag yet.</a></li></ul>";
                    }
                }
                ?>
            </div>
        </div>
        <?php } ?>
    </div>
</section>