<?php
/**
 * Block Name: Social Media
 *
 */

?>
<div class="socialmedia-banner alignfull py-5">
    <div class="container">
        <div class="row justify-content-center">
            <?php
                $left_content_socmed = get_field('left_content_socmed');
                $class = 'col-12';
                if($left_content_socmed) {
                    $class = 'col-md-4';
            ?>
            <div class="<?php echo $class ?> mr-3 border-right">
                <?php echo $left_content_socmed; ?>
            </div>
            <?php
                    $class = 'col-auto';
                }
            ?>

            <div class="<?php echo $class ?>">
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
            </div>
        </div>
    </div>
</div>