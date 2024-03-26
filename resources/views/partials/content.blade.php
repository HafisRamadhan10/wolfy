<article @php post_class() @endphp>
  <div class="row">
    @if ((has_post_thumbnail()) && (is_single() == false))
      <?php
        $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
      ?>

      <div class="col-md-auto mb-3 mb-md-0 mr-md-4">
        <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small-thumb') ?>" alt="<?php echo $alt ?>" />
      </div>
    @endif

    <div class="col-md position-relative right-box">
      <header>
        <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
        @include('partials/entry-meta')
      </header>
      <div class="entry-summary">
        @php the_excerpt() @endphp
      </div>

      @if(get_field('source_link'))
        <p class="source">Source: <a href="@php echo get_field('source_link') @endphp">@php echo get_field('source_link') @endphp</a></p>
      @endif

      <a class="btn-main banner-cta" href="@php echo get_permalink() @endphp">READ MORE</a>
    </div>
  </div>
</article>
