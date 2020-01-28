<header id="banner" class="banner">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-md-10 d-flex justify-content-between">
            
                <div class="logo-container">
                    <a class="logo-link" href="<?= esc_url(home_url('/')); ?>">
                        <picture>
                        
                            <source media="(min-width: 0px)" data-srcset="<?= $logo['sizes']['logo'] ?>, <?= $logo['sizes']['logo_retina'] ?> 2x">
                        
                            <img class="logo lazyload" data-src="<?= $logo['sizes']['logo'] ?>" alt="<?php bloginfo('name'); ?>">
                        
                        </picture>
                    </a>
                </div>

                <div id="menu-btn" class="menu-btn">
                    <div class="menu-row top"></div>
                    <div class="menu-row mid"></div>
                    <div class="menu-row bot"></div>                        
                </div>

            </div>
        </div>
    </div>
</header>

<?php if (has_nav_menu('primary_navigation')) : ?>
    <div id="main-nav" class="main-navigation">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-md-10">
                    
                    <?php wp_nav_menu(['theme_location' => 'primary_navigation']); ?>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>