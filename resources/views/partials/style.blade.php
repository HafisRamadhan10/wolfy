<?php
$primary_color = get_field('primary_color','option');
$secondary_color = get_field('secondary_color','option');
$primary_font = get_field('primary_font','option');

if ($primary_font == 'ssp') {
  $primary_font = "'Source Sans Pro', sans-serif";
} elseif ($primary_font == 'ns') {
  $primary_font = "'Noto Serif', serif";
} elseif ($primary_font == 'rbt') {
  $primary_font = "'Roboto', sans-serif";
} elseif ($primary_font == 'zilla') {
  $primary_font = "'Zilla Slab', serif";
} elseif ($primary_font == 'pd') {
  $primary_font = "'Playfair Display', serif";
} elseif ($primary_font == 'mt') {
    $primary_font = "'Montserrat', sans-serif";
} else {
    $primary_font = "'Quicksand', sans-serif";
}

?>
<style>
  :root {
    --colorPrimary: <?php echo $primary_color ?>;
    --colorSecondary: <?php echo $secondary_color ?>;
    --fontPrimary: <?php echo $primary_font ?>;
    --colorPrimary2: <?php echo hex2rgba($primary_color, 0.5); ?>;
    --colorPrimary3: <?php echo hex2rgba($primary_color, 0.1); ?>;
    --colorSecondary2: <?php echo hex2rgba($secondary_color, 0.8); ?>;
    --colorPrimaryDark: <?php echo color_luminance( $primary_color, -0.3 ); ?>;
    --colorSecondaryDark: <?php echo color_luminance( $secondary_color, -0.3 ); ?>;
  }
</style>

