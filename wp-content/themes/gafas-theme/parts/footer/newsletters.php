<?php
// the newsletter partial
$group  = get_field('footer_newsletter_group', 'option');
$title  = $group['title_text'];
$desc   = $group['desc_text'];
$form   = $group['shortcode'];
?>

<div class="newsletter">
    <h4 class="newsletter__title"><?php echo $title;?></h4>
    <?php if (!empty($desc)) : ?>
        <p class="newsletter__desc"><?php echo $desc;?></p>
    <?php endif; ?>
    <div class="newsletter__form form-area">
        <?php echo do_shortcode($form);?>
    </div>
</div>

<?php
/*
<div class="form-group">
    [email* email autocomplete:email class:form-control placeholder "Email"]
</div>
<div class="form-submit">
    <button class="btn-outline wpcf7-submit" type="submit">Suscribirse</button>
    <span class="wpcf7-spinner"></span>
</div>
*/