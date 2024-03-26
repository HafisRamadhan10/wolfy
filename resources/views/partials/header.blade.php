<?php
  $header_type = get_field('header_type', 'option');
  $form_id = get_field('top_bar_form', 'option');
  $book_now_button = get_field('book_now_button', 'option');
  $transparent_navbar = get_field('transparent_navbar', 'option');
  $new_class = $header_type;

  if($header_type == 'extended-cta') {
    $new_class .= ' basic-flag';
  }
?>
<header class="banner d-none <?php echo $new_class ?> <?php echo $transparent_navbar ? $transparent_navbar[0] : '' ?>" id="header">
  <?php if(($header_type == 'extended-form') || ($header_type == 'extended-cta') || ($header_type == 'single-page-nav')): ?>
  <div class="extended-bar">
    <div class="container d-flex justify-content-md-end">
    <?php if($header_type == 'extended-form') {
      if ($form_id) {
        gravity_form($form_id, false, false, false, '', true, 12);
      }
    } else {
      $cta_name_1 = get_field('cta_name_1', 'option');
      $cta_link_1 = get_field('cta_link_1', 'option');
      $cta_name_2 = get_field('cta_name_2', 'option');
      $cta_link_2 = get_field('cta_link_2', 'option');

      if($cta_name_1) {
        echo '<a class="cta-1 btn-main btn-main-small mr-2 mr-lg-4" href="'.$cta_link_1.'">'.$cta_name_1.'</a>';
      }

      if($cta_name_2) {
        echo '<a class="cta-1 btn-main btn-main-small" href="'.$cta_link_2.'">'.$cta_name_2.'</a>';
      }
    }
    ?>
    </div>
  </div>
  <?php endif; ?>

  <nav class="navbar navbar-expand-lg" id="main-navbar">
    <div class="container align-items-stretch header-height">
      <a class="navbar-brand <?php if (!has_nav_menu('primary_navigation')) { echo 'center-logo'; } ?>" href="<?= esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
        <?php
        $logo = get_field('header_logo', 'options');
        if ($logo) {
        ?>
        <img class="logo img-fluid" alt="<?php bloginfo('name'); ?>" src="<?php echo $logo['url'] ?>" />
        <?php
        } else {
          bloginfo('name');
        }
        ?>
      </a>

      <?php if($header_type == 'single-page-nav') {
        if ($form_id) {
          gravity_form($form_id, false, false, false, '', true, 13);
        }
      } ?>

      <?php $menu = wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav mr-auto align-items-lg-center',  'menu_id' => 'nav-primary', 'echo' => false]); ?>
      @if ((has_nav_menu('primary_navigation')) && ($menu !== false))
        <button class="hamburger hamburger--elastic navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
        </button>
{{--        <div class="collapse navbar-collapse justify-content-lg-end align-items-lg-stretch" id="navbarSupportedContent">--}}
{{--          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav mr-auto align-items-lg-center',  'menu_id' => 'nav-primary']) !!}--}}
{{--        </div>--}}
      @endif
    </div>
  </nav>
</header>

<header id="header" class="mobile-view">
  <nav class="navbar navbar-expand-lg" id="main-navbar">
    <div class="container header-height">
      <a class="navbar-brand <?php if (!has_nav_menu('primary_navigation')) { echo 'center-logo'; } ?>" href="<?= esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
        <?php
        $logo = get_field('header_logo', 'options');
        if ($logo) {
        ?>
        <img class="logo img-fluid" alt="<?php bloginfo('name'); ?>" src="<?php echo $logo['url'] ?>" />
        <?php
        } else {
          bloginfo('name');
        }
        ?>
      </a>

    <?php $menu = wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav mr-auto align-items-lg-center',  'menu_id' => 'nav-primary', 'echo' => false]); ?>
      @if ((has_nav_menu('primary_navigation')) && ($menu !== false))
        <button class="hamburger hamburger--elastic" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
        </button>
        <div class="collapse align-items-lg-stretch" id="navbarSupportedContent">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav mr-auto',  'menu_id' => 'nav-primary']) !!}
        </div>
      @endif

      <div class="btn-book d-none">
        <a href="<?php echo $book_now_button['url'] ?>"><?php echo $book_now_button['title'] ?></a>
      </div>
    </div>
  </nav>
</header>

<header id="header" class="dekstop-view d-none">
  <nav class="navbar navbar-expand-lg" id="main-navbar">
    <div class="d-flex header-height">
      <?php $menu = wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav mr-auto align-items-lg-center',  'menu_id' => 'nav-primary', 'echo' => false]); ?>
      @if ((has_nav_menu('primary_navigation')) && ($menu !== false))
        <button class="hamburger hamburger--elastic navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav mr-auto align-items-lg-center',  'menu_id' => 'nav-primary']) !!}
        </div>
      @endif

      <a class="navbar-brand <?php if (!has_nav_menu('primary_navigation')) { echo 'center-logo'; } ?>" href="<?= esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
          <?php
          $logo = get_field('header_logo', 'options');
          if ($logo) {
          ?>
          <img class="logo img-fluid" alt="<?php bloginfo('name'); ?>" src="<?php echo $logo['url'] ?>" />
          <?php
          } else {
            bloginfo('name');
          }
          ?>
        </a>

      <div class="btn-book">
        <a href="<?php echo $book_now_button['url'] ?>"><?php echo $book_now_button['title'] ?></a>
      </div>
    </div>
  </nav>
</header>
