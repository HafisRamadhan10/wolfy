@extends('layouts.app')

@section('content')
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

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
    while($query->have_posts()) { $query->the_post(); $except = get_the_ID(); ?>
    <div class='featured-news mb-5'>
      <div class='row justify-content-center'>
        <div class='col-md-12'>
          <article class="container p-0">
            <div class='row align-items-center'>
              <div class="col-lg-auto mr-lg-4 left-box">
                @if ((has_post_thumbnail()) && (is_single() == false))
                  <?php
                    $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                    $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                  ?>
                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?>" alt="<?php echo $alt ?>" />
                @endif
              </div>
              <div class='col-lg right-box'>
                <header>
                  <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
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
        </div>
      </div>
    </div>
  <?php }
  }
  ?>

  @include('partials.page-header')

  <div class="blog-list bordered">
    <?php
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

      $query_blog = new WP_Query($args)
    ?>
    @while ($query_blog->have_posts()) @php $query_blog->the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile
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

@endsection
