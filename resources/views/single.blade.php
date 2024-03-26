@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="banners banners-impact-headline alignfull overlay py-0">
      <?php $news_bg = get_field('news_bg', 'option'); ?>
      <img class="img-bg bg-pos-center" src="<?php echo $news_bg['url'] ?>" alt="">
      <div class="container">
        <div class="row align-items-center banner-height">
          <div class="col-12 text-center">
            <h1 class="banner-title ">News</h1>
          </div>
        </div>
      </div>
    </section>
    @include('partials.content-single-'.get_post_type())
  @endwhile
@endsection
