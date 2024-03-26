<article @php post_class() @endphp>
  <header>
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
    @include('partials/entry-meta')
  </header>
  <div class="entry-summary">
    @php the_excerpt() @endphp
  </div>

  @if (get_field('source_link'))
  	<p class="source">Source: <a href="@php echo get_field('source_link') @endphp">@php echo get_field('source_link') @endphp</a></p>
  @endif

  @if (get_field('source_link'))
  	<a class="btn-main banner-cta" href="@php echo get_field('source_link') @endphp">READ MORE</a>
  @endif
</article>
