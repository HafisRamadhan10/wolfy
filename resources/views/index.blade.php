@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @while (have_posts()) @php the_post() @endphp
    @include('partials.content-'.get_post_type())
  @endwhile

  <div class="pagination">
    <?php
      global $wp_query;

      $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

      echo paginate_links( array(
        'format'  => 'page/%#%',
        'current' => $paged,
        'total'   => $wp_query->max_num_pages,
        'mid_size'        => 2,
        'prev_text'       => __('<i class="fas fa-caret-left"></i>'),
        'next_text'       => __('<i class="fas fa-caret-right"></i>')
      ) );
    ?>
  </div>
@endsection
