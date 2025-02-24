<?php
// hero
$banner = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_field('placeholder_banner_img', 'option')['url'];
?>
<section class="section-block section-hero">
    <div class="banner" style="background-image:url(<?php echo $banner;?>);"></div>
</section>