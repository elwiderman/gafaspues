<?php
// main section
?>
<div class="section-block section-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="main-content">
                    <h1 class="page-title h2"><?php the_title();?></h1>
                    <?php
                    the_content();

                    if (get_field('show_address_bool')) :
                        $address = nl2br(get_field('address_text'));
                        echo "
                        <p class='address-label'>Dirección</p>
                        <address>{$address}</address>
                        ";
                    endif;

                    if (get_field('email')) :
                        $email = get_field('email');
                        echo "
                        <div class='email'>
                            <i class='icon-mail'></i>
                            <a href='malito:{$email}' target='_blank'>{$email}</a>
                        </div>";
                    endif;
                    
                    if (get_field('phone')) :
                        $phone = get_field('phone');
                        echo "
                        <div class='phone'>
                            <i class='icon-phone-call'></i>
                            <a href='tel:57{$phone}' target='_blank'>{$phone}</a>
                        </div>";
                    endif;

                    echo "<p class='redes'>Nuestros Redes</p>";
                    get_template_part('parts/pages/contact/socials');
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-5">
                <div class="form-wrap form-contact">
                    <?php
                    if (get_field('form_title_text')) :
                        $form_title = get_field('form_title_text');
                        echo "<h3 class='form-title'>{$form_title}</h3>";
                    endif;

                    if (get_field('form_shortcode')) :
                        $shortcode = get_field('form_shortcode');
                        echo do_shortcode($shortcode);
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
/*
<div class="form-group">
    [text* nombre autocomplete:name class:form-control placeholder "Nombre"]
</div>
<div class="form-group">
    [email* email autocomplete:email class:form-control placeholder "Correo electronico"]
</div>
<div class="form-group">
    [tel* phone autocomplete:tel class:form-control placeholder "Numero de celular"]
</div>
<div class="form-group">
    [text* subject autocomplete:name class:form-control placeholder "Sujeto"]
</div>
<div class="form-group">
    [textarea message class:form-control placeholder] Mensaje [/textarea]
</div>
<div class="form-submit">
    <button class="btn-outline-dark wpcf7-submit" type="submit">
        <span class='loading'></span>
        <span class='label'>Enviar</span>
    </button>
</div>
*/