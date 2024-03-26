<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>

    <!-- Modal Error Validation -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0 border-0">
          <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="icon-top check">
              <div class="cross"></div>
            </div>
            <h2 class="notif-title">Thank you!</h2>
            <p class="notif-message">You'll be hearing from us soon.</p>

            <a class="btn btn-main banner-cta hide-modal" href="<?php echo site_url() ?>">BACK TO SITE</a>
          </div>
        </div>
      </div>
    </div>

    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
