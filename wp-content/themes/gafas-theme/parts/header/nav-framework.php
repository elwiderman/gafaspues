<?php
$logo               = get_field('logo_img', 'option');
?>
<header class="header">
    <div class="header__nav">
        <a href="<?php echo esc_html(home_url());?>" class="header__nav--brand">
            <figure class="mb-0">
                <img src="<?php echo $logo['url'];?>" alt="<?php bloginfo('name'); ?>" class="logo img-fluid">
            </figure>
        </a>

        <div class="header__nav--collapse">
            <div class="main-menu">
                <?php main_menu();?>
            </div>
        </div>

        <div class="header__nav--right">
            <div class="navbar-account">
                <?php
                echo do_shortcode('[xoo_el_action type="login" display="link" text="Login/Signup" change_to="myaccount" redirect_to="?login=success"]');
                // echo do_shortcode('[xoo_el_action type="login" display="link" text="Click here to login/continue with your socials." change_to_text="Logout or create a new account." redirect_to="?login=success"]');
                ?>
            </div>
                
            <?php 
            if (function_exists('WC') && (!is_cart() && !is_checkout())) : 
                nav_wishlist();
                nav_cart();
            endif;
            ?>

        </div>

        <button class="header__nav--toggler" type="button" data-target="#navbarMain">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
    </div>
</header>
