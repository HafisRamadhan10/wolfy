<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
    @include('partials/entry-meta')
  </header>
  <div class="entry-content">
    <?php if(get_the_post_thumbnail_url()): ?>
      <img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-fluid featured-image mb-3 ml-3" alt="featured-image" />
    <?php endif; ?>

    @php the_content() @endphp
      <div class="clearfix"></div>
  </div>
  <hr>

  <?php
    // get others must read related with current tags
    $tags = get_the_tags(get_the_ID());
    $tags_text = 'no_tag';
    if($tags) {
      $clean_tags = array_map(function ($obj) {
        return $obj->slug;
      }, $tags);
      $tags_text = implode(',', $clean_tags);
    }
    $query = new WP_Query([
      'tag' => $tags_text,
      'post__not_in' => [get_the_ID()],
      'posts_per_page' => 2
    ]);
  ?>

  <?php if($query->have_posts()){ ?>
    <section class="other-must-reads">
      <h2>More posts to read</h2>
      <?php while($query->have_posts()) : $query->the_post(); ?>
        @include('partials/content')
      <?php endwhile; ?>
    <div class="clearfix"></div>
    </section>
  <?php } ?>
</article>
