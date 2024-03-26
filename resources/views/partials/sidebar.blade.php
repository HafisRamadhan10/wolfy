<?php /* Featured Posts */ ?>
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

@php //dynamic_sidebar('sidebar-primary') @endphp
