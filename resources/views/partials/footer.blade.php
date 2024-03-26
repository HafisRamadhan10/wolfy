<footer class="content-info d-none">
  <?php
    $footer_type = get_field('footer_type', 'option');
    if($footer_type == 'basic'):
  ?>
  <div class="top-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-lg-1">
          <h3 class="text-white text-uppercase">Contact</h3>
        </div>
        <div class="col-md-3 address">
          <?php the_field('footer_address', 'option') ?>
        </div>
        <div class="col-md-4 mt-3 mt-md-0 ml-auto text-center text-md-right">
          <?php
            $facebook = get_field('facebook', 'option');
            $twitter = get_field('twitter', 'option');
            $instagram = get_field('instagram', 'option');
            $youtube = get_field('youtube', 'option');

            if($facebook || $twitter || $instagram || $youtube):
          ?>
            <div class="social-media">
              <?php if($facebook){?><a class='social fb' href='<?php echo $facebook ?>' target='_blank'><i class="fab fa-facebook-f"></i></a><?php } ?>
              <?php if($twitter){?><a class='social tw' href='<?php echo $twitter ?>' target='_blank'><i class="fab fa-twitter"></i></a><?php } ?>
              <?php if($instagram){?><a class='social in' href='<?php echo $instagram ?>' target='_blank'><i class="fab fa-instagram"></i></a><?php } ?>
              <?php if($youtube){?><a class='social yt' href='<?php echo $youtube ?>' target='_blank'><i class="fab fa-youtube"></i></a><?php } ?>
            </div>
           <?php endif; ?>
          <p class="copyright"><?php the_field('copyright', 'option') ?></p>
          @if (has_nav_menu('footer_links'))
            {!! wp_nav_menu(['theme_location' => 'footer_links', 'menu_class'=> 'd-flex justify-content-center justify-content-lg-end', 'menu_id' => 'link-nav-wrap']) !!}
          @endif
        </div>
      </div>
    </div>
  </div>
 <?php  elseif($footer_type == 'center'): ?>
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-12 address text-center">
              <?php
              $facebook = get_field('facebook', 'option');
              $twitter = get_field('twitter', 'option');
              $instagram = get_field('instagram', 'option');
              $youtube = get_field('youtube', 'option');

              if($facebook || $twitter || $instagram || $youtube):
              ?>
            <div class="social-media">
                <?php if($facebook){?><a class='social fb' href='<?php echo $facebook ?>' target='_blank'><i
                        class="fab fa-facebook-f"></i></a><?php } ?>
                <?php if($twitter){?><a class='social tw' href='<?php echo $twitter ?>' target='_blank'><i
                        class="fab fa-twitter"></i></a><?php } ?>
                <?php if($instagram){?><a class='social in' href='<?php echo $instagram ?>' target='_blank'><i
                        class="fab fa-instagram"></i></a><?php } ?>
                <?php if($youtube){?><a class='social yt' href='<?php echo $youtube ?>' target='_blank'><i
                        class="fab fa-youtube"></i></a><?php } ?>
            </div>
              <?php endif; ?>
              <?php the_field('footer_address', 'option') ?>
            <p class="copyright"><?php the_field('copyright', 'option') ?></p>
            @if (has_nav_menu('footer_links'))
              {!! wp_nav_menu(['theme_location' => 'footer_links', 'menu_class'=> 'd-flex justify-content-center pt-2', 'menu_id' => 'link-nav-wrap']) !!}
            @endif
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
  <div class="top-footer minimal-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          @if (has_nav_menu('footer_links'))
            {!! wp_nav_menu(['theme_location' => 'footer_links', 'menu_class'=> 'd-flex justify-content-center justify-content-lg-start', 'menu_id' => 'link-nav-wrap']) !!}
          @endif
        </div>
        <div class="col-md-6 text-center text-md-right">
          <p class="copyright"><?php the_field('copyright', 'option') ?></p>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if(get_field('footer_banner', 'option')): ?>
  <div class="bg-white py-4">
    <div class="container">
      <p class="banner-footer mx-auto"><?php echo get_field('footer_banner', 'option') ?></p>
    </div>
  </div>
  <?php endif; ?>
</footer>

<footer class="new-footer">
  <div class="container">
    <div class="row align-items-center justify-content-center justify-content-md-between">
      <div class="col-auto">
        @if (has_nav_menu('footer_links_left'))
          {!! wp_nav_menu(['theme_location' => 'footer_links_left', 'menu_class'=> 'd-flex justify-content-center justify-content-lg-start', 'menu_id' => 'link-nav-wrap']) !!}
        @endif
      </div>
      <div class="col-auto order-3 order-md-0 text-center">
        <a class="navbar-brand mb-4 mr-0 mb-md-0 <?php if (!has_nav_menu('primary_navigation')) { echo 'center-logo'; } ?>" href="<?= esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
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
      </div>
      <div class="col-auto">
        @if (has_nav_menu('footer_links_right'))
          {!! wp_nav_menu(['theme_location' => 'footer_links_right', 'menu_class'=> 'd-flex justify-content-center', 'menu_id' => 'link-nav-wrap']) !!}
        @endif
      </div>
    </div>
  </div>
</footer>
