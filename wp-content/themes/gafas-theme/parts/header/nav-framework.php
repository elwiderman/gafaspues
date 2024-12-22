<?php
$logo               = get_field('logo_img', 'option');
?>
<header class="header">
    <div class="header__inner">
        <nav class="header__nav">
            <div class="header__nav--inner">
                <button class="header__nav--toggler" type="button" data-target="#navbarMain">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>
        </nav>

        <a href="<?php echo esc_html(home_url());?>" class="header__nav--brand">
            <figure class="mb-0">
                <img src="<?php echo $logo['url'];?>" alt="<?php bloginfo('name'); ?>" class="logo img-fluid">
            </figure>
        </a>

        <div class="header__nav--collapse">
            <div class="content">
                <?php main_menu();?>
            </div>  
        </div>
    </div>
</header>
